<?php
include('config.php');
session_start();

$user_check = $_SESSION['login_user'];

// Check if user exists on teachers
$ses_sql = mysqli_query($db,"SELECT username FROM Teachers WHERE username = '$user_check' ");

$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

// Keep username for the session
$login_session = $row['username'];

// If user is not logged in (or fails) redirect to index.php
if(!isset($_SESSION['login_user'])){
    header("location:index.php");
    die();
}
?>
