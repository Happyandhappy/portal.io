<?php defined('BASEPATH') or exit('direct access is not permitted');

class Upload_ExchangeCSV extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function is_coin($currency){
		// $res = $this->db->get_where("cf_coin_list", array('coin_short' => $currency))->result();
		$res = $this->db->limit(1)
            ->where('coin_short',$currency)
            ->get('cf_coin_list')
            ->row();
		if (isset($res)) return true;
		else return false;
	}

	// get txid from string
	public function get_txid($str){
		if (strpos($str, ": ") > 0){
			$strs = explode(": ", $str);
			return $strs[1];
		}
		return "";
	}

	// get last trade_action_id of table
	public function get_trade_action_id(){
		$dbnames = ["cf_global_trade_banktransfer", "cf_global_trade_buysell", "cf_global_trade_transfer"];
		$max = 0;
		for ($i = 0 ; $i < 3 ; $i++){
			$last_row = $this->db->order_by('id',"desc")
	            ->limit(1)
	            ->get($dbnames[$i])
	            ->row();            
	        if (isset($last_row) && $last_row->id > $max)
	        	$max = $last_row->id;
	    }
        return $max;
	}

	// get last total_amount for Trade in BTC market
	public function get_total_amount($dbname, $user_id, $client_id, $cur, $is_sell){
		if ($is_sell == true){
			$last_row = $this->db->order_by('id',"desc")
	            ->limit(1)
	            ->where('user_id',$user_id)
	            ->where('client_id', $client_id)
	            ->where('sell_coincurr', $cur)
	            ->get($dbname)
	            ->row();
	        if (isset($last_row))
	        	return $last_row->total_sell;
	        else return 0;			
		}else{
			$last_row = $this->db->order_by('id',"desc")
		        ->limit(1)
		        ->where('user_id',$user_id)
		        ->where('client_id', $client_id)
		        ->where('buy_coincurr', $cur)
		        ->get($dbname)
		        ->row();
		    if (isset($last_row))
		    	return $last_row->total_buy;
		    else return 0;	
		}
	}

	// get amount by homecurrency for Trade in BTC market
	function getHomecurrency($time, $currency){
		$date = date('Y-m-d 00:00:00',strtotime($time));

        $query = $this->db->query("select * from cf_global_crypto_price_aud where Timestamp='".$date."'AND cryptocurrency='" . $currency . "'");
		foreach ($query->result() as $row){
			return $row->open;
		}

		// if currency=OMG,POWR then get btc value in cf_global_crypto_price_btc
		$result = 1;
		$query = $this->db->query("select * from cf_global_crypto_price_btc where Timestamp='".$date."'AND cryptocurrency='" . $currency . "'");
		
		foreach ($query->result() as $row){
			$result = $result * $row->open;
	        $query = $this->db->query("select * from cf_global_crypto_price_aud where Timestamp='".$date."'AND cryptocurrency='BTC'");
			foreach ($query->result() as $row){
				return $result * $row->open;
			}			
		}
		return 1;
	}

	// get transf_disposal_total for Transfer in BTC market
	function get_total_disposal_amount($dbname, $user_id, $client_id, $cur){
		$last_row = $this->db->order_by('id',"desc")
            ->limit(1)
            ->where('user_id',$user_id)
            ->where('client_id', $client_id)
            ->where('transf_currency', $cur)
            ->get($dbname)
            ->row();
        if (isset($last_row))
        	return $last_row->transf_disposal_total;
        else return 0;
	}
