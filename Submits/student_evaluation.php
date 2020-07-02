<?php
require_once dirname(__DIR__).'/Core/init.php';
$database = new Database($connection);
$link = new Functions();

if(Inputs::submitType()) {
  $student_id = intval(Inputs::assignValue('student_id'));
  $faculty_id = intval(Inputs::assignValue('faculty_id'));
  $icon1 = intval(Inputs::assignValue('icon1'));
  $icon2 = intval(Inputs::assignValue('icon2'));
  $icon3 = intval(Inputs::assignValue('icon3'));
  $icon4 = intval(Inputs::assignValue('icon4'));
  $icon5 = intval(Inputs::assignValue('icon5'));
  $comment = Inputs::assignValue('comment');
  $created_at = date('Y-m-d H:i:s');

  //insert values
  $database->insert('evaluation', array(
    'student_id' => $student_id,
    'faculty_id' => $faculty_id,
    'q1' => $icon1,
    'q2' => $icon2,
    'q3' => $icon3,
    'q4' => $icon4,
    'q5' => $icon5,
    'comments' => $comment,
    'created_at' => $created_at
  ));

  //success message
  $_SESSION['success'] = 'Your Evaluation has been recorded successfully';

  //redirect
  $link->redirect('../student/evaluate.php');

} else {
  die('Requested Page not found');
}