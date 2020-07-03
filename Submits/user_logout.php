<?php 
require_once dirname(__DIR__).'/Core/init.php';
$link = new Functions();

session_start();

session_unset();

session_destroy();

$link->redirect('../student_login.php');