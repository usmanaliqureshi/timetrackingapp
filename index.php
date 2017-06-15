<?php include("resources/config.php"); ?>

<!DOCTYPE html>

<head>

    <title>Track Time</title>

    <link rel="stylesheet" type="text/css" href="assets/css/style.css"/>

    <script type='text/javascript' src='http://code.jquery.com/jquery-1.5.2.js'></script>

</head>

<body>

<div style="display: table;margin: 15% auto 0 auto;">

    <form id="timeApp" action="savetime.php" method="POST" style="margin: 0;">

        <h1>Stopwatch</h1>

        <h2>
            <time>00:00:00</time>
        </h2>

        <input type="text" id="task" name="task" placeholder="Please enter task description" style="width: 175px; text-align: left">

        <input type="hidden" id="time" name="time" value="">

        <input type="button" value="SAVE" id="sendata"/>

    </form>

    <br>

    <input type="button" value="Start" id="start"/>

    <input type="button" value="Pause" id="pause"/>

    <input type="button" value="Stop" id="stop"/>

    <input type="button" value="Reset" id="reset"/>

    <br>
    <br>

    <span id="status">READY TO START</span>

    <br>

    <span id="result"></span>

    <br>

</div>

<script type="text/javascript" src="assets/js/timer.js"></script>

</body>

</html>