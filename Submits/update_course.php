<?php
require_once dirname(__DIR__).'/Core/init.php';
$database = new Database($connection);

if(Inputs::submitType()) {
    $id = intval(Inputs::assignValue('id'));
    $course_code = Inputs::assignValue('course_code');
    $course_name = Inputs::assignValue('course_name');
    $updated_at = date('Y-m-d H:i:s');

    //insert values
    $database->update('courses', $id, array(
        'course_code' => $course_code,
        'course_name' => $course_name,
        'updated_at' => $updated_at
    ));

    //success message
    $_SESSION['success'] = 'Changes has been saved successfully.';
    //redirect
    header('location: ../admin/courses.php');
} else {
    die('Requested page not found');
}