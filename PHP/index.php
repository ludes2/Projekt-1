<!DOCTYPE html>
<html>
<head>
    <title>Staffplaner Login/Sign-up</title>
    <meta charset="UTF-8">
    <link rel='stylesheet' href='../CSS/landingPage.css'/>
    <link rel='stylesheet' href='../CSS/forms.css'/>

</head>

<body>
<script src="../JS/validateScript.js"></script>
<script src="../JS/latencyTest.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<div class='header'>
    <h1>Hi! Welcome to our Staffplanner</h1>
    <h2>what is Staffplanner? click here to know more about it...</h2>
</div>

<div class='flex-container'>
    <form action="../PHP/authentication.php" method="post">
        <div class='login'><h2>Login</h2><br>
            <label id="email">E-Mail</label> <br>
            <input type='text' placeholder='Enter your email' name='email' required> <br>
            <label id="loginPassword">Password</label> <br>
            <input type='password' placeholder='Enter your password' name='password' required> <br>
            <button type="submit">Login</button>

        </div>
    </form>
    <form action="../PHP/registration.php" method="post">

        <div class='sign-up'><h2>Sign-up</h2><br>
            <label id="firstName">Vorname</label> <br>
            <input type="text" placeholder="enter your first name" name="firstname" required> <br>
            <label id="lastName">Nachname</label> <br>
            <input type="text" placeholder="Enter your last name" name="lastname" required> <br>
            <label id="mail">E-Mailadress</label> <br>
            <input type='text' placeholder='Enter your E-Mailadress' name='email' required> <br>
            <label id="sign-upPassword">Password</label> <br>
            <input type='password'placeholder='Enter your password' name='sign-upPassword' required> <br>
            <label id="confirmPassword">Confirm Password</label> <br>
            <input type='password'placeholder='confirm your password' name='confirmPassword' required> <br>
            <button type="submit">Sign-up</button>

        </div>
    </form>
</div>

<form>
	<textarea name="textarea" id="inputArea" rows="20" cols="200" onkeydown="keyDown()" onkeyup="keyUp()">
	</textarea>
    <button type="button" onclick="showContent()">Export to file</button>
    <p id="areaContent"></p>
</form>


<form action="durationHandler.php" method="post">
    <div>
        <div class='test-capture'><h2>Test-Capture</h2><br>
            <label>Beispieltext1</label> <br>
            <input type="text" onkeydown="keydownFunction()" onkeyup="keyupFunction()">
            <button type="submit" onclick="sendInputToPHP();">Save Duration in DB</button>
            <p id="time"></p>
            <p id="difference"></p>
        </div>
    </div>
</form>

</body>
</html>