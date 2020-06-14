<?php
require_once dirname(__DIR__).'/Core/init.php';
$data = new Fetch($connection);
$link = new Functions();

if(Inputs::submitType()){
  $email = Inputs::assignValue('email');
  $password = Inputs::assignValue('password');

  //  $password = password_hash($password, PASSWORD_DEFAULT);

  //   var_dump($password);exit();

  $login = new Login($connection, $email, $password);

  //check whether user is an admin
  if($login->authenticate('users')) {
    $user = $login->getAccount();
    $switch_user = $user->category_id;

    //redirect user based on their category
    if($switch_user == 1) {
      //administrator
      $_SESSION['admin'] = $user->id;
      $_SESSION['admin_name'] = $user->full_name;
      $link->redirect('../admin/index.php');
    } else {
      //faculty
      $_SESSION['faculty'] = $user->id;
      $_SESSION['faculty_name'] = $user->full_name;
      $link->redirect('../faculty/index.php');
    }
  }

  //check if there is an error and display them
  if(!$login->authenticate('users')) {
    $_SESSION['error'] = $login->getError();
    $link->redirect('../index.php');
  }


} else {
  die('Requested page not found');
}