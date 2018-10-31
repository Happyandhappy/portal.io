<?php

$query = $this->db->query("select * from tblcontacts where userid=" . get_client_user_id());

$data['data'] = [];
$i = 0;
foreach ($query->result() as $row)
{
  $i++;
    $data['data'][] = array(
      $row->id,
    $i,
      $row->firstname,
      $row->lastname,
      $row->email,
      $row->phonenumber,
      $row->active,
      "<a href='javascript:edit_client(&apos;" . $row->id . "&apos;,&apos;" . $row->firstname . "&apos;,&apos;" . $row->lastname . "&apos;,&apos;" . $row->email . "&apos;,&apos;" . $row->phonenumber . "&apos;);' class='label' data-id=" . $row->id . " style='cursor: pointer;color:#00bb3b;'>Edit</a>|<a href='javascript:delete_client(" . $row->id . ");' class='label' data-id=" . $row->id . " style='cursor: pointer;color:red;'>Delete</a>"
      );
}

echo json_encode($data);

?>