// put buy/sell data to cf_global_trade_buysell // rule : actionType = "Trade"
	function Tradehistory($trades, $user_id, $client, $exchange, $trade_action_id){		// Buy / Sell
		$dbname = "cf_global_trade_buysell";
		// default currency of user 
		$default_currency = $this->clients_model->get_default_currency($user_id);
		for ($i = 0 ; $i < count($trades) ; $i+=3){
			// check if sell_currency is coin or not
			$sell_is_coin = $this->is_coin($trades[$i][3]);
			// check if buy_currency is coin or not
			$buy_is_coin = $this->is_coin($trades[$i+1][3]);

			$sell_valueinhomecurr = 0;
			$buy_valueinhomecurr  = 0;
			if ($sell_is_coin == true && $buy_is_coin == true){  // if both are in coin_list
				$sell_valueinhomecurr = $this->getHomecurrency($trades[$i][0], $trades[$i][3])* abs((float)$trades[$i][4]);
				$buy_valueinhomecurr  = $this->getHomecurrency($trades[$i][0], $trades[$i+1][3])* abs((float)$trades[$i+1][4]);
			}

			if ($sell_is_coin == true && $buy_is_coin == false){ // sell = coin & buy = default currency 				
				if ($default_currency ==  $trades[$i+1][3]){
					$sell_valueinhomecurr = (float)$trades[$i+1][4];					
				}
				else{
					// bugs					
					$sell_valueinhomecurr = abs((float)$trades[$i][4]) * $this->getHomecurrency($trades[$i][0], $trades[$i][3]);
				}
				$buy_valueinhomecurr  = $sell_valueinhomecurr;
			}

			if ($sell_is_coin == false && $buy_is_coin == true){  // if sell_cur is not in coin_list  & buy in coin_list, 
				if ($default_currency == $trades[$i][3]){
					$buy_valueinhomecurr =  abs((float)$trades[$i][4]);
				}else{
					// bugs
					$cur = 1;  // AUD/USD, if curr = AUD and deault=UAD, then call price api call and get AUD/USD value
					$buy_valueinhomecurr =  abs((float)$trades[$i+1][4]) * $cur * $this->getHomecurrency($trades[$i][0], $trades[$i+1][3]);  // price * buy_amount
				}
				$sell_valueinhomecurr = $buy_valueinhomecurr;
			}

			//check the record is already existed or not
			$query = array(
				"Timestamp"			 	=> $trades[$i][0],
	    		"user_id"   		 	=> $user_id,
	    		"client_id"			 	=> $client,
	    		"exchange"  		 	=> $exchange,
	    		"exchange_reference_id" => $trades[$i][6],
	    		"sell_amount" 	 		=> abs((float)$trades[$i][4]),
	    		"sell_coincurr" 	 	=> $trades[$i][3],
	    		"sell_valueinhomecurr"	=> $sell_valueinhomecurr,
	    		"buy_amount"			=> (float)$trades[$i+1][4],
	    		"buy_coincurr"			=> $trades[$i+1][3],
	    		"buy_valueinhomecurr"	=> $buy_valueinhomecurr,
	    		"fee_amount"			=> abs((float)$trades[$i+2][4]),
	    		"fee_coincurr"			=> $trades[$i+1][3],
	    		"is_disposal"			=> $sell_is_coin ? 1 : 0,
			);			
			$result = $this->db->get_where($dbname, $query)->result();
			// if the record is already existed 
            if(count($result) > 0){
            }else{
            	$trade_action_id = $trade_action_id + 1;
				$data_array = array(
		    		"Timestamp"			 	=> $trades[$i][0],
		    		"user_id"   		 	=> $user_id,
		    		"client_id"			 	=> $client,
		    		"exchange"  		 	=> $exchange,
		    		"exchange_reference_id" => $trades[$i][6],
		    		"trade_action_id" 	 	=> $trade_action_id,
		    		"sell_amount" 	 		=> abs((float)$trades[$i][4]),
		    		"sell_coincurr" 	 	=> $trades[$i][3],
		    		"sell_valueinhomecurr"	=> $sell_valueinhomecurr,
		    		"total_sell"			=> $this->get_total_amount($dbname, $user_id, $client, $trades[$i][3], true) + abs((float)$trades[$i][4]),
		    		"buy_amount"			=> (float)$trades[$i+1][4],
		    		"buy_coincurr"			=> $trades[$i+1][3],
		    		"buy_valueinhomecurr"	=> $buy_valueinhomecurr,
		    		"total_buy"				=> $this->get_total_amount($dbname, $user_id, $client, $trades[$i+1][3], false) + (float)$trades[$i+1][4],
		    		"fee_amount"			=> abs((float)$trades[$i+2][4]),
		    		"fee_coincurr"			=> $trades[$i+2][3],
		    		"is_disposal"			=> $sell_is_coin ? 1 : 0,
		    		"reason"				=> "Trade"
		    	);
				$this->db->insert($dbname, $data_array);
            }
		}
		return $trade_action_id;
	}
