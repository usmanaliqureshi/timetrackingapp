/**
 * Profile related functionality
 * @type {Element}
 */
var profilebtn = document.getElementById('profilebtn'),
    result = document.getElementById('result'),
    saveprofile = document.getElementById('saveprofile');

saveprofile.onsubmit = function (event) {

    return false;

    event.preventDefault();

};

profilebtn.onclick = function (event) {

    event.preventDefault();

    profilebtn.disabled = true;

    setTimeout(function () {

        $.post($("#saveprofile").attr("action"),

            $("#saveprofile :input").serializeArray(),

            function (info) {

                result.innerHTML = info;

            });

        profilebtn.disabled = false;

        clearResult();

    }, 2000);

};

/**
 * Clearing the content from result div on success
 */
function clearResult() {

    setTimeout(function () {

        result.innerHTML = "";

    }, 10000);

}
