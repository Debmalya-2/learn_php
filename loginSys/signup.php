<?php 
    $showAlert=false;
    $showError=false;
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        require 'components/_dbConnect.php';
        $uname=$_POST["uname"];
        $uname=filter_var($uname,FILTER_SANITIZE_SPECIAL_CHARS);
        $umail=$_POST["umail"];
        $pass=$_POST["pass"];
        $cpass=$_POST["cpass"];
        $sql = "SELECT * FROM `registration` where username='$uname'";
        $result = mysqli_query($conn, $sql);
        $num=mysqli_num_rows($result);
        if($num == 1){
            $showError="Username already exist";
        }
        else{
            if(($pass == $cpass)){
                $sql = "INSERT INTO `registration` (`username`, `email`, `password`, `date`) VALUES ('$uname', '$umail', '$pass', current_timestamp())";
                $result = mysqli_query($conn, $sql);
                if($result){
                    $showAlert=true;
                }
            }
            else{
                $showError="Passwords do not match";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
    <?php require 'components/_nav.php' ?>
    <?php
        if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Registered Successfully!</strong> You can now <a href="/loginSys/login.php">login</a>.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
        if($showError){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Failed! </strong>'.$showError.'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
    ?>
    <div class="container">
        <h3 class="text-center my-3">Signup Here</h3>
        <form action="/loginSys/signup.php" method="post">
            <div class="mb-3 col-md-6">
                <label for="username" class="form-label">Username</label>
                <input class="form-control" maxlength="11" type="text" id="uname" name="uname" aria-label="default input example" required>
            </div>
            <div class="mb-3 col-md-6">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="umail" name="umail" placeholder="name@example.com" required>
            </div>
            <div class="mb-3 col-md-6">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="pass" name="pass" class="form-control" aria-describedby="passwordHelpBlock" required>
                <div id="passwordHelpBlock" class="form-text">
                    Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                </div>
            </div>
            <div class="mb-3 col-md-6">
                <label for="cpassword" class="form-label">Confirm Password</label>
                <input type="password" id="cpass" name="cpass" class="form-control" aria-describedby="passwordHelpBlock" required>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-success mb-3">Signup</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>