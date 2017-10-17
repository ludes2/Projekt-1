

/*Variablen definieren*/
var time1; /*für differenz ausrechnen (in millisekunden)*/
var time2; /*für differenz ausrechnen (in millisekunden)*/
var difference; /*time2 - time1*/
var saveDifference = []; /*Array timeDifference*/
var testArray = ["86", "139", "98", "79", "66", "83"]; /* Array mit "Hallo" */
var count = 0; /*Zählt die Unstimmigkeiten */


/*Zeit wenn die Taste gedrückt wurde*/
function keydownFunction() {

    time1 = new Date();
}

/*Zeit wenn die Taste losgelassen wurde*/
function keyupFunction() {

    time2 = new Date();

    difference = time2.getTime() - time1.getTime(); /*getTime kriegt zeit in millisekunden*/

    document.getElementById('time').innerHTML = "Differenz: " + difference; /*Show difference*/

    saveDifference.push(difference); /*wert dem array hinzufügen*/
}

/*Als txt Datei speichern*/
function exportToFile() {

    var fileText = saveDifference; /*Array*/

    var textToSave = fileText;

    var hiddenElement = document.createElement('a');

    hiddenElement.href = 'data:attachment/text,' + encodeURI(textToSave);
    hiddenElement.target = '_blank';
    hiddenElement.download = 'myFile.txt';
    hiddenElement.click();
}

/*Vergleicht die Eingabe (Latency) mit dem vorgegeben Text. Wenn Werte mehr als 25 ms auseinander -> False */
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
}
