<?php
require_once dirname(__DIR__).'/Core/init.php';
$database = new Database($connection);
$verify = new Fetch($connection);
$link = new Functions();

if(Inputs::submitType()) {
    $id =  intval(Inputs::assignValue('id'));
    $full_name = Inputs::assignValue('full_name');
    $email = Inputs::assignValue('email');
    $old_password = Inputs::assignValue('old_password');
    $password = Inputs::assignValue('password');
    $confirm_password = Inputs::assignValue('confirm_password');
    $updated_at = date('Y-m-d H:i:s');

    //check for duplicate email
    $duplicate_email = $verify->getSingleData('SELECT id', 'users', array('email', '=', $email));
    if($duplicate_email->id != $id && !empty($duplicate_email)){
        $_SESSION['error'] = 'Your new email: '.$email. 'already exists';
        $link->redirect('../admin/profile.php');
    } else {
        //check if existing password matches the old password taken from the user
        $check_old_password = $verify->getSingleData('SELECT password', 'users', array('id', '=', $id));
        if(false === password_verify($old_password, $check_old_password->password)) {
            $_SESSION['error'] = 'Invalid old password';
            $link->redirect('../admin/profile.php');
        } else {
            //check if password matches and proceed
            if($password === $confirm_password){
                //encrypt password
                $password = password_hash($password, PASSWORD_BCRYPT);

                //populate the database
                $database->update('users', $id, array(
                    'full_name' => $full_name,
                    'email' => $email,
                    'password' => $password,
                    'updated_at' => $updated_at
                ));

                //success message
                $_SESSION['success'] = 'Account update successfully.';
                //redirect
                $link->redirect('../admin/profile.php');
            }
        }
    }

} else {
    die('Requested page not found');
}