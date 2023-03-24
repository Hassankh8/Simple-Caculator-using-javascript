<?php 
// INSERT INTO `notes` (`sno`, `title`, `description`, `tstamp`) VALUES (NULL, 'New Title', 'This is new title from 3', current_timestamp());  // Conneting to Database
  $insert = false;
  $insert2 = false;
  $update = false;
  $delete = false;
 

  $conn = mysqli_connect('localhost','root','');

  if(!$conn){
    die("Sorry we failed to connect".mysqli_connect_error());
  }

  // Delete Operation
  if(isset($_GET['delete'])){
    
    $trainID = $_GET['delete'];
    // $delete = true;
    // $sql = "DELETE FROM `demo`.`trains` WHERE `id` = $trainID";
    $s = "DELETE FROM `project`.`train` WHERE `train`.`trainID` = $trainID";
    // $sql1 = "DELETE FROM `project`.`train` WHERE 0";
    // $s = "SELECT * FROM `project`.`train` WHERE 1";
    $result = mysqli_query($conn,$s);
    
    if($result){
      $delete = true;
    }
  }
  if(isset($_GET['Sdelete'])){
    
    $trainID = $_GET['Sdelete'];
    
    // $delete = true;
    // $sql = "DELETE FROM `demo`.`trains` WHERE `id` = $trainID";
    $s = "DELETE FROM `project`.`schedule` WHERE `schedule`.`scheduleID` = $trainID";
    // $sql1 = "DELETE FROM `project`.`train` WHERE 0";
    // $s = "SELECT * FROM `project`.`train` WHERE 1";
    $result = mysqli_query($conn,$s);
    
    if($result){
      
      $delete = true;
    }
  }
  // INSERT 
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['snoEdit'])){
      $trainID = $_POST['snoEdit'];
      $name = $_POST['trainNameEdit'];
      $from = $_POST['fromEdit'];
      $to = $_POST['toEdit'];
      $departDate = $_POST['departDateEdit'];
      $departTime = $_POST['departTimeEdit'];
      $arrivalDate = $_POST['arrivalDateEdit'];
      $arrivalTime = $_POST['arrivalTimeEdit'];
      $price = $_POST['priceEdit'];

      $sql1 = "SELECT * from `project`.`train` where `name` = '$name'";
      $result1 = mysqli_query($conn,$sql1);
      $row = mysqli_fetch_assoc($result1);
      $id = $row['trainID'];

      $sql = "UPDATE `project`.`schedule` SET `trainID` = '$id', `tfrom` = '$from' , `tto` = '$to'
      , `depart_date` = '$departDate', `depart` = '$departTime' , `arrival_date` = '$arrivalDate', `arrival` = '$arrivalTime' , `price` = '$price'
       WHERE `project`.`schedule`.`scheduleID` = $trainID";
      $result = mysqli_query($conn,$sql);
      if($result){
        $update = true;
      }

    }
    else if(isset($_POST['TsnoEdit'])){
      $trainID = $_POST['TsnoEdit'];
      $name = $_POST['trainEdit'];
      $capacity = $_POST['capacityEdit'];
      $class = $_POST['classEdit'];
      $sql1 = "SELECT * from `project`.`train_class` where `name` = '$class'";
      $result1 = mysqli_query($conn,$sql1);
      $row = mysqli_fetch_assoc($result1);
      $classID = $row['classID'];
      $sql = "UPDATE `project`.`train` SET `name` = '$name', `capacity` = '$capacity' , `classID` = '$classID'
       WHERE `project`.`train`.`trainID` = $trainID";
      $result = mysqli_query($conn,$sql);
      if($result){
        $update = true;
      }
    }
    else if(isset($_POST['class'])){
      $trainName = $_POST['trainName'];
      $capacity = $_POST['capacity'];
      $class = $_POST['class'];
      

      $sql = "INSERT INTO `project`.`train` (`name`,`capacity`,`classID`) VALUES ('$trainName','$capacity','$class');";
      $result = mysqli_query($conn,$sql);
      if($result){
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
      <strong>Success!</strong> You note check has been updated succesfully.
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
        $insert2 = true;
       }
       else{
         echo " Train didn't inserted";
         mysqli_error($conn);
       }
    }
    else{
      $trainID = $_POST['trainID'];
      $from = $_POST['from'];
      $to = $_POST['to'];
      $departDate = $_POST['departDate'];
      $arrivalDate = $_POST['arrivalDate'];
      $departTime = $_POST['departTime'];
      $arrivalTime = $_POST['arrivalTime'];
      $price = $_POST['price'];
      // $sql = "INSERT INTO `project`.`reservation` (`name`, `dfrom`, `dto`, `depart`, `arrival`, `date`, `Price`) VALUES ('$trainName', '$from', '$to', '$depart', '$arrival', '$date', '$price');";
      $sql = "INSERT INTO `project`.`schedule` (`trainID`, `tfrom`, `tto`, `depart_date`, `depart`, `arrival_date`, `arrival`, `price`) VALUES ('$trainID', '$from', '$to', '$departDate', '$departTime', '$arrivalDate', '$arrivalTime', '$price')";
      // $sql = "INSERT INTO `notes` (`title`, `description`) VALUES ('$title', '$description')"; 
      $result = mysqli_query($conn,$sql);
      
      if($result){
       // echo "Record inserted succesflly";
       $insert = true;
      }
      else{
        echo " Recorded didn't inserted";
        mysqli_error($conn);
      }
    }


    
  }
  
  
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    
  
  <title>TrainX - Admin Panel</title>
  <style>
    .container {
      width: 90%;
      
    }
    .wrapper{
        display:flex;
        flex-direction:row;
        justify-content:space-around;
        background:#2c3e50ef;
        color: #f4f4f4;
        padding: 22px 10px;
        border-radius: 10px;
    }
    .left,.right{
        width: 40%;
        margin: auto;
    }
    .wrapper input{
        width: 100%;
        
    }
    .btn{
      width:90%;
      margin: 0 auto;
    }
    body{
      background:#f4f4f4;
    }
    .navbar-brand{
      margin-right: 95px;
      margin-left: 25px;
    }
    .navbar{
        background: #2c3e50;
        
    }
    .navbar a{
        color: #f4f4f4;
        font-weight: bold;
    }
    img{
        margin-left: 25px;
    }
    .btn-form{
        width: 100%;
        margin-top: 10px;
        font-weight: bold;
    }
    .tag-btn{
    text-decoration: none;
      color: #333;
      font-size: 16px;
    margin-bottom: 20px;
      display: inline-block;
      padding: 5px 10px;
}
.active-tag{
    padding: 5px 30px;
    background: #3498db;
    font-weight: bold;
    border-radius: 60px;
    color: rgb(255, 255, 255);
}
.show{
    display:none;
    
}
.invisible{
    opacity: 0;
}
    
  </style>
