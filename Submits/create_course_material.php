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
    $filename = $_FILES["file"]["name"];
    
    //get file extension
    $file_basename = substr($file_basename, 0, stripos($filename, '.'));

    //get file name
    $file_ext = substr($filename, stripos($filename, '.'));

    //get file size
    $file_size = $_FILES["file"]["size"];

    //allowed extension type
    $allowed_file_types = array('.doc', '.docx', '.rtf', '.pdf', '.ppt', '.xlsx', '.txt');

    //check file size
    if(in_array($file_ext, $allowed_file_types) && ($file_size < 200000)) {
      //rename file
      // $new_filename = md5($file_basename) . $file_ext;

      $new_filename = md5($return->generateString($file_basename, 20)) . $file_ext;

      if(file_exists("../uploads/course_materials/" . $new_filename)) {
        //file already exists
        $_SESSION['error'] = 'You have already uploaded this file.';
        $return->redirect('../faculty/create_course_material.php');
        exit();
      } else {

        //move file to its destination
        move_uploaded_file($_FILES["file"]["tmp_name"], "../uploads/course_materials/" . $new_filename);

        //insert values into the database
        $database->insert('course_materials', array(
          'title' => $title,
          'course_id' => $course_id,
          'semester_id' => $semester_id,
          'academic_id' => $academic_id,
          'file' => $new_filename,
          'faculty_id' => $id,
          'created_at' => $created_at
        ));

        //success message
        $_SESSION['success'] = 'Course material uploaded successfully.';
        $return->redirect('../faculty/course_materials.php');

      }
      
    } elseif (empty($file_basename)) {

      //file selection error
      $_SESSION['error'] = 'Please select a file to upload';
      $return->redirect('../faculty/create_course_material.php');
      exit();

    } elseif ($file_size > 200000) {

      //file size error
      $_SESSION['error'] = 'The file you are trying to upload is too large.';
      $return->redirect('../faculty/create_course_material.php');
      exit();

    } else {

      //file type error
      $_SESSION['error'] = 'You have already uploaded this file.';
      
      //remove file
      unlink($_FILES["file"]["tmp_name"]);
      
      $return->redirect('../faculty/create_course_material.php');
      exit();

    }
  }

} else {
  die('Requested Page not found');
}