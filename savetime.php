<?php
/**
 * Blocking Intruders
 */
if (ACCESSED_DIRECTLY) die("Direct access are not allowed.");

/**
 * Includes
 */
include("resources/config.php");

/**
 * Variables to get the time and task posted by the user
 * @var [type] $_POST
 */
$time = $_POST['time'];
$task_desc = $_POST['task'];
$total_time = mysqli_real_escape_string($connect, $time);
$date = time();

/**
 * Inserting the data into the Database
 */
if (mysqli_query($connect, "INSERT INTO times (date, task_desc, time) VALUES ('$date', '$task_desc', '$total_time')")) {

    echo "Successfully Inserted";

} else {

    echo "Insertion Failed";

}

?>