</head>

<body>
    <!-- Edit Modal modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
  Edit Modal
</button> -->

<!-- EDIT MODAL OF TRAIN -->
<div class="modal fade" id="TeditModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit this Train</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form action="./admin.php" method="post">
      <div class="modal-body">
        <input type="hidden" name="TsnoEdit" id="TsnoEdit">
        <div class="mb-3">
            <label for="trainEdit" class="form-label">Train</label>
            <input type="text" class="form-control" id="trainEdit" name="trainEdit" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="capacityEdit" class="form-label">Capacity</label>
            <input type="text" class="form-control" id="capacityEdit" name="capacityEdit" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="classEdit" class="form-label">Class</label>
            <input type="text" class="form-control" id="classEdit" name="classEdit" aria-describedby="emailHelp">
          </div>
          
          

          <!-- <button type="submit" class="btn btn-primary">Update Note</button> -->
      </div>
      <div class="modal-footer mr-auto d-block" >
        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
        <button type="submit" class="btn btn-primary ">Save changes</button>
      </div>
        </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit this Note</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form action="./admin.php" method="post">
      <div class="modal-body">
        <input type="hidden" name="snoEdit" id="snoEdit">
          <div class="mb-3">
            <label for="trainName" class="form-label">Train Name</label>
            <input type="text" class="form-control" id="trainNameEdit" name="trainNameEdit" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="from" class="form-label">From</label>
            <input type="text" class="form-control" id="fromEdit" name="fromEdit" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="to" class="form-label">To</label>
            <input type="text" class="form-control" id="toEdit" name="toEdit" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="Depart" class="form-label">Depart Date</label>
            <input type="text" class="form-control" id="departDateEdit" name="departDateEdit" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="Depart" class="form-label">Depart Time</label>
            <input type="text" class="form-control" id="departTimeEdit" name="departTimeEdit" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="arrivalDateEdit" class="form-label">Arrival Date</label>
            <input type="text" class="form-control" id="arrivalDateEdit" name="arrivalDateEdit" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="arrivalTimeEdit" class="form-label">Arrival Time</label>
            <input type="text" class="form-control" id="arrivalTimeEdit" name="arrivalTimeEdit" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="Price" class="form-label">Price</label>
            <input type="text" class="form-control" id="priceEdit" name="priceEdit" aria-describedby="emailHelp">
          </div>
          

          <!-- <button type="submit" class="btn btn-primary">Update Note</button> -->
      </div>
      <div class="modal-footer mr-auto d-block" >
        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
        <button type="submit" class="btn btn-primary ">Save changes</button>
      </div>
        </form>
    </div>
  </div>
