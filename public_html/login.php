<?php
include("config.php");
// Start Session
session_start();

// If user is logged in
if(isset($_SESSION['login_user'])){
    // Redirect to teacher.php
    header("location:teacher.php");
    exit();
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Username and password sent from form 
    $myusername = mysqli_real_escape_string($db,$_POST['username']);
    $mypassword = mysqli_real_escape_string($db,$_POST['password']); 

    // Check if teacher exists
    $sql = "SELECT id FROM Teachers WHERE username = '$myusername' and password = '$mypassword'";
    $result = mysqli_query($db,$sql);
    if (!$result) {
        printf("Error: %s\n", mysqli_error($db));
        exit();
    }
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $active = $row['active'];
    $count = mysqli_num_rows($result);

    // If result matched $myusername and $mypassword, table row must be 1 row
    if($count == 1) {
        $_SESSION['login_user'] = $myusername;

        header("location:teacher.php");
        exit();
    }else {
        $error = "Your Login Name or Password is invalid";
    }
}
?>
<!-- BASE CODE -->
<!DOCTYPE html>
<html>
<head>
    <title>Teacher's Homepage</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="topnav">
        <a class="active" href="index.php">Teacher's Site Login Page</a>
    </div>
<!-- PAGE -->
    <div>
        <form class="form w3-card-4" method="post" action="login.php" >
            <div class="w3-container w3-green">
                <h2>Login</h2>
            </div>
            <div class="input-group">
                <label>Username</label>
                <input class="w3-input" type="text" name="username" value="">
            </div>
            <div class="input-group">
                <label>Password</label>
                <input class="w3-input" type="password" name="password" value="">
            </div>
            <div class="input-group">
                <button class="btn" type="submit">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>
