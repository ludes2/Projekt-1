function getText() {

    var txt1 = document.getElementById('bsptxt1').value;

    document.getElementById('demo').innerHTML = txt1;
}


/*Variablen definieren*/
var time1; /*für differenz ausrechnen (in millisekunden)*/
var time2; /*für differenz ausrechnen (in millisekunden)*/
var difference; /*time2 - time1*/
var saveDifference; /*Array timeDifference*/

/*Zeit wenn die Taste gedrückt wurde*/
function keydownFunction() {

    time1 = new Date();
}

/*Zeit wenn die Taste losgelassen wurde*/
function keyupFunction() {

    time2 = new Date();
}

/*Differenz zwischen keydown und keyup berechnen*/
function timeDifference() {

    difference = time2.getTime() - time1.getTime(); /*getTime kriegt zeit in millisekunden*/

    document.getElementById('time').innerHTML = "Differenz: " + difference;



    for (var i = 0; i < (saveDifference.length);i++) {
        saveDifference = [];
        saveDifference.push(difference);
    }
}

/*Text von Textbox in myFile speichern*/
function exportToFile() {

    /*var txt1 = document.getElementById('bsptxt1').value;*/
    var txt1 = document.getElementById('bsptxt1').innerHTML = saveDifference;

    var textToSave = txt1;

    var hiddenElement = document.createElement('a');

    hiddenElement.href = 'data:attachment/text,' + encodeURI(textToSave);
    hiddenElement.target = '_blank';
    hiddenElement.download = 'myFile.txt';
    hiddenElement.click();
}
