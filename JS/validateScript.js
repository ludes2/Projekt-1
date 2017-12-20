

/*Variablen definieren*/
var time1; /*für differenz ausrechnen (in millisekunden)*/
var time2; /*für differenz ausrechnen (in millisekunden)*/
var duration; /*time2 - time1*/
var latency;
var interval;

var saveKeyCode = [];
var saveDuration = []; /* Array zum Analysieren der Eingabe */
var saveLatency = []; /* Array zum Analysieren der Eingabe */
var saveInterval = []; /* Array zum Analysieren der Eingabe */


var time1Latency = []; /*Array für Latency auszurechnen*/
var time2Latency = []; /*Array für Latency auszurechnen*/
var time1Interval = []; /*Array für Interval auszurechnen*/
var time2Interval = []; /*Array für Interval auszurechnen*/

var percentDuration = []; /* % Übereinstimmung von Duration */


/*Zeit wenn die Taste gedrückt wurde*/
function keydownFunction() {

    time1 = new Date();
    time1Latency.push(time1);
    time1Interval.push(time1);
}


/*Zeit wenn die Taste losgelassen wurde*/
function keyupFunction() {

    time2 = new Date();
    time2Latency.push(time2);
    time2Interval.push(time2);

    duration = time2.getTime() - time1.getTime(); /*getTime kriegt Zeit in millisekunden*/
    latency = time2Latency[time2Latency.length-1] - time1Latency[time1Latency.length-2];
    interval = time1Interval[time1Latency.length-1] - time2Interval[time2Interval.length-2];

    saveKeyCode.push(event.keyCode);
    saveDuration.push(duration);
    saveLatency.push(latency);
    saveInterval.push(interval);
}

function sendInputToPHP() {

    /* Array in String umwandeln um in DB abzuspeichern */
    var jsonDuration = JSON.stringify(saveDuration);
    var jsonLatency = JSON.stringify(saveLatency);
    var jsonInterval = JSON.stringify(saveInterval);

    $(document).ready(function() {

        // process the form
        $('form').submit(function(event) {

            // get the form data
            // there are many ways to get this data using jQuery (you can use the class or id also)
            var formData = {
                'email'             : $('input[name=email]').val(),
                'password'          : $('input[name=password]').val()
            };

    /* JSON String wird mit Hilfe von AJAX zu front_controller.php geparset */
    $.ajax({
        url: 'front_controller.php',
        data: {jsonDuration: jsonDuration, jsonInterval: jsonInterval, jsonLatency: jsonLatency, formData: formData},
        type: 'post',
        dataType: 'json'
    });
/*
    $.ajax({
        url: 'front_controller.php',
        data: {jsonInterval: jsonInterval},
        type: 'post',
        dataType: 'json'
    });

    $.ajax({
        url: 'front_controller.php',
        data: {jsonLatency: jsonLatency},
        type: 'post',
        dataType: 'json'
    });*/
}


function compareDuration() {
    /*Berechnet Duration. Wenn Werte mehr als 30 ms auseinander -> False*/
    var testDuration = ["86", "78", "98", "86", "87"]; /* Array mit "hallo" */

    var limit = 30;


    for (var i = 0; i < saveDuration.length; i++) {
        if (Math.abs(testDuration[i] - saveDuration[i]) > limit) {
            alert("Fehler - Person nicht erkannt");
            break;
        }

        /* Werte in % umwandeln */
        if (testDuration[i] > saveDuration[i]) {
            percentDuration[i] = ((saveDuration[i] * 100) / testDuration[i]);
        }

        if (testDuration[i] < saveDuration[i]) {
            percentDuration[i] = ((testDuration[i] * 100) / saveDuration[i]);
        }
    }

    /* Summe von Array / Länge des Arrays, Gesamt % von Duration */
    alert(Math.round(percentDuration.reduce(getSum) / percentDuration.length) + "%");
}


/*Berechnet Latency */
function compareLatency() {

    var testLatency = ["0", "266","220","242","284"]; /* Array mit "hallo" */

    for (var i = 1; i < saveLatency.length; i++) {
        if (Math.abs(testLatency[i] - saveLatency[i]) > 50) {
            alert("Fehler - Person nicht erkannt");
            break;
        }
    }
}


/* Berechnet Interval */
function compareInterval() {

    var testInterval = ["0", "98","50","68","112"]; /* Array mit "hallo" */

    for (var i = 1; i < saveLatency.length; i++) {
        if (Math.abs(testInterval[i] - saveInterval[i]) > 50) {
            alert("Fehler - Person nicht erkannt");
            break;
        }
    }
}

/* ------------------------------------------------------------------------------ */

/*Array als txt Datei speichern*/
function exportToFile() {

    var fileText = jsonDuration; /*Array*/

    var textToSave = fileText;

    var hiddenElement = document.createElement('a');

    hiddenElement.href = 'data:attachment/text,' + encodeURI(textToSave);
    hiddenElement.target = '_blank';
    hiddenElement.download = 'myFile.txt';
    hiddenElement.click();
}
