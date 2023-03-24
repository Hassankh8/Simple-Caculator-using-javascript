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
    <title>Admin Login</title>
</head>
<body>
    <div class="header">
        <img src="./img/logo.png" alt="">
        <a href="./index.php">Home</a>
    </div>
    <div class="container">
        <h1>Admin Login</h1>
        <p>___________</p>
        <div class="wrap">
            <?php 
                    include('errors.php');
                ?>
        </div>
        <form action="Alogin.php" method="post">
            <div class="wrap">
                <label for="username">Userame</label>
                <input type="text" name="Ausername" id="Ausername" placeholder="Enter name" >
            </div>
            <div class="wrap">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter password" >
            </div>
            <button type="submit" name="Alogin" class="btn">Submit</button>
            
        </form>
    </div>
</body>
</html>