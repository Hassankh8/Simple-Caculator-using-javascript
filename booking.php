<?php include('server.php') ?>
<?php
    if(isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['username']);
        header('location: index.php');
    }
    if(!isset($_SESSION['username'])){
        header('location: login.php?notlogin=1');
    }
    
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/book.css">
    <title>Booking</title>
</head>
<body>
    <?php if(isset($_SESSION['success'])): ?>
        <h3>
            <?php 
                unset($_SESSION['success']);
            
            ?>
        </h3>
    <?php endif ?>
    <div class="nav-container">
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
    <div class="ticket-info">
        Ticket Details
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
                

                $id = $_GET['tid'];
                $sql = "SELECT * FROM `project`.`schedule` WHERE `scheduleID` = $id";
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
                </tr>";
                }

                
            ?>
        
            
           
        </table>
    </div>

    <div class="container">
        <h1>Reservation</h1>
        <p>Travel Details</p>
        <?php
            $url = 'payment.php?tid='.$_GET['tid'];
            
        ?>
        <form action="<?php echo $url ?>" method="post" class="book-card">
            <div class="wrap">
                <label for="numOfPassenger">No. of Passengers</label>
                <input type="number" name="numOfPassenger" id="numOfPassenger" placeholder="No. of passengers" required>
            </div>
            <button class="btn">Enter</button>
        </form>
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
</body>
</html>