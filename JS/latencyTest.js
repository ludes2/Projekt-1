
var timeA = 0;
var timeB = 0;

var counterKeyDown = 0;
var counterKeyUp = 0;

var input_Text = 5;
var rows = 3;
var a = new Array(input_Text);
/* creates a two-dimensional array (3x5) for the custom word "hello" and initializes everything with 0
*
*    |           | 0 | 1 | 2 | 3 | 4
* ------------------------------------
*    |           | h | a | l | l | o
* ------------------------------------
* 0  | keyCode   |72 |65 |76 |76 |79
* ------------------------------------
* 1  | keyDown() |   |   |   |   |
* ------------------------------------
* 2  | keyUp()   |   |   |   |   |
* ------------------------------------
*
* */
for (i=0; i<input_Text; i++) {
    a[i]= new Array(rows);
    for (j=0; j<rows; j++) {
        a[i][j]= 0;
    }
}


/* creates an obj at the specified Index in the array and raises the counterKeyDown by one.
* Additionally it assignes the keyCode at the specified Index.
* */
function keyDown(){
    a[0][counterKeyDown] = event.keyCode;
    a[1][counterKeyDown] = new Date().toDateString();
    counterKeyDown++;
}

/* creates an obj at the specified Index in the array and raises the counterKeyUp by one */
function keyUp() {
    a[2][counterKeyUp] = new Date().toDateString();
    counterKeyUp++;
}

function showContent() {
    var content = document.getElementById("inputArea").value;
    document.getElementById("areaContent").innerHTML = content;
}

/*
function exportFile() {
    var fileText = a;

    var hiddenElement = document.createElement('a');

    hiddenElement.href = 'data:attachment/text,' + encodeURI(fileText);
    hiddenElement.target = '_blank';
    hiddenElement.download = 'myFile.txt';
    hiddenElement.click();
}
*/



