<?php
/**
 * Blocking Intruders
 */
if (ACCESSED_DIRECTLY) die("Direct access are not allowed.");

/**
 * MySQL Configuration
 */
define("HOSTNAME", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");
define("DATABASE", "timer");

/**
 * Establishing MySQL Connection
 */
$connect = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);

if (!$connect) {

    die(mysqli_error());

}

?>