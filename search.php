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
    <title>Trains</title>
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
                    <li><a href="index.php">HOME</a></li>
                    <li><a href="about.php">ABOUT</a></li>
                    <li><a href="#">SERVICES</a></li>
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
    <div class="search-wrap">
            <a href="#" class="tag-btn active-tag" id="way1" onclick="ItoggleClass()"  style="color:#333;font-weight:bold">Search Train</a>
            <a href="#" class="tag-btn" id="way2" onclick="ItoggleClass1()" style="color:#333;font-weight:bold" >Search Train by Name or Number</a>
            
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

    <div class="trains">
        <table>
            <tr class="table-head">
                <th>Train Name</th>
                <th>From</th>
                <th>To</th>
                <th>Depart</th>
                <th>Arrival</th>
                <th>Price</th>
                <th></th>
            </tr>
            <?php
                // Search by Date
                if(isset($_POST['from'])){
                    $from = $_POST['from'];
                    $to = $_POST['to'];
                    $date = $_POST['date'];
                    
                    // $sql = "SELECT * FROM `demo`.`trains` WHERE `dfrom` = '$from' AND `dto` = '$to' ORDER BY `date`";
                    
                    $sql = "SELECT * FROM `project`.`schedule` WHERE `tfrom` = '$from' AND `tto` = '$to' ORDER BY `depart_date`";
                    $result = mysqli_query($db,$sql);
                    
                    while($row = mysqli_fetch_assoc($result)){
                        $trainID = $row['trainID'];
                        $sql1 = "SELECT * FROM `project`.`train` WHERE `trainID` = $trainID"; 
                        $result1 = mysqli_query($db,$sql1);
                        $row2 = mysqli_fetch_assoc($result1);
                        echo "<tr>
                        <td>".$row2['name']."</td>
                        <td>".$row['tfrom']."</td>
                        <td>".$row['tto']."</td>
                        <td>".$row['depart_date']."<br>".$row['depart']."</td>
                        <td>".$row['arrival_date']."<br>".$row['arrival']."</td>
                        <td>".$row['price']."</td>
                        <td><button class='ticket btn btn-primary btn-sm my-1 px-3' id=".$row['scheduleID'].">Book</button></td>
                    </tr>";
                    }

                }
                // Search by trainName
                if(isset($_POST['trainName'])){
                    $trainName = $_POST['trainName'];
                    $date = $_POST['date'];
                    $sql = "SELECT * FROM `project`.`train` WHERE `name` = '$trainName'";
                    // $sql = "SELECT * FROM `demo`.`trains` WHERE `name` = '$trainName' ORDER BY `date`";
                    $result = mysqli_query($db,$sql);
                    
                    while($row = mysqli_fetch_assoc($result)){
                        $id = $row['trainID'];
                        $sql1 = "SELECT * FROM `project`.`schedule` WHERE `trainID` = $id";
                        $result1 = mysqli_query($db,$sql1);
                        $row1 = mysqli_fetch_assoc($result1);
                        echo "<tr>
                        <td>".$row['name']."</td>
                        <td>".$row1['tfrom']."</td>
                        <td>".$row1['tto']."</td>
                        <td>".$row1['depart_date']."<br>".$row['depart']."</td>
                        <td>".$row1['arrival_date']."<br>".$row['arrival']."</td>
                        <td>".$row1['price']."</td>
                        <td><button class='ticket btn btn-primary btn-sm my-1 px-3' id=".$row['scheduleID'].">Book</button></td>
                    </tr>";
                    }

                }
            ?>
           
        </table>
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
</body>
</html>