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
$firstname = $_REQUEST['firstname'];
$lastname = $_REQUEST['lastname'];
$email = $_REQUEST['email'];
$phonenumber = $_REQUEST['phonenumber'];

//
// check if exist clientid
//
$query = $this->db->get_where('tblcontacts', array(
            'id' => $clientid
            ));
$count = $query->num_rows(); 
if ($count != 0) {
    $client = array(
        'firstname' => $firstname,
        'lastname' => $lastname,
        'email' => $email,
        'phonenumber' => $phonenumber,
        'datecreated' => date('Y-m-d H:i:s')
    );
    $this->db->where('id', $clientid);
    $this->db->update('tblcontacts', $client);
    
    $data = array(
        'message' => "OK",
        'success' => true,
        'data' => $client
    );
} else {
    $data = array(
        'message' => "Not exist the client ID." . $clientid,
        'success' => false
    );
}
echo json_encode($data);
?>