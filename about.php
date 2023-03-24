<?php include('server.php') ?>
<?php
    if(isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['username']);
        header('location: index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>About</title>
    <style>
        .wrapper{
            display:flex;
            height:390px;
            width: 100%;
            justify-content: center;
            align-items: center;
        }
        .left{
            flex: 1;
            text-align: center;
            line-height: 1.8;
            
        }
        .left h2{
            margin-bottom: 10px;
        }
        .right{
            background: url('./img/about.jpg') no-repeat center center/cover;
            height: 100%;
            width: 100%;
            flex: 1;
        }
    </style>
</head>
<body>
    <?php if(isset($_SESSION['success'])): ?>
        <h3>
            <?php 
                unset($_SESSION['success']);
            
            ?>
        </h3>
    <?php endif ?>
    <div class="container">
        <header>
            <div><img class="logo" src="./img/logo.png" alt=""></div>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Services</a></li>
                </ul>
            </nav>
            <?php if(isset($_SESSION['username'])): ?>
                
                <div class="nav-btn">
                <a href="#" class="btn">Profile</a>
                
                <a href="index.php?logout='1'" class="btn" style="background:tomato">Logout</a>
                
                </div>
            <?php endif ?>
        
            <?php if(!isset($_SESSION['username'])): ?>
                <div class="nav-btn">
                 <a href="login.php" class="btn">Login</a>
                 <a href="register.php" class="btn">Sign Up</a>
                </div>
            <?php endif ?>

            
        </header>
    </div>

    <div class="wrapper">
        <div class="left">
                <h2>About</h2>
                <p>Lorem, ipsum Lorem, ipsum dolor sit amet consectetur adipisicing elit. Amet, ab! dolor sit amet consectetur adipisicing elit. Iusto repellat ea asperiores, quae nam minima!</p>
        </div>
        <div class="right">

        </div>
    </div>
   
    <footer>
  <div class="footer-container">
    <div class="left-col">
      <img src="./img/whlogo.png" alt="" class="flogo">
      
      <p class="rights-text"></p>
    </div>

    <div class="right-col">
      <h1>Our Newsletter</h1>
      <div class="border"></div>
      <p>Enter Your Email to get our news and updates.</p>
      <form action="" class="newsletter-form">
        <input type="text" class="txtb" placeholder="Enter Your Email">
        <input type="submit" class="fbtn" value="submit">
      </form>
    </div>
  </div>
</footer>
</body>
</html>