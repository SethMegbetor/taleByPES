<?php
require_once dirname(__DIR__).'/Core/init.php';
$database = new Database($connection);

if(Inputs::submitType()) {
    $id = intval(Inputs::assignValue('id'));
    $full_name = Inputs::assignValue('full_name');
    $department_id = intval(Inputs::assignValue('department_id'));
    $category_id = intval(Inputs::assignValue('category_id'));
    $email = Inputs::assignValue('email');
    $status_id = intval(Inputs::assignValue('status_id'));
    $updated_at = date('Y-m-d H:i:s');

    //update values
    $database->update('users', $id, array(
        'full_name' => $full_name,
        'department_id' => $department_id,
        'category_id' => $category_id,
        'email' => $email,
        'account_status' => $status_id,
        'updated_at' => $updated_at
    ));

    //success message
    $_SESSION['success'] = 'Account update successfully.';
    //redirect
    header('location: ../admin/users.php');

} else {
    die('Requested page not found');
}