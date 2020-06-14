<?php
require_once dirname(__DIR__).'/Core/init.php'; 
$database = new Database($connection);

if(Inputs::submitType()){
  $id = intval(Inputs::assignValue('id'));
  $full_name = Inputs::assignValue('full_name');
  $index_no = Inputs::assignValue('index_no');
  $department_id = intval(Inputs::assignValue('department_id'));
  $level_id = intval(Inputs::assignValue('level_id'));
  $programme_id = intval(Inputs::assignValue('programme_id'));
  $email = Inputs::assignValue('email');
  $campus_id = intval(Inputs::assignValue('campus_id'));
  $address = Inputs::assignValue('address');
  $updated_at = date('Y-m-d H:i:s');

  //insert values
  $database->update('students', $id, array(
    'full_name' => $full_name,
    'index_no' => $index_no,
    'department_id' => $department_id,
    'level_id' => $level_id,
    'programme_id' => $programme_id,
    'email' => $email,
    'campus_id' => $campus_id,
    'address' => $address,
    'updated_at' => $updated_at
  ));

  //flash a message
  $_SESSION['success'] = 'Changes has been saved successfully';

  //redirect
  header('location: ../admin/students.php');

} else {
  die('Requested page not found');
}