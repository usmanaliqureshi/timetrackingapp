<?php

session_destroy();

require_once("resources/functions.php");

$timeApp = new timeApp();

$timeApp->redirect();