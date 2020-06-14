<?php
require_once dirname(__DIR__).'/Core/init.php';
$database = new Database($connection);

if(Inputs::submitType()) {
    $name = Inputs::assignValue('name');
    $created_at = date('Y-m-d H:i:s');

    //insert values
    $database->insert('programmes', array(
        'name' => $name,
        'created_at' => $created_at
    ));

    //success message
    $_SESSION['success'] = 'Programme created successfully.';
    //redirect
    header('location: ../admin/programmes.php');
} else {
    die('Requested page not found');
}