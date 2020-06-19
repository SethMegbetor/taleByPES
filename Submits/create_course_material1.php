<?php
require_once dirname(__DIR__).'/Core/init.php';
$database = new Database($connection);
$return = new Functions();

if(Inputs::submitType()){
  $id = intval(Inputs::assignValue('id'));
  $title = Inputs::assignValue('title');
  $course_id = intval(Inputs::assignValue('course_id'));
  $semester_id = intval(Inputs::assignValue('semester_id'));
  $academic_id = intval(Inputs::assignValue('academic_id'));
  $created_at = date('Y-m-d H:i:s');

  if(isset($_FILES['file'])){
    $file_name = $_FILES['file']['name'];
    $file_tmp_name = $_FILES['file']['tmp_name'];
    $file_type = $_FILES['file']['type'];
    $file_size = $_FILES['file']['size'];
    $error = $_FILES['file']['error'];
  
    //check if file selection is successfull
    if(!$file_tmp_name){
        //flash a message
        $_SESSION['error'] = 'No file Selected.';
        //redirect
        $return->redirect('../faculty/create_course_materials.php');
        exit();
    }
  
    //move files to their destination
    $destination = move_uploaded_file($file_tmp_name, '../uploads/course_materials/'.$file_name);
  
    //check if file upload has failed
    if(!$destination){
        //flash a message
        $_SESSION['error'] = 'File upload not successfull.';
        //redirect
        $return->redirect('../faculty/create_course_material.php');
        exit();
    }
  }

  //insert values into the database
  $database->insert('course_materials', array(
    'title' => $title,
    'course_id' => $course_id,
    'semester_id' => $semester_id,
    'academic_id' => $academic_id,
    'file' => $file_name,
    'faculty_id' => $id,
    'created_at' => $created_at
  ));

  //flash a message
  $_SESSION['success'] = 'File upload was successfull.';
  //redirect
  $return->redirect('../faculty /course_materials.php');


} else {
  die('Requested Page not found');
}






