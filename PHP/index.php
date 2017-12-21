<!DOCTYPE html>
<html>
<head>
    <title>User Profiling Login/Sign-up</title>
    <meta charset="UTF-8">
    <link rel='stylesheet' href='../CSS/landingPage.css'/>
    <link rel='stylesheet' href='../CSS/forms.css'/>
</head>

<body>
<script src="../JS/validateScript.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<div class='header'>
    <h1>Hi! Welcome to our User Profiling</h1>
</div>

<div class='flex-container'>
    <form action="front_controller.php" method="post">
        <div class='login'><h2>Login</h2><br>
            <label id="email">E-Mail</label> <br>
            <input type='text' placeholder='Enter your email' name='email' required> <br>
            <label id="loginPassword">Password</label> <br>
            <input type='password' onkeydown="keydownFunction()" onkeyup="keyupFunction()" placeholder='Enter your password' name='password' required> <br>
            <button type="submit" onclick="sendInputToPHP();">Login</button>

        </div>
    </form>

    <form action="../PHP/registration.php" method="post">
        <div class='sign-up'><h2>Sign-up</h2><br>
            <label id="firstName">Firstname</label> <br>
            <input type="text" placeholder="enter your first name" name="firstname" required> <br>
            <label id="lastName">Lastname</label> <br>
            <input type="text" placeholder="Enter your last name" name="lastname" required> <br>
            <label id="mail">E-Mailadress</label> <br>
            <input type='text' placeholder='Enter your E-Mailadress' name='email' required> <br>
            <label id="sign-upPassword">Password</label> <br>
            <input type='password' placeholder='Enter your password' name='sign-upPassword' required> <br>
            <label id="confirmPassword">Confirm Password</label> <br>
            <input type='password' placeholder='confirm your password' name='confirmPassword' required> <br>
            <button type="submit">Sign-up</button>
        </div>
    </form>
</div>

</body>
</html>