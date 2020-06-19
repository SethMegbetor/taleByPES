<?php
require_once dirname(__DIR__).'/Core/init.php';
$database = new Database($connection);

//delete user
if(isset($_GET['user_id'])) {
    $id = $_GET['user_id'];

    $database->delete('users', array('id', '=', $id));

    //success message
    $_SESSION['success'] = 'User deleted successfully';
    //redirect
    header('location: ../admin/users.php');
    exit();
}


//delete course
if(isset($_GET['course_id'])) {
    $id = $_GET['course_id'];

    $database->delete('courses', array('id', '=', $id));

    //success message
    $_SESSION['success'] = 'Course deleted successfully';
    //redirect
    header('location: ../admin/courses.php');
    exit();
}



//delete programme
if(isset($_GET['programme_id'])) {
    $id = $_GET['programme_id'];

    $database->delete('programmes', array('id', '=', $id));

    //success message
    $_SESSION['success'] = 'Programme deleted successfully';
    //redirect
    header('location: ../admin/programmes.php');
    exit();
}



//delete student
if(isset($_GET['student_id'])) {
    $id = $_GET['student_id'];

    $database->delete('students', array('id', '=', $id));

    //success message
    $_SESSION['success'] = 'Student account deleted successfully';
    //redirect
    header('location: ../admin/students.php');
    exit();
}



//delete course material
if(isset($_GET['file_id'])) {
    $id = $_GET['file_id'];

    $database->delete('course_materials', array('id', '=', $id));

    //success message
    $_SESSION['success'] = 'Course material deleted successfully';
    //redirect
    header('location: ../faculty/course_materials.php');
    exit();
}

