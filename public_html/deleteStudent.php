<?php
include('session.php');

// Delete entry
if(isset($_GET['del'])){
    $id = $_GET['del'];
    mysqli_query($db, "DELETE FROM Students WHERE id = $id");
    $_SESSION['message'] = "Entry deleted!"; 
    header('location:teacher.php');
    exit();
}
?>
