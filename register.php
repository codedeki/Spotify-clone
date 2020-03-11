<?php 
include("includes/classes/Account.php");

$account = new Account();

include("includes/handlers/register-handler.php");
include("includes/handlers/login-handler.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register to Spotify</title>
</head>
<body>
    <div id="inputContainer">
        <form id="loginForm" action="register.php" method="POST">
            <h2>Login to your account</h2>
            <p>
                <label for="loginUsername">Username:</label>
                <input id="loginUsername" name="loginUsername" type="text" placeholder="BartSimpson" required>
            </p> 
            <p> 
                <label for="loginPassword">Password:</label>
                <input id="loginPassword" name="loginPassword" type="password" placeholder="Your password" required> 
            </p>
            <button type="submit" name="loginButton">LOG IN</button>
        </form>
        
        <form id="registerForm" action="register.php" method="POST">
            <h2>Create your free account</h2>
            <p>
                <label for="username">Username:</label>
                <input id="username" name="username" type="text" placeholder="BartSimpson" required>
            </p> 
            <p>
                <label for="firstName">First Name:</label>
                <input id="firstName" name="firstName" type="text" placeholder="Bart" required>
            </p> 
            <p>
                <label for="lastName">Last Name:</label>
                <input id="lastName" name="lastName" type="text" placeholder="Simpson" required>
            </p> 
            <p>
                <label for="email">Email:</label>
                <input id="email" name="email" type="email" placeholder="bart@gmail.com" required>
            </p> 
            <p>
                <label for="email2">Confirm email:</label>
                <input id="email2" name="email2" type="email" placeholder="bart@gmail.com" required>
            </p>  
            <p> 
                <label for="password">Password:</label>
                <input id="password" name="password" type="password" placeholder="Your password" required> 
            </p>
            <p> 
                <label for="password2">Confirm password:</label>
                <input id="password2" name="password2" type="password" placeholder="Your password" required> 
            </p>
            <button type="submit" name="registerButton">SIGN UP</button>
        </form>
    </div>

    
</body>
</html>