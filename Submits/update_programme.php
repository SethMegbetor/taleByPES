<?php
require_once dirname(__DIR__).'/Core/init.php';
$database = new Database($connection);

if(Inputs::submitType()) {
    $id = intval(Inputs::assignValue('id'));
    $name = Inputs::assignValue('name');
    $updated_at = date('Y-m-d H:i:s');

    //insert values
    $database->update('programmes', $id, array(
        'name' => $name,
        'updated_at' => $updated_at
    ));

    //success message
    $_SESSION['success'] = 'Changes has been saved successfully.';
    //redirect
    header('location: ../admin/programmes.php');
} else {
    die('Requested page not found');
}