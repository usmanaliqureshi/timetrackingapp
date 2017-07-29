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
$username = $_POST['username'];
$password = $_POST['password'];

$timeApp = new timeApp();
$timeApp->login($username, $password);
