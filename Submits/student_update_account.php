<?php
require_once dirname(__DIR__).'/Core/init.php';
$database = new Database($connection);
$verify = new Fetch($connection);
$link = new Functions();

if (Inputs::submitType()) {
  $id = intval(Inputs::assignValue('id'));
  $old_password = Inputs::assignValue('old_password');
  $password = Inputs::assignValue('password');
  $confirm_password = Inputs::assignValue('confirm_password');
  $updated_at = date('Y-m-d H:i:s');

  //check if old password matches
  $check_old_password = $verify->getSingleData('SELECT password', 'students', array('id', '=', $id));

  if (false === password_verify($old_password, $check_old_password->password)) {
    
    $_SESSION['error'] = 'Invalid old password';
    $link->redirect('../student/profile.php');

  } else {

    if ($password === $confirm_password) {
      #encrypt password 
      $password = password_hash($password, PASSWORD_BCRYPT);

      # update values
      $database->update('students', $id, array(
        'password' => $password,
        'updated_at' => $updated_at
      ));

      //success message
      $_SESSION['success'] = 'Account update successfully.';
      //redirect
      $link->redirect('../student/profile.php');
    }
  }

} else {
  die('Requested page not found');
}