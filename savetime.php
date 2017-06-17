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
$time = $_POST['time'];
$task_desc = $_POST['task'];
$date = time();
$user_id = $_POST['user_id'];

$timeApp = new timeApp();
$timeApp->save_the_task($task_desc, $time, $date, $user_id);