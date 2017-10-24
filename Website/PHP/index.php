

<!DOCTYPE html>
<html>
<head>
	<title>Staffplaner Login/Sign-up</title>
	<meta charset="UTF-8">
	<link rel='stylesheet' href='../CSS/styles.css'/>

</head>

<body>

<script src="../JS/testScript.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<div class='header'>
	<h1>Hi! Welcome to our Staffplanner</h1>
	<h2>what is Staffplanner? click here to know more about it...</h2>
</div>

<div class='flex-container'>
	<div class='login'><h2>Login</h2><br>
		<label>Username</label> <br>
		<input type='text' placeholder='Enter your Username' name='uname' required> <br>
		<label>Password</label> <br>
		<input type='password'placeholder='Enter your password' name='pw' required>
	</div>

	<div class='sign-up'><h2>Sign-up</h2><br>
		<label>E-Mailadress</label> <br>
		<input type='text' placeholder='Enter your E-Mailadress' name='mail' required> <br>
		<label>Password</label><br>
		<input type='password'placeholder='Enter your password' name='pw' required><br>
		<label>Confirm Password</label><br>
		<input type='password'placeholder='confirm your password' name='pw' required><br>
	</div>
</div>

<div>
	<div class='test-capture'><h2>Test-Capture</h2><br>
		<label>Beispieltext1</label> <br>
		<input type="text" id="bsptxt1" onkeydown="keydownFunction()" onkeyup="keyupFunction()">
		<button type="button" onclick="exportToFile()">Export to file</button>
		<button type="button" onclick="compareDuration()">Compare Duration</button>
        <button type="button" onclick="compareLatency()">Compare Latency</button>
		<p id="time"></p>
		<p id="difference"></p>
	</div>
</div>

</body>
</html>

