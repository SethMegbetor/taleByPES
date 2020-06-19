<?php
require_once dirname(__DIR__).'/Core/init.php';
$database = new Database($connection);

if(Inputs::submitType()) {
    $full_name = Inputs::assignValue('full_name');
    $department_id = intval(Inputs::assignValue('department_id'));
    $category_id = intval(Inputs::assignValue('category_id'));
    $email = Inputs::assignValue('email');
    $status_id = intval(Inputs::assignValue('status_id'));
    $grade_id = intval(Inputs::assignValue('grade_id'));
    $password = Inputs::assignValue('password');
    $confirm_password = Inputs::assignValue('confirm_password');
    $created_at = date('Y-m-d H:i:s');

    //check if password matches and proceed
    if($password === $confirm_password){
        //encrypt password
        $password = password_hash($password, PASSWORD_BCRYPT);

        //populate the database
        $database->insert('users', array(
            'full_name' => $full_name,
            'department_id' => $department_id,
            'category_id' => $category_id,
            'grade_id' => $grade_id,
            'email' => $email,
            'account_status' => $status_id,
            'password' => $password,
            'created_at' => $created_at
        ));

        //success message
        $_SESSION['success'] = 'User account created successfully.';
        //redirect
        header('location: ../admin/users.php');
    } 

} else {
    die('Requested page not found');
}