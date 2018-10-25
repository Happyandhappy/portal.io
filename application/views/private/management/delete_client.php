<?php

$data['message'] = "";
$data['success'] = false;
$data['data'] = [];

if(isset($_REQUEST['clientid']) == false) {
	$data['message'] = "Not provided client ID.";
	$data['success'] = false;
	echo json_encode($data);
	return;
}

$clientid = $_REQUEST['clientid'];
//
// check if exist clientid
//
$query = $this->db->get_where('tblcontacts', array(
            'id' => $clientid
            ));
$count = $query->num_rows(); 
if ($count != 0) {
    $this->db->where('id', $clientid);
    $this->db->delete('tblcontacts');
    $data = array(
        'message' => "OK",
        'success' => true,
        'data' => $clientid
    );
} else {
	$data = array(
        'message' => "Not exist the client ID." . $clientid,
        'success' => false
    );
}
echo json_encode($data);


?>