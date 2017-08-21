<?php

session_start();

/**
 * Includes
 */
require_once("resources/functions.php");

/**
 * Variables to get the time and task posted by the user
 * @var [type] $_POST
 */
$name = $_POST['name'];
$email = $_POST['email'];
$designation = $_POST['designation'];
$experience = $_POST['experience'];
$skills = $_POST['skills'];

$timeApp = new timeApp();
$timeApp->save_the_profile($name, $email, $designation, $experience, $skills);
