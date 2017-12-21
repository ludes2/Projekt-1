
var time1;
var time2;
var duration;
var latency;
var interval;

var saveDuration = [];
var saveLatency = [];
var saveInterval = [];

var time1Latency = [];
var time2Latency = [];
var time1Interval = [];
var time2Interval = [];


function keydownFunction() {

    time1 = new Date(); // Time when the key was pressed
    time1Latency.push(time1);
    time1Interval.push(time1);
}


function keyupFunction() {

    time2 = new Date(); // Time when the key was released
    time2Latency.push(time2);
    time2Interval.push(time2);

    duration = time2.getTime() - time1.getTime(); //getTime = time in ms
    latency = time2Latency[time2Latency.length-1] - time1Latency[time1Latency.length-2];
    interval = time1Interval[time1Latency.length-1] - time2Interval[time2Interval.length-2];

    saveDuration.push(duration);
    saveLatency.push(latency);
    saveInterval.push(interval);
}


function sendInputToPHP() {

    // Convert array with JSON to String to store in DB
    var jsonDuration = JSON.stringify(saveDuration);
    var jsonLatency = JSON.stringify(saveLatency);
    var jsonInterval = JSON.stringify(saveInterval);

    $(document).ready(function() {

        // process the form
        $('form').submit(function (event) {

            // get the form data
            var email = {'email': $('input[name=email]').val()};
            var password = {'password': $('input[name=password]').val()};

            //Send the data with AJAX to front_controller.php
            $.ajax({
                url: 'front_controller.php',
                data: {
                    jsonDuration: jsonDuration,
                    jsonInterval: jsonInterval,
                    jsonLatency: jsonLatency,
                    email: email.email,
                    password: password.password
                },
                type: 'post',
                dataType: 'json'
            });
        });
    });
}