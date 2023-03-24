<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    
    <title>HomePage</title>
    <style>
        .green{
            color:green;
            font-weight:bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <div class="logo">Logo...</div>
            <nav>
                <ul>
                    <li><a href="index.php">HOME</a></li>
                    <li><a href="about.php">ABOUT</a></li>
                    <li><a href="#">SERVICES</a></li>
                </ul>
            </nav>
            <div class="nav-btn">
                <a href="#" class="btn">Login</a>
                <a href="#" class="btn">Sign Up</a>
            </div>
        </header>
    </div>
    <div class="ticket-info">
        
    </div>
    <div class="trains">
        <table>
            <tr class="table-head">
                <th>Train Name</th>
                <th>From</th>
                <th>To</th>
                <th>Depart</th>
                <th>Arrival</th>
                <th>Class</th>
                <th>Price</th>
                <th style='font-weight:bold;font-size:17.5px;letter-spacing:1.1px'>Total</th>
            </tr>
            <?php
                

                $id = $_GET['tid'];
                $sql = "SELECT * FROM `project`.`schedule` inner join `project`.`train` on `schedule`.`trainID` = `train`.`trainID`  WHERE `scheduleID` = $id";
                $result = mysqli_query($db,$sql);
                
                while($row = mysqli_fetch_assoc($result)){
                    $classID = $row['classID'];
                    $sql2 = "SELECT * from `project`.`train_class` WHERE `classID` = $classID";
                    $result2 = mysqli_query($db,$sql2);
                    $row2 = mysqli_fetch_assoc($result2);
                    $passengers = $_POST['numOfPassenger'];
                    $total = $row['price'] * $passengers;

                    echo "<tr>
                    <td>".$row['name']."</td>
                    <td>".$row['tfrom']."</td>
                    <td>".$row['tto']."</td>
                    <td>".$row['depart_date']."<br>".$row['depart']."</td>
                    <td>".$row['arrival_date']."<br>".$row['arrival']."</td>
                    <td>".$row2['name']."</td>
                    <td>".$row['price']."</td>
                    <td style='color:#2ecc71;font-weight:bold;font-size:17.5px;letter-spacing:1.1px'>".$total."</td>
                    
                </tr>";
                }
                
                
            ?>
        
            </tr>
           
        </table>
    </div>
    <?php
            $url = 'success.php?tid='.$_GET['tid'];
            $id = $_GET['tid'];
            $sql = "SELECT * FROM `demo`.`trains` WHERE `id` = $id";
            $result = mysqli_query($db,$sql);
            $row = mysqli_fetch_assoc($result);
            // $total = $_POST['numOfPassenger']* $row['Price'];
        ?>
        <div class="pay-container">
            

            
            <form action="<?php echo $url ?>" method="post">
                <?php
                    $rand=rand();
                    $_SESSION['rand']=$rand;
                ?>
                <h2 style=>Payment</h2>
                <input type="hidden" value="<?= $rand?>" name="randcheck">
                <div class="wrap">
                    <label for="nameOnCard">Name on card</label>
                    <input type="text" name="nameOnCard" id="nameOnCard" required>
                </div>
                <div class="wrap">
                    <label for="cardNumber">Card Number</label>
                    <input type="text" name="cardNumber" id="cardNumber" required>
                </div>
                <div class="wrap">
                    <label for="expDate">Expiry Date</label>
                    <input type="text" name="expDate" id="expDate" placeholder="MM/YY" required>
                </div>
                <div class="wrap">
                    <label for="secCode">Security Code</label>
                    <input type="text" name="secCode" id="secCode" required>
                </div>
                
                <input type="hidden" name="noOfPsngr" value="<?= $_POST['numOfPassenger']?>" />
                <input type="hidden" name="total" value="<?= $total?>" /> 
                
                    <button type="submit">Pay</button>
            </form>
        </div>
   
    
    


    
</body>
</html>