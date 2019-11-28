<?php 
include "session.php";

// If coming with POST['search']
if(isset($_POST['search']))
{
    // Check the value to search
    $valueToSearch = $_POST["valueToSearch"];
    
    // Search in all eligible table columns using concat mysql function
    $query = "SELECT * FROM Students WHERE CONCAT_WS(name, surname) LIKE '%$valueToSearch%'";
    $search_result = filterTable($db, $query);
}
else {
    // If not searching, display all students
    $query = "SELECT * FROM Students";
    $search_result = filterTable($db, $query);
}

// Helper function to return the query results
function filterTable($db, $query)
{
    $filter_Result = mysqli_query($db, $query);
    return $filter_Result;
}
?>