</div>

  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <img src="./img/logo.png" style="height:50px" alt="">
      <a class="navbar-brand" href="#">ADMIN PANEL</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
          </li>

          <li class="nav-item">
             <a href="index.php?logout='1'" class="btn nav-link">Logout</a>
          </li>


        </ul>
        
      </div>
    </div>
  </nav>
  <?php
    if($insert){
      echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
      <strong>Success!</strong> You note check has been inserted succesfully.
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
    }
  ?>
  <?php
    if($insert2){
      echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
      <strong>Success!</strong> Train added succesfully.
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
    }
  ?>
  <?php
    if($update){
      echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
      <strong>Success!</strong> You note check has been updated succesfully.
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
    }
  ?>
  <?php
    if($delete){
      echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
      <strong>Success!</strong> You note check has been deleted succesfully.
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
    }
  ?>

  <div class="container my-4">
    <a href="#" class="tag-btn active-tag" id="way1" onclick="toggleClass()" >Add Train</a>
    <a href="#" class="tag-btn" id="way2" onclick="toggleClass1()" >Enter schedule</a>
    <div id="withDate">
      <h5 style="text-align:center;color:#333">Add Train</h5>
      <form action="./admin.php" method="post" class="wrapper">
        <div class="left">
                <div class="mb-3">
                <label for="trainName" class="form-label">Train Name</label>
                <input type="text" class="form-control" id="trainName" name="trainName" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="capacity" class="form-label">Train Capacity</label>
                <input type="text" class="form-control" id="capacity" name="capacity" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="class" class="form-label">Class</label>
                <select name="class" id="class" class="form-control" placeholder="asd">
                  <?php
                    $sql = "SELECT * FROM `project`.`train_class`";
                    $result = mysqli_query($conn,$sql);
                    while($row = mysqli_fetch_assoc($result)){
                      $name = $row['name'];
                      $id = $row['classID'];
                      echo "<option value='$id'>$name</option>";
                    }
                  ?>
                </select>
                <!-- <input type="text" class="form-control" id="to" name="to" aria-describedby="emailHelp"> -->
            </div>
            <button type="submit" class="btn btn-primary btn-form">Add Train</button>
        </div>
      
        
      </div>
      
      
      

      
    </form>

    <div id="byName" class="show">
      <h5 style="text-align:center;color:#333">Enter Schedule</h5>
      <form action="./admin.php" method="post" class="wrapper">
        <div class="left">
                <div class="mb-3">
                <label for="trainID" class="form-label">Train ID</label>
                <input type="text" class="form-control" id="trainID" name="trainID" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="from" class="form-label">From</label>
                <input type="text" class="form-control" id="from" name="from" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="to" class="form-label">To</label>
                <input type="text" class="form-control" id="to" name="to" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="departDate" class="form-label">Depart Date</label>
                <input type="date" class="form-control" id="departDate" name="departDate" aria-describedby="emailHelp">
            </div>
            <button class="btn btn-primary btn-form invisible">Add Train</button>
        </div>
      <div class="right">
        <div class="mb-3">
            <label for="arrivalDate" class="form-label">Arrival Date</label>
            <input type="date" class="form-control" id="arrivalDate" name="arrivalDate" aria-describedby="emailHelp">
        </div>
            <div class="mb-3">
                <label for="departTime" class="form-label">Depart Time</label>
                <input type="time" class="form-control" id="departTime" name="departTime" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
            <label for="arrivalTime" class="form-label">Arrival Time</label>
            <input type="time" class="form-control" id="arrivalTime" name="arrivalTime" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="text" class="form-control" id="price" name="price" aria-describedby="emailHelp">
        </div>
        <button type="submit" class="btn btn-primary btn-form">Add Train</button>
      </div>
                  
      
        
        
        
      </div>
      
    </form>
    </div>
    </div>

    
    
  </div>

  <div class="container my-4">
    
    
  
