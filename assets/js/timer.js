/**
 * Name: Time Tracking App
 * Author: Usman Ali Qureshi
 * Version: 1.0
 * Description: This script is a mix of Javascript and jQuery.
 */

/**
 *  Variables
 */
var h1 = document.getElementsByTagName('h2')[0],
    start = document.getElementById('start'),
    pause = document.getElementById('pause'),
    stop = document.getElementById('stop'),
    reset = document.getElementById('reset'),
    time = document.getElementById('time'),
    timeApp = document.getElementById('timeApp'),
    sendbtn = document.getElementById('sendata'),
    result = document.getElementById('result'),
    task = document.forms["timeApp"]["task"],
    seconds = 0,
    minutes = 0,
    hours = 0,
    stopwatch;

/**
 * Main Interval to make the Loop
 */
function timer() {

    stopwatch = setInterval(Loop, 1000);

}

/**
 *  The loop
 */
function Loop() {
    seconds++;
    if (seconds >= 60) {
        seconds = 0;
        minutes++;
        if (minutes >= 60) {
            minutes = 0;
            hours++;
        }
    }

    h1.textContent = (hours ? (hours > 9 ? hours : "0" + hours) : "00") + ":" + (minutes ? (minutes > 9 ? minutes : "0" + minutes) : "00") + ":" + (seconds > 9 ? seconds : "0" + seconds);

    time.value = (hours ? (hours > 9 ? hours : "0" + hours) : "00") + ":" + (minutes ? (minutes > 9 ? minutes : "0" + minutes) : "00") + ":" + (seconds > 9 ? seconds : "0" + seconds);

}

/**
 * Disabling the Reset button by default
 * @type {Boolean}
 */
reset.disabled = true;

/**
 * onClick event for Start button
 */
start.onclick = function () {
    timer();
    start.disabled = true;
    stop.disabled = false;
    pause.disabled = false;
    reset.disabled = true;
    document.getElementById('status').innerHTML = "RUNNING";
};

/**
 *  onClick event for Pause button
 */
pause.onclick = function () {
    clearTimeout(stopwatch);
    start.innerText = "RESUME";
    pause.disabled = true;
    start.disabled = false;
    reset.disabled = false;
    document.getElementById('status').innerHTML = "PAUSED";
};

/**
 *  onClick event for Stop button
 */
stop.onclick = function () {
    clearTimeout(stopwatch);
    h1.textContent = "00:00:00";
    seconds = 0;
    minutes = 0;
    hours = 0;
    start.innerText = "RESTART";
    stop.disabled = true;
    pause.disabled = false;
    start.disabled = false;
    reset.disabled = false;
    document.getElementById('status').innerHTML = "STOPPED";
};

/**
 *  onClick event for Reset button
 */
reset.onclick = function () {
    clearTimeout(stopwatch);
    h1.textContent = "00:00:00";
    task.value = "";
    seconds = 0;
    minutes = 0;
    hours = 0;
    start.innerText = "START";
    stop.disabled = false;
    pause.disabled = false;
    start.disabled = false;
    document.getElementById('status').innerHTML = "READY TO START";
};

/**
 * Prevent the default submit behavior of the form
 * @param  event action
 * @return {Boolean} false
 */
timeApp.onsubmit = function (event) {

    return false;

    event.preventDefault();

};

/**
 *  onClick event for Save button
 */
sendbtn.onclick = function () {

    if (task.value == "") {

        task.style.border = "1px solid #ff6b6b";

        return false;

    } else if (time.value == "") {

        start.style.border = "1px solid #ff6b6b";

        return false;

    } else {

        sendbtn.disabled = true;

        setTimeout(function () {

            result.innerHTML = "Saving.";

        }, 1000);

        setTimeout(function () {

            result.innerHTML = "Saving..";

        }, 2000);

        setTimeout(function () {

            result.innerHTML = "Saving....";

        }, 3000);

        setTimeout(function () {

            $.post($("#timeApp").attr("action"),

                $("#timeApp :input").serializeArray(),

                function (info) {

                    result.innerHTML = info;

                });

            sendbtn.disabled = false;

            clearInput();

        }, 4000);

    }

};

/**
 * Clearing the inputs on success
 */
function clearInput() {

    $("#time").val('');

    $("#task").val('');

    setTimeout(function () {

        result.innerHTML = "";

    }, 5000);

}
