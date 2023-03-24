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
    <title>HomePage</title>
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
                    <li><a href="about.php">About</a></li>
                    <li><a href="#">Services</a></li>
                </ul>
            </nav>
            <?php if(isset($_SESSION['username'])): ?>
                
                <div class="nav-btn">
                <a href="profile.php" class="btn">Profile</a>
                
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
    <section class="hero">
        <h2>Book Train Tickets</h2>
        <div class="search-wrap">
            <a href="#" class="tag-btn active-tag" id="way1" onclick="ItoggleClass()" >Search Train</a>
            <a href="#" class="tag-btn" id="way2" onclick="ItoggleClass1()" >Search Train by Name or Number</a>
            
            <div id="withDate" >
                <div class="form-wrap" >
                    <form action="search.php" method="POST" >
                        <input type="text" name="from" id="from" placeholder="FROM" required>
                        <input type="text" name="to" id="to" placeholder="TO" required>
                        <input type="date" name="date" id="date" required>
                        <!-- <a href="search.php" class="btn">Search</a> -->
                        <button type="submit" class="btn" name="swDate">Search</button>
                    </form>
                </div>
            </div>
           
            <div id="byName" class="show">
                <div class="form-wrap">
                    <form action="search.php" method="POST">
                        <input type="text" name="trainName" id="trainName" placeholder="NAME">
                        <input type="date" name="date" id="date">
                        <button type="submit" class="btn" name="swDate">Search</button>
                    </form>
                </div>
            </div>
            
        </div>
    </section>
    <section class="top-dest">
        <h2>Top Train Routes</h2>
        <div class="top-wrap">
        <?php
                
                $sql1 = "SELECT `scheduleID` from `project`.`reservation` group by `scheduleID` order by `scheduleID` desc";
                $result1 = mysqli_query($db,$sql1);
                
                
                $i = 0;
                while($i!=7 && $row = mysqli_fetch_assoc($result1)){
                    $id = $row['scheduleID'];
                    $sql = "SELECT * FROM `project`.`schedule` where `scheduleID` = $id";
                    $result = mysqli_query($db,$sql);
                    $row1 = mysqli_fetch_assoc($result);
                    echo "<div class='route'>
                            <h3>".$row1['tfrom']." - ".$row1['tto']."</h3>
                            <button class='ticket btn btn-primary btn-sm my-1 px-3' id=".$row1['scheduleID'].">Book</button>
                         </div>";
                         $i = $i + 1;
                }

                
            ?>
            
                
            
        </div>
    </section>

    <section class="fare">
                <h2>Check Fares</h2>
                <div class="search-wrap">
                   
                    <div class="form-wrap" id="fares">
                        <form action="#fares" method="POST">
                            <input type="text" name="ffrom" id="ffrom" placeholder="FROM">
                            <input type="text" name="fto" id="fto" placeholder="TO">
                            
                            <button class="btn" type="submit">Search</button>
                        </form>
                    </div>
                </div>
                
                <?php
                    if(isset($_POST['ffrom'])){
                        $from = $_POST['ffrom'];
                        $to = $_POST['fto'];
                        $sql = "SELECT * FROM `project`.`schedule` WHERE `tfrom` = '$from' AND `tto` = '$to'";
                        // $sql = "SELECT * FROM `demo`.`trains` WHERE `name` = '$trainName' ORDER BY `date`";
                        $result = mysqli_query($db,$sql);
                        
                        while($row = mysqli_fetch_assoc($result)){
                            $id = $row['trainID'];
                            $sql1 = "SELECT * FROM `project`.`train` WHERE `trainID` = $id";
                            $result1 = mysqli_query($db,$sql1);
                            $row1 = mysqli_fetch_assoc($result1);
                            echo "<div class='fare-result'>
                            <h3>Train: ".$row1['name']."</h3>
                            <h3 style='color:#2ecc71'>Fare: ".$row['price']."</h3>
                            <button class='ticket btn btn-primary btn-sm my-1 px-3' id=".$row['scheduleID'].">Book</button>
                         </div>";
                        }
    
                    }
                ?>
    </section>
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
<script>
    function ItoggleClass(){
        var Datee = document.getElementById('withDate');
        var Name = document.getElementById('byName');
        
       // var way1 = document.getElemenetById('way1');
      //  var way2 = document.getElemenetById('way2');
        
      
        if(Datee.classList=='show'){
            Datee.classList.remove('show');
            Name.classList.add('show');
            document.getElementById("way1").classList.add("tag-btn", "active-tag");
            document.getElementById("way2").classList.remove("active-tag");        }
        

    }
    function ItoggleClass1(){
        var Datee = document.getElementById('withDate');
        var Name = document.getElementById('byName');
        

        
        if(Name.classList=='show'){
            Name.classList.remove('show');
            Datee.classList.add('show');
            document.getElementById("way2").classList.add("tag-btn", "active-tag");
            document.getElementById("way1").classList.remove("active-tag");
        }
        

    }
</script>

<script>
      ticket = document.getElementsByClassName('ticket');
      Array.from(ticket).forEach((element)=>{
        element.addEventListener("click",(e)=>{
          console.log("ticket",);
          
          sno = e.target.id;
          window.location = `./booking.php?tid=${sno}`;
          
        })
      })
    </script>
<script src="./js/index.js"></script>
</body>
</html>