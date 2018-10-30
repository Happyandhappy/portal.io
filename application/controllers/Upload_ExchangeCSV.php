<?php defined('BASEPATH') or exit('direct access is not permitted');

class Upload_ExchangeCSV extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function is_coin($currency){
		$res = $this->db->get_where("cf_coin_list", array('coin_short' => $currency))->result();
		if (count($res) > 0) return true;
		else return false;		
	}

	public function get_txid($str){
		if (strpos($str, ": 0x") > 0){
			$strs = explode(": ", $str);
			return $strs[1];
		}
		return "";		
	}

	public function get_trade_action_id(){		
		$last_row = $this->db->order_by('id',"desc")
            ->limit(1)
            ->get('cf_transaction_ledger')
            ->row();
        if (isset($last_row))
        	return $last_row->id;
        else 1;
	}

	public function upload(){
		$csvMimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
	    if(!empty($_FILES['file']) && in_array($_FILES['file']['type'],$csvMimes)){
	        if(is_uploaded_file($_FILES['file']['tmp_name'])){
	        	$exchange = $this->input->post('exchange');
	        	$history  = $this->input->post('history');
	            //open uploaded csv file with read only mode
	            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
	            // skip first line
	            // if your csv file have no heading, just comment the next line
	            fgetcsv($csvFile);
	            //parse data from csv file line by line
	            while(($line = fgetcsv($csvFile)) !== FALSE){
	            	$current_user_id = get_client_user_id();
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
                		// put data to transaction_ledger
		        		$data_array = array(
		            		"Timestamp"			 => $line[0],
		            		"user_id"   		 => $current_user_id,
		            		"exchange"  		 => "BTCMarkets",
		            		"unique_exchange_id" => ctype_digit ($line[6]) == true ? $line[6]:$line[7],
		            		"trade_action_id" 	 => $this->get_trade_action_id() == null ? 1 : $this->get_trade_action_id(),
		            		"transf_amount" 	 => (float)$line[4],
		            		"transf_currency" 	 => $line[3],
		            		"is_coin"   		 => $this->is_coin($line[3]),
		            		"value_homecurr"  	 => 1,
		            		"txid"				 => $this->is_coin($line[3]) == true?$this->get_txid($line[5]):"",
		            		"reason" 			 => ""
		            	);
		            	
						$this->db->insert("cf_transaction_ledger", $data_array);
	                }
	            }
	            //close opened csv file
	            fclose($csvFile);
	            $qstring["status"] = 'Success';
	            header('Location: '.base_url().'?/Private_www/enter_coins/success');
	            exit();
	        }else{
	            $qstring["status"] = 'Error';
	        }
	    }else{
	        $qstring["status"] = 'Invalid file';
	    }
	    header('Location: '.base_url().'?/Private_www/enter_coins/failed');
	}
	
}