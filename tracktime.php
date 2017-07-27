<?php

session_start();

require_once("resources/functions.php");

$timeApp = new timeApp();

if ($timeApp->is_logged_in()) {

?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <title>Track Time</title>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Time Tracking App - Login</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" type="text/css" href="assets/css/layout.css"/>

    </head>

    <body>

        <div id="form-container">
            <form id="timeApp" action="savetime.php" method="POST">

                <h2 class="countdown">00:00:00</h2>
                <input type="text" id="task" name="task" placeholder="Task Description">
                <input type="hidden" id="time" name="time" value="">
                <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION["user_id"]; ?>">
                <input type="button" value="SAVE" id="sendata" class="btn"/>

            </form>

            <br>

            <input type="button" value="Start" id="start" class="btn timeAppbtn"/>
            <input type="button" value="Pause" id="pause" class="btn timeAppbtn"/>
            <input type="button" value="Stop" id="stop" class="btn timeAppbtn"/>
            <input type="button" value="Reset" id="reset" class="btn timeAppbtn"/>

            <br>
            <br>

            <span id="status">READY TO START</span>

            <br>

            <span id="result"></span>

            <br>

            <span id="user"><a class="logout" href="logout.php">LOGOUT</a></span>

            <br/><br/>

            <span>Logged in as: <b><?php echo $_SESSION["user"]; ?></b></span>

        </div>

        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>

        <script type="text/javascript" src="assets/js/timer.js"></script>

    </body>

</html>

<?php } else {

    $timeApp->redirect();

}

?>