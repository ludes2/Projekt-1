

/*Variablen definieren*/
var time1; /*für differenz ausrechnen (in millisekunden)*/
var time2; /*für differenz ausrechnen (in millisekunden)*/
var duration; /*time2 - time1*/
var latency;

var saveKeyCode = [];
var saveDuration = [];
var saveLatency = [];

var time1Latency = []; /*Array für Latency */
var time2Latency = []; /*Array für Latency */

/* var countKey = 0; var für saveKey Array
saveKey[0] = new Array(); Erste Spalte für difference
saveKey[1] = new Array(); Zweite Spalte für KeyCode */

/*Zeit wenn die Taste gedrückt wurde*/
function keydownFunction() {

    time1 = new Date();
    time1Latency.push(time1);
}

/*Zeit wenn die Taste losgelassen wurde*/
function keyupFunction() {

    time2 = new Date();
    time2Latency.push(time2);

    duration = time2.getTime() - time1.getTime(); /*getTime kriegt zeit in millisekunden*/
    latency = time2Latency[time2Latency.length-1] - time1Latency[time1Latency.length-2];

    document.getElementById('time').innerHTML = "Duration: " + duration + " KeyCode: " + event.keyCode + " Latency: " + latency; /*Show difference*/

    saveKeyCode.push(event.keyCode);
    saveDuration.push(duration);
    saveLatency.push(latency);

    /* Array wird bei jedem KeyUp um 1 erweitert
    saveKey[0][countKey] = compareDifference;
    saveKey[1][countKey] = event.keyCode;
    countKey = countKey + 1; /*Nächste Zeile */
}


/*Berechnet Duration. Wenn Werte mehr als 30 ms auseinander -> False*/
var testDuration = ["86", "78", "98", "86", "87"]; /* Array mit "hallo" */

function compareDuration() {

    for (var i = 0; i < saveDuration.length; i++) {
        if (Math.abs(testDuration[i] - saveDuration[i]) > 30) {
            alert("Fehler - Person nicht erkannt");
            break;
        }
    }
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


/*Array als txt Datei speichern*/
function exportToFile() {

    var fileText = saveLatency; /*Array*/

    var textToSave = fileText;

    var hiddenElement = document.createElement('a');

    hiddenElement.href = 'data:attachment/text,' + encodeURI(textToSave);
    hiddenElement.target = '_blank';
    hiddenElement.download = 'myFile.txt';
    hiddenElement.click();
}
