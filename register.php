<?php 
    include('server.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/login.css">
    <title>Register</title>
</head>
<body>
    <div class="header">
        <img src="./img/logo.png" alt="">
        <a href="./index.php">Home</a>
    </div>
    <div class="container">
        <h1>Register</h1>
        <div class="wrap">
            <?php 
                    include('errors.php');
                ?>
        </div>
        
        <form action="register.php" method="POST">
            <div class="wrap">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder="Enter username" >
            </div>
            <div class="wrap">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" placeholder="Enter name" >
            </div>
            <div class="wrap">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Enter email" >
            </div>
            <div class="wrap">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" placeholder="Enter phone" >
            </div>
            <div class="wrap">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter password" >
            </div>
            <div class="wrap">
                <label for="password2">Confirm Password</label>
                <input type="password" name="password2" id="password2" placeholder="Confirm password" >
            </div>
            <button type="submit" class="btn" name="register" id="register">Register</button>
            <div class="wrap">
                <p class="reg-text">Already registered? <span><a href="login.php">Login Here</a></span></p>
            </div>
            
        </form>
    </div>
</body>
</html>