// put data to cf_global_trade_transfer // rule : actionType = "Fund Transfer" && currency is in coin_list
	function Transferhistory($transfers, $user_id, $client, $exchange, $trade_action_id){
		$dbname = "cf_global_trade_transfer";
		$fees = array(
					"BTC" => 0.0001,
					"ETH" => 0.001,
					"ETC" => 0.001,
					"LTC" => 0.001,
					"XRP" => 0.15,
					"BCH" => 0.0001,
					"OMG" => 0.15,
					"POWR" => 5 );//bugs
		for ($i = 0 ; $i < count($transfers) ; $i++){
			$transf_disposal_total = $this->get_total_disposal_amount($dbname, $user_id, $client, $transfers[$i][3]) + (float)$transfers[$i][4];
			$rate = $this->getHomecurrency($transfers[$i][0], $transfers[$i][3]);

			//check the record is already existed or not
			$query = array(
				"Timestamp"			 	=> $transfers[$i][0],
	    		"user_id"   		 	=> $user_id,
	    		"client_id"			 	=> $client,
	    		"exchange"  		 	=> $exchange,
	    		"exchange_reference_id" => ctype_digit ($transfers[$i][6]) == true ? $transfers[$i][6]:$transfers[$i][7],
	    		"transf_amount" 	 	=> (float)$transfers[$i][4],
	    		"transf_currency" 	 	=> $transfers[$i][3],
	    		"value_homecurr"		=> $rate * (float)$transfers[$i][4],
	    		"fee"					=> $fees[$transfers[$i][3]] * $rate,
	    		"txid"				 	=> $this->is_coin($transfers[$i][3]) == true?$this->get_txid($transfers[$i][5]):""	    		
			);
			$result = $this->db->get_where($dbname, $query)->result();
			// if the record is already existed 
            if(count($result) > 0){

            }else{
            	$trade_action_id = $trade_action_id + 1;
				$data_array = array(
		    		"Timestamp"			 	=> $transfers[$i][0],
		    		"user_id"   		 	=> $user_id,
		    		"client_id"			 	=> $client,
		    		"exchange"  		 	=> $exchange,
		    		"exchange_reference_id" => ctype_digit ($transfers[$i][6]) == true ? $transfers[$i][6]:$transfers[$i][7],
		    		"trade_action_id" 	 	=> $trade_action_id,
		    		"transf_amount" 	 	=> (float)$transfers[$i][4],
		    		"transf_currency" 	 	=> $transfers[$i][3],
		    		"transf_disposal_total" => $transf_disposal_total,
		    		"value_homecurr"		=> $rate * (float)$transfers[$i][4],
		    		"fee"					=> $transfers[$i][2]=="Withdraw"? $fees[$transfers[$i][3]] * $rate : 0,
		    		"txid"				 	=> $this->is_coin($transfers[$i][3]) == true?$this->get_txid($transfers[$i][5]):"",
		    		"is_disposal"			=> (float)$transfers[$i][4] > 0 ? 1 : 0, // bugs
		    		"reason"				=> "Awaiting input"//bugs
		    	);	    	
				$this->db->insert($dbname, $data_array);
			}
		}
		return $trade_action_id;
	}

	function Bankhistory($banks, $user_id, $client, $exchange, $trade_action_id){
		$dbname = "cf_global_trade_banktransfer";
		for ($i = 0 ; $i < count($banks) ; $i++){
			$query = array(
				"Timestamp"			 	=> $banks[$i][0],
	    		"user_id"   		 	=> $user_id,
	    		"client_id"			 	=> $client,
	    		"exchange"  		 	=> $exchange,
	    		"transf_amount" 	 	=> (float)$banks[$i][4],
	    		"transf_currency" 	 	=> $banks[$i][3]
			);
			$result = $this->db->get_where($dbname, $query)->result();
			// if the record is already existed 
            if(count($result) > 0){
            }else{
            	$trade_action_id = $trade_action_id + 1;
				$data_array = array(
		    		"Timestamp"			 	=> $banks[$i][0],
		    		"user_id"   		 	=> $user_id,
		    		"client_id"			 	=> $client,
		    		"exchange"  		 	=> $exchange,
		    		"trade_action_id" 	 	=> $trade_action_id,
		    		"transf_amount" 	 	=> (float)$banks[$i][4],
		    		"transf_currency" 	 	=> $banks[$i][3],
		    		"value_homecurr"		=> 0,//bugs
		    		"fee"					=> 0,//bugs
		    	);
				$this->db->insert($dbname, $data_array);
			}
		}
	}

	public function upload_BCTMarket($csvFile,$history,$client, $exchange="BTC market"){
		$trades 	= [];
		$transfers 	= [];
		$banks 		= [];

		//parse data from csv file line by line
		$current_user_id = get_client_user_id();

    	while(($line = fgetcsv($csvFile)) !== FALSE){
        	$insert_array = array(
    			'user_id' => $current_user_id,
    			'creationtime' => strtotime($line[0]),
    			'recordType' => $line[1],
    			'action' => $line[2],
    			'currency' => $line[3],
    			'amount' => (float)$line[4],
    			'desciption' => $line[5],
    			'referenceId' => $line[6]
    		);
    		
            //check whether member already exists in database with same email
            $result = $this->db->get_where("cf_upload_btc_csv_temp", $insert_array)->result();
            if(count($result) > 0){
                //do nothing if the record exists
            }else{
                //insert member data into database
                $this->db->insert("cf_upload_btc_csv_temp", $insert_array);
            }
            // put data to transaction_ledger
            if ($line[1] == "Trade")
            	array_push($trades, $line);
            else if ($this->is_coin($line[3]) == true)
            	array_push($transfers, $line);
            else
            	array_push($banks, $line);
        }
        $trade_action_id = $this->get_trade_action_id();
        $trade_action_id = $this->Tradehistory($trades, $current_user_id, $client, $exchange, $trade_action_id);
        $trade_action_id = $this->Transferhistory($transfers, $current_user_id, $client, $exchange, $trade_action_id);
        $trade_action_id = $this->Bankhistory($banks, $current_user_id, $client, $exchange, $trade_action_id);
	}

	public function upload(){
		$csvMimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
		$lines = [];
	    if(!empty($_FILES['file']) && in_array($_FILES['file']['type'],$csvMimes)){	    	
	        if(is_uploaded_file($_FILES['file']['tmp_name'])){
	        	$exchange = $this->input->post('exchange');
	        	$history  = $this->input->post('history');
	        	$client   = $this->input->post('client');

	            //open uploaded csv file with read only mode
	            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
	            // skip first line
	            // if your csv file have no heading, just comment the next line
	            fgetcsv($csvFile);
	            if ($exchange == "BTC market")	            
	            	$this->upload_BCTMarket($csvFile,$history,$client);	            
	            //close opened csv file
	            fclose($csvFile);
	            $qstring["status"] = 'Success';
	            header('Location: '.base_url().'?/Private_www/upload_data/success');
	            exit();
	        }else{
	            $qstring["status"] = 'Error';
	        }
	    }else{
	        $qstring["status"] = 'Invalid file';
	    }
	    var_dump("file not existed");exit();
	    header('Location: '.base_url().'?/Private_www/upload_data/failed');
	}
	
}