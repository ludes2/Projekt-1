

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

var jsonDuration;

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

    document.getElementById('time').innerHTML = "Duration: " + duration + " KeyCode: "
        + event.keyCode + " Latency: " + latency + " Interval: " + interval;

    saveKeyCode.push(event.keyCode);
    saveDuration.push(duration);
    saveLatency.push(latency);
    saveInterval.push(interval);
}

function saveDurationInDB() {

    jsonDuration = JSON.stringify(saveDuration);


    $(document).ready(function() {

        $(".clickable").click(function() {
            var userID = $(this).attr('id');
            //alert($(this).attr('id'));
            $.ajax({
                type: "POST",
                url: 'validateInput.php',
                data: { data : jsonDuration },
                success: function(jsonDuration)
                {
                    alert("success!");
                }
            });
        });
    });

    alert(jsonDuration);

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

/* Summe von Array */
function getSum(total, num) {
    return total + num;
}

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



/* function createCookies() {

    Counter wird im LocalStorage gespeichert, damit nach reload der Page nicht der counter = 0 ist
if (localStorage.clickcount >= 5) {
    localStorage.clickcount = 0;
}

if (localStorage.clickcount) {
    localStorage.clickcount = Number(localStorage.clickcount) + 1;
} else {
    localStorage.clickcount = 1;
}

document.getElementById("result").innerHTML = "You have clicked the button " + localStorage.clickcount + " time(s).";

var cookieDurationString = "durationCookie" + localStorage.clickcount;
var json_duration = JSON.stringify(saveDuration);
createCookie(cookieDurationString, json_duration, 2); /* 2 = Expire date
location.reload(); /* Website wird automatisch neu geladen
}

Cookies holen, in Array umwandeln, dann den Durchschnitt der Werte berechnen
function validateDurationCookies() {

    var json_str1 = getCookie("durationCookie1");
    var jsonDuration1 = JSON.parse(json_str1);

    var json_str2 = getCookie("durationCookie2");
    var jsonDuration2 = JSON.parse(json_str2);

    var json_str3 = getCookie("durationCookie3");
    var jsonDuration3 = JSON.parse(json_str3);

    var json_str4 = getCookie("durationCookie4");
    var jsonDuration4 = JSON.parse(json_str4);

    var json_str5 = getCookie("durationCookie5");
    var jsonDuration5 = JSON.parse(json_str5);


    for (var i = 0; i < jsonDuration1.length; i++) {

        validateDuration[i] = Math.round((jsonDuration1[i] + jsonDuration2[i] + jsonDuration3[i] + jsonDuration4[i]
            + jsonDuration5[i]) / 5);
    }

    alert(validateDuration); /*validateDuration würde dann in DB abgespeichert werden
}

Diese set, get Funktionen mussten kopiert werden sonst funktionieren cookies nicht
var createCookie = function(name, value, days) {
    var expires;
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    }
    else {
        expires = "";
    }
    document.cookie = name + "=" + value + expires + "; path=/";
}

function getCookie(c_name) {
    if (document.cookie.length > 0) {
        c_start = document.cookie.indexOf(c_name + "=");
        if (c_start != -1) {
            c_start = c_start + c_name.length + 1;
            c_end = document.cookie.indexOf(";", c_start);
            if (c_end == -1) {
                c_end = document.cookie.length;
            }
            return unescape(document.cookie.substring(c_start, c_end));
        }
    }
    return "";
} */
