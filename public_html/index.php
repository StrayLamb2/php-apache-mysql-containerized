<?php
// Start Session
session_start();
// Check if user logged in
if(isset($_SESSION['login_user'])){
    // Redirect to teacher.php
    header("location:teacher.php");
    exit();
}else{
    // Else prompt to log in
    header("location:login.php");
    exit();
}
?>
