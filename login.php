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
    <title>Login</title>
</head>
<body>
    <div class="header">
        <img src="./img/logo.png" alt="">
        <a href="./index.php">Home</a>
        <a href="./Alogin.php">Admin</a>
    </div>
    
        <?php
            if(isset($_GET['notlogin'])){
                echo "<p class='message'>Login before booking</p>";
        
            }
        ?>
    
    <div class="container">
        <h1>Login</h1>
        <p>______________________</p>
        <div class="wrap">
            <?php 
                    include('errors.php');
                ?>
            
        </div>
        <form action="login.php" method="post">
            <div class="wrap">
                <label for="username">Userame</label>
                <input type="text" name="username" id="username" placeholder="Enter name" >
            </div>
            <div class="wrap">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter password" >
            </div>
            <button type="submit" name="login" class="btn">Submit</button>
            <div class="wrap">
                <p class="reg-text">Not registered yet? <span><a href="register.php">Register Here</a></span></p>
            </div>
        </form>
    </div>
</body>
</html>