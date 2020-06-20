<?php
require_once dirname(__DIR__).'/Core/init.php';
$database = new Database($connection);
$verification = new Fetch($connection);
$router = new Functions();

if(Inputs::submitType()) {
  $faculty_id = intval(Inputs::assignValue('faculty_id'));
  $course_id = intval(Inputs::assignValue('course_id'));
  $student_id = intval(Inputs::assignValue('student_id'));
  $attendance = Inputs::assignValue('attendance');
  $date = date('Y-m-d');

  //check attendance value
  foreach ($attendance as $key => $value) {
    //value equals 1
    if($value == 1) {
      //insert fields into the database
      $database->insert('student_attendance', array(
        'student_id' => $key,
        'faculty_id' => $faculty_id,
        'course_id' => $course_id,
        'attendance_id' => 1,
        'date' => $date
      ));

    } else {
      //value equals 2
      //insert fields into the database
      $database->insert('student_attendance', array(
        'student_id' => $key,
        'faculty_id' => $faculty_id,
        'course_id' => $course_id,
        'attendance_id' => 2,
        'date' => $date
      ));
    }
  }


  //flash a message
  $_SESSION['success'] = 'Attendance taken successfully.';

  //redirect
  $router->redirect('../faculty/attendance.php');


} else {
  die('Requested Page not found');
}