</div>

  <div class="container my-5 show" id="schedule">
    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">ScheduleID</th>
          <th scope="col">Name</th>
          <th scope="col">From</th>
          <th scope="col">To</th>
          <th scope="col">Depart Date</th>
          <th scope="col">Depart Time</th>
          <th scope="col">Arrival Date</th>
          <th scope="col">Arrival Time</th>
          <th scope="col">Price</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <?php 
          // $sql = "SELECT * FROM `demo`.`trains` WHERE 1;";
          $sql = "SELECT * FROM `project`.`schedule` WHERE 1";
          $result = mysqli_query($conn,$sql);
          $sno = 0;
          while($row = mysqli_fetch_assoc($result)){
            $id = $row['trainID'];
            
            $sql2 = "SELECT * FROM `project`.`train` WHERE `trainID` = $id";
            $result2 = mysqli_query($conn,$sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $sno = $row['scheduleID'];
            $name = $row2['name'];

            echo "<tr>
            <th scope='row'>".$sno."</th>
            <td>".$name."</td>
            <td>".$row['tfrom']."</td>
            <td>".$row['tto']."</td>
            <td>".$row['arrival_date']."<br></td>
            <td>".$row['arrival']."<br></td>
            <td>".$row['depart_date']."<br></td>
            <td>".$row['depart']."<br></td>
            <td>".$row['price']."</td>
            <td><button class='Sedit btn btn-primary btn-sm my-1 px-3' id=".$sno.">Edit</button><button class='Sdelete px-3 btn btn-primary btn-sm ml-2 btn-danger' id=d".$sno.">Delete</button></td>
          </tr>";
          
            
          }
        ?>

        
        
        </tr>
      </tbody>
    </table>
  </div>

  <div class="container my-5" id="trains">
    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">TrainID</th>
          <th scope="col">Name</th>
          <th scope="col">Capacity</th>
          <th scope="col">Class</th>
          <th scope="col"></th>
          <th scope="col"></th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <?php 
          // $sql = "SELECT * FROM `demo`.`trains` WHERE 1;";
          $sql = "SELECT * FROM `project`.`train` WHERE 1";
          $result = mysqli_query($conn,$sql);
          $sno = 0;
          while($row = mysqli_fetch_assoc($result)){
            $id = $row['classID'];
            $sql2 = "SELECT * FROM `project`.`train_class` WHERE `classID` = '$id'";
            $result2 = mysqli_query($conn,$sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $id = $row['trainID'];

            echo "<tr>
            <th scope='row'>".$row['trainID']."</th>
            <td>".$row['name']."</td>
            <td>".$row['capacity']."</td>
            <td>".$row2['name']."</td><td></td><td></td>
            <td><button class='Tedit btn btn-primary btn-sm my-1 px-3' id=".$id.">Edit</button><button class='delete px-3 btn btn-primary btn-sm ml-2 btn-danger' id=d".$id.">Delete</button></td>
          </tr>";
          
            
          }
        ?>

        
        
        </tr>
      </tbody>
    </table>
  </div>



  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
    crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->

    <!-- TRAIN EDIT/DELETE -->
    <script>
      edits = document.getElementsByClassName('Tedit');
      Array.from(edits).forEach((element)=>{
        element.addEventListener("click",(e)=>{
          console.log("edit",);
          
          tr = e.target.parentNode.parentNode;
          trainName = tr.getElementsByTagName("td")[0].innerText;
          capacity = tr.getElementsByTagName("td")[1].innerText;
          classID = tr.getElementsByTagName("td")[2].innerText;
          
          
          
          capacityEdit.value = capacity;
          trainEdit.value = trainName;
          
          classEdit.value = classID;
          TsnoEdit.value = e.target.id;
          // console.log(trainNameEdit,capacityEdit);
          $('#TeditModal').modal('toggle');
          
        })
      })
    </script>
    <script>
      deletes = document.getElementsByClassName('delete');
      Array.from(deletes).forEach((element)=>{
        element.addEventListener("click",(e)=>{
          console.log("delete",);
          
          sno = e.target.id.substr(1,);

          if(confirm("Are you sure you want to delete!")){
            console.log("Yes");
            window.location = `./admin.php?delete=${sno}`;
          }
        })
      })
    </script>

    <!-- SCHEDULE EDIT/DELETE -->
    <script>
      edits = document.getElementsByClassName('Sedit');
      Array.from(edits).forEach((element)=>{
        element.addEventListener("click",(e)=>{
          console.log("edit",);
          
          tr = e.target.parentNode.parentNode;
          trainName = tr.getElementsByTagName("td")[0].innerText;
          from = tr.getElementsByTagName("td")[1].innerText;
          to = tr.getElementsByTagName("td")[2].innerText;
          departDate = tr.getElementsByTagName("td")[3].innerText;
          departTime = tr.getElementsByTagName("td")[4].innerText;
          arrivalDate = tr.getElementsByTagName("td")[5].innerText;
          arrivalTime = tr.getElementsByTagName("td")[6].innerText;
          price = tr.getElementsByTagName("td")[7].innerText;
          console.log(trainName,from);
          trainNameEdit.value = trainName;
          fromEdit.value = from;
          toEdit.value = to;
          departDateEdit.value = departDate;
          departTimeEdit.value = departTime;
          arrivalDateEdit.value = arrivalDate;
          arrivalTimeEdit.value = arrivalTime;
          priceEdit.value = price;
          snoEdit.value = e.target.id;
          $('#editModal').modal('toggle');
          
        })
      })
    </script>
    <script>
      deletes = document.getElementsByClassName('Sdelete');
      Array.from(deletes).forEach((element)=>{
        element.addEventListener("click",(e)=>{
          console.log("delete",);
          
          sno = e.target.id.substr(1,);

          if(confirm("Are you sure you want to delete!")){
            console.log("Yes");
            window.location = `./admin.php?Sdelete=${sno}`;
          }
        })
      })
    </script>
<script
  src="https://code.jquery.com/jquery-3.6.0.slim.min.js"
  integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI="
  crossorigin="anonymous"></script> 
    <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready( function () {
      $('#myTable').DataTable();
    } );
  </script>
  <script src="./js/index.js"></script>
</body>

</html>