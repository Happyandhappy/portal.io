<?php defined('BASEPATH') or exit('direct access is not permitted');

class Upload_ExchangeCSV extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function post_btc_market(){
		$csvMimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
	    if(!empty($_FILES['file']) && in_array($_FILES['file']['type'],$csvMimes)){
	        if(is_uploaded_file($_FILES['file']['tmp_name'])){
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
	                $result = $this->db->get_where("upload_btc_csv_temp", $insert_array)->result();
	                if(count($result) > 0){
	                    //do nothing if the record exists
	                }else{
	                    //insert member data into database
	                    $this->db->insert("upload_btc_csv_temp", $insert_array);
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