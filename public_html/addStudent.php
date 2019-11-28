<?php
include('session.php');

// When we get a post with name 'save':
if (isset($_POST['save'])) {
    $name = test_input($_POST["name"]);
    $surname = test_input($_POST["surname"]);
    $fathername = test_input($_POST["fathername"]);
    $grade = test_input($_POST["grade"]);
    $mobilenumber = test_input($_POST["mobilenumber"]);
    $birthday = test_input($_POST["birthday"]);

    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    // Ensure that the student doesn't exist (checking only the important fields to reduce load)
    $query = "SELECT * FROM Students WHERE name = '$name' 
        AND surname = '$surname'
        AND fathername = '$fathername'";
    $result = $db->query($query);
    if($result->num_rows > 0) {
        $_SESSION['message'] = "The student already exists"; 
    }
    else {
        // If stundent new, add to database
        $sql = "INSERT INTO Students (name, surname, fathername, grade, mobilenumber, birthday)
            VALUES ('$name', '$surname', '$fathername', '$grade', '$mobilenumber', '$birthday');";
        // Error checking
        if ($db->query($sql) === TRUE) {
            $_SESSION['message'] = "New record created successfully";
        } else {
            $_SESSION['message'] = "Error: " . $sql . "<br>" . $db->error;
        }
    }
    // Return to teacher.php
    header('location:teacher.php');
    exit();
}

// Helper function to clean the input
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
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
        <a class="active" href="index.php"><?php echo ucfirst($login_session); ?> <i class="fa fa-home"></i></a>
        <a href="addStudent.php">Add Student</a>
        <a class="btn-log-out" href="logout.php">Logout <i class="fa fa-sign-out"></i></a>
    </div>
    <?php if (isset($_SESSION['message'])): ?>
        <div class="msg">
<?php 
echo $_SESSION['message']; 
unset($_SESSION['message']);
?>
        </div>
    <?php endif ?>
<!-- PAGE -->
    <div>
        <form class="form w3-card-4" method="post" action="addStudent.php" >
            <div class="w3-container w3-green">
                <h2>Add Student</h2>
            </div>
            <div class="input-group">
                <label>Name</label>
                <input class="w3-input" type="text" name="name" value="">
            </div>
            <div class="input-group">
                <label>Surname</label>
                <input class="w3-input" type="text" name="surname" value="">
            </div>
            <div class="input-group">
                <label>Father's Name</label>
                <input class="w3-input" type="text" name="fathername" value="">
            </div>
            <div class="input-group">
                <label>Grade</label>
                <input class="w3-input" type="number" step="0.01" min="0" name="grade" value="">
            </div>
            <div class="input-group">
                <label>Mobile Number</label>
                <input class="w3-input" type="text" name="mobilenumber" value="">
            </div>
            <div class="input-group">
                <label>Birthday</label>
                <input class="w3-input" type="date" name="birthday" value="">
            </div>
            <div class="input-group">
                <button class="btn" type="submit" name="save" >Save</button>
            </div>
        </form>
    </div>
</body>
</html>
