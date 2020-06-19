<?php
require_once dirname(__DIR__).'/Core/init.php'; 
$database = new Database($connection);

if(Inputs::submitType()){
  $full_name = Inputs::assignValue('full_name');
  $index_no = Inputs::assignValue('index_no');
  $department_id = intval(Inputs::assignValue('department_id'));
  $level_id = intval(Inputs::assignValue('level_id'));
  $programme_id = intval(Inputs::assignValue('programme_id'));
  $email = Inputs::assignValue('email');
  $campus_id = intval(Inputs::assignValue('campus_id'));
  $grade_id = intval(Inputs::assignValue('grade_id'));
  $address = Inputs::assignValue('address');
  $password = password_hash($index_no, PASSWORD_BCRYPT);
  $created_at = date('Y-m-d H:i:s');

  //insert values
  $database->insert('students', array(
    'full_name' => $full_name,
    'index_no' => $index_no,
    'department_id' => $department_id,
    'level_id' => $level_id,
    'programme_id' => $programme_id,
    'email' => $email,
    'campus_id' => $campus_id,
    'grade_id' => $grade_id,
    'address' => $address,
    'password' => $password,
    'created_at' => $created_at
  ));

  //flash a message
  $_SESSION['success'] = 'Student successfully added';

  //redirect
  header('location: ../admin/students.php');

} else {
  die('Requested page not found');
}