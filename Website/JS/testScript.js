function getText() {
	
	var txt1 = document.getElementById('bsptxt1').value;
	
	document.getElementById('demo').innerHTML = txt1;
}

/*Text von Textbox in myFile speichern*/
function exportToFile() {
	
	var txt1 = document.getElementById('bsptxt1').value;

	var textToSave = txt1;

	var hiddenElement = document.createElement('a');

	hiddenElement.href = 'data:attachment/text,' + encodeURI(textToSave);
	hiddenElement.target = '_blank';
	hiddenElement.download = 'myFile.txt';
	hiddenElement.click();

}

/*Variablen für differenz ausrechnen (in millisekunden) */
var time1;
var time2;

/*Zeit wenn die Taste gedrückt wurde*/
function keydownFunction() {
	
	time1 = new Date();
}

/*Zeit wenn die Taste losgelassen wurde*/
function keyupFunction() {
	
	time2 = new Date();
}

function timeDifference() {

	var difference = time2.getTime() - time1.getTime(); /*getTime kriegt zeit in millisekunden*/
	
	document.getElementById('time').innerHTML = "Differenz: " + difference;
}
