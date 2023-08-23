<?php 
    $login=false;
    $showError=false;
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        require 'components/_dbConnect.php';
        $uname=$_POST["uname"];
        $pass=$_POST["pass"];

        $sql = "SELECT * FROM registration where username='$uname'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if($num==1){
            while($row = mysqli_fetch_assoc($result)){
                if(password_verify($pass, $row['password'])){
                    $login = true;
                    session_start();
                    $_SESSION['loggedin']=true;
                    $_SESSION['username']=$uname;
                    header("location: welcome.php");
                }
            }
            
            
        }
        else{
            $showError="Invalid Credentials";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
    <?php require 'components/_nav.php' ?>
    <?php
        if($login){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> You are logged in.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
    ?>
    <div class="container">
        <h3 class="text-center my-3">Login Here</h3>
        <form action="/loginSys/login.php" method="post">
            <div class="mb-3 col-md-6">
                <label for="username" class="form-label">Username</label>
                <input class="form-control" type="text" id="uname" name="uname" aria-label="default input example" required>
            </div>
            <div class="mb-3 col-md-6">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="pass" name="pass" class="form-control" aria-describedby="passwordHelpBlock" required>
            </div>
            <?php
                if($showError){
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Failed! </strong>'.$showError.'
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                }
            ?>
            <div class="col-auto">
                <button type="submit" class="btn btn-success mb-3">Login</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>
