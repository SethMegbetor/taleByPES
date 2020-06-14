<?php
require_once dirname(__DIR__).'/Core/init.php';
$database = new Database($connection);

if(Inputs::submitType()) {
    $course_code = Inputs::assignValue('course_code');
    $course_name = Inputs::assignValue('course_name');
    $created_at = date('Y-m-d H:i:s');

    //insert values
    $database->insert('courses', array(
        'course_code' => $course_code,
        'course_name' => $course_name,
        'created_at' => $created_at
    ));

    //success message
    $_SESSION['success'] = 'Course created successfully.';
    //redirect
    header('location: ../admin/courses.php');
} else {
    die('Requested page not found');
}