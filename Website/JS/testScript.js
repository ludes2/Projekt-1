

/*Variablen definieren*/
var time1; /*für differenz ausrechnen (in millisekunden)*/
var time2; /*für differenz ausrechnen (in millisekunden)*/
var difference; /*time2 - time1*/
var count = 0; /*Zählt die Unstimmigkeiten */

var saveKey = new Array();
var countKey = 0; /*var für saveKey Array */

saveKey[0] = new Array(); /*Erste Spalte für difference */
saveKey[1] = new Array(); /*Zweite Spalte für KeyCode */

/*Zeit wenn die Taste gedrückt wurde*/
function keydownFunction() {

    time1 = new Date();
}

/*Zeit wenn die Taste losgelassen wurde*/
function keyupFunction() {

    time2 = new Date();

    difference = time2.getTime() - time1.getTime(); /*getTime kriegt zeit in millisekunden*/

    document.getElementById('time').innerHTML = "Differenz: " + difference + "KeyCode: " + event.keyCode  /*Show difference*/

    saveKey[0][countKey] = "Differenz: " + difference;
    saveKey[1][countKey] = "KeyCode: " + event.keyCode;
    countKey = countKey + 1; /*Nächste Zeile */

}


/*Als txt Datei speichern*/
function exportToFile() {

    var fileText = saveKey; /*Array*/

    var textToSave = fileText;

    var hiddenElement = document.createElement('a');

    hiddenElement.href = 'data:attachment/text,' + encodeURI(textToSave);
    hiddenElement.target = '_blank';
    hiddenElement.download = 'myFile.txt';
    hiddenElement.click();
}

/*Vergleicht die Eingabe (Latency) mit dem vorgegeben Text. Wenn Werte mehr als 25 ms auseinander -> False

var saveDifference = []; Array timeDifference
var testArray = ["86", "139", "98", "79", "66", "83"]; /* Array mit "Hallo"

function compareLatency() {

    for (var i = 0; i < testArray.length; i++) {
        if (Math.abs(testArray[i] - saveDifference[i]) > 25) {
            count++;
        }
    }

    if (count == 0) {
        document.getElementById('difference').innerHTML = "True: " + count;
    } else {
        document.getElementById('difference').innerHTML = "False: " + count;
    }
} */
