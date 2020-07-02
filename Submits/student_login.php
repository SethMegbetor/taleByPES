<?php
require_once dirname(__DIR__).'/Core/init.php';
$data = new Fetch($connection);
$link = new Functions();

if(Inputs::submitType()){
  $email = Inputs::assignValue('email');
  $password = Inputs::assignValue('password');

  $login = new StudentLogin($connection, $email, $password);

  //check whether user is an admin
  if($login->authenticate('students')) {
    $user = $login->getAccount();
    //$switch_user = $user->category_id;

      $_SESSION['student'] = $user->id;
      $_SESSION['student_name'] = $user->full_name;
      $_SESSION['student_grade_id'] = $user->grade_id;
      $link->redirect('../student/index.php');
  }

  //check if there is an error and display them
  if(!$login->authenticate('students')) {
    $_SESSION['error'] = $login->getError();
    $link->redirect('../student_login.php');
  }


} else {
  die('Requested page not found');
}