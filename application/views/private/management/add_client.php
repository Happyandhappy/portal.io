<?php

$data['message'] = "";
$data['success'] = false;
$data['data'] = [];

if(isset($_REQUEST['email']) == false) {
    $data['message'] = "Email was not given.";
    $data['success'] = false;
    echo json_encode($data);
    return;
}

$firstname = $_REQUEST['firstname'];
$lastname = $_REQUEST['lastname'];
$email = $_REQUEST['email'];
$phonenumber = $_REQUEST['phonenumber'];

//
// check if exist email
//
$query = $this->db->get_where('tblcontacts', array(
            'email' => $email
            ));
$count = $query->num_rows(); 
if ($count === 0) {
    $client = array(
        'firstname' => $firstname,
        'lastname' => $lastname,
        'email' => $email,
        'phonenumber' => $phonenumber,
        'datecreated' => date('Y-m-d H:i:s'),
        'userid' => get_client_user_id(),
        'is_primary' => 0,
        'active'=>1,
        'invoice_emails' => 0,
        'estimate_emails' => 0,
        'credit_note_emails' => 0,
        'contract_emails' => 0,
        'task_emails' => 0,
        'Project_emails' => 0
    );
    $this->db->insert('tblcontacts', $client);
    
    $data = array(
        'message' => "OK",
        'success' => true,
        'data' => $client
    );
} else {
    $data = array(
        'message' => "Duplicated email: " . $email,
        'success' => false
    );
}
echo json_encode($data);


?>