<?php
    session_start();
    $username = "";
    $email = "";
    $password = "";
    $errors = array();
    $search_by = "";
    
    
    
    $db = mysqli_connect('localhost','root','');
    // $db = mysqli_connect('sql110.epizy.com','epiz_28936655','11kAuB3E9waX1');
    if(!$db){
        echo 'not connddected';
    }

    if(isset($_POST['register'])){
        
        $username = $_POST['username'];
        $name = $_POST['name'];
        $email =$_POST['email'];
        $phone =$_POST['phone'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];
        

        if(empty($username)){
            array_push($errors, "Username is required");
        }
        if(empty($name)){
            array_push($errors, "Name is required");
        }
        if(empty($email)){
            array_push($errors, "Email is required");
        }
        if(empty($phone)){
            array_push($errors, "Phone is required");
        }
        if(empty($password)){
            array_push($errors, "Password is required");
        }
    
        if($password != $password2){
            array_push($errors, "The two passwords must be same");
        }
        $sql = "SELECT * FROM `project`.`user` WHERE 1";
        $result = mysqli_query($db,$sql);
        $row = mysqli_fetch_assoc($result);
        if($row['username'] == $username){
            array_push($errors, "Username already taken!");
        }
        if(count($errors) == 0){
            
            // $sql = "INSERT INTO `demo`.`users` (`name`,`email`,`password`) VALUES ('$username','$email','$password');";
            $sql = "INSERT INTO `project`.`user` (`username`, `name`, `email`, `phone`, `password`) VALUES ('$username', '$name', '$email', '$phone', '$password');";
            mysqli_query($db,$sql);
            $_SESSION['username'] = $username;
            
            $_SESSION['success'] = "You are logged in";
            header('location: login.php');
        }
    }

    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        

        if(empty($username)){
            array_push($errors, "Username is required");
        }
        if(empty($password)){
            array_push($errors, "Password is required");
        }
        
        if(count($errors) == 0){
            // $password1 = md5($password);
            $query = "SELECT * from `project`.`user` WHERE `username` = '$username' and `password` = '$password' ";
            $result = mysqli_query($db,$query);
           
            if(!$result){
                echo "Invalid";
            }
            
            if($row = mysqli_fetch_assoc( $result )){
                
                $_SESSION['username'] = $username;
                $_SESSION['userID'] = $row['id'];
                
                $_SESSION['success'] = "You are logged in";
                header('location: index.php');
            }else{
                array_push($errors,"wrong username/password combination");
            }
        }
    }

    if(isset($_POST['Ausername'])){
        $username = $_POST['Ausername'];
        $password = $_POST['password'];
        

        if(empty($username)){
            array_push($errors, "Username is required");
        }
        if(empty($password)){
            array_push($errors, "Password is required");
        }
        
        if(count($errors) == 0){
            // $password1 = md5($password);
            $query = "SELECT * from `project`.`admin` WHERE `username` = '$username' and `password` = '$password' ";
            $result = mysqli_query($db,$query);
           
            if(!$result){
                echo "Invalid";
            }
            
            if($row = mysqli_fetch_assoc( $result )){
                
                $_SESSION['username'] = $username;
                $_SESSION['userID'] = $row['id'];
                
                $_SESSION['success'] = "You are logged in";
                header('location: admin.php');
            }else{
                array_push($errors,"wrong username/password combination");
            }
        }
    }

    if(isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['username']);
        header('location: index.php');
    }

    // if($_GET['search_by'] == "1"){
    //     $_SESSION['search_by'] = "name";
    //     header('location: index.php');
    // }
    // if($_GET['search_by'] == "0"){
    //     unset($_SESSION['search_by']);
    //     header('location: index.php');
    // }

    
    

    

    
?>