<?php
include('session.php');

// If coming with GET['edit']
if (isset($_GET['edit']) and !isset($_POST['update'])) {
    // Load student's data in the fields
    $id = $_GET['edit'];
    $update = true;
    $record = mysqli_query($db, "SELECT * FROM Students WHERE id = $id");
    if (count($record) == 1 ) {
        $n = mysqli_fetch_array($record);
        $id = $n['ID'];
        $name = $n['NAME'];
        $surname = $n['SURNAME'];
        $fathername = $n['FATHERNAME'];
        $grade = $n['GRADE'];
        $mobilenumber = $n['MOBILENUMBER'];
        $birthday = $n['BIRTHDAY'];
    }
}

// If coming with POST['update']
if (isset($_POST['update'])) {
    // Get data from input fields
    $id = $_POST['id'];
    $name = test_input($_POST["name"]);
    $surname = test_input($_POST["surname"]);
    $fathername = test_input($_POST["fathername"]);
    $grade = test_input($_POST["grade"]);
    $mobilenumber = test_input($_POST["mobilenumber"]);
    $birthday = test_input($_POST["birthday"]);

    // Update student with the unique id from the hidden input field bellow 
    mysqli_query($db, "UPDATE Students SET  NAME = '$name', 
        SURNAME = '$surname',
        FATHERNAME = '$fathername',
        GRADE = '$grade',
        MOBILENUMBER = '$mobilenumber',
        BIRTHDAY = '$birthday'
        WHERE ID = $id");
    $_SESSION['message'] = "Address updated!"; 
    header('location:teacher.php');
    exit();
}

// Helper function to clean input
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
        <form class="form w3-card-4" method="post" action="editStudent.php" >
            <div class="w3-container w3-green">
                <h2>Edit Student</h2>
            </div>
            <input type="hidden" name="id" value=<?php echo $id; ?>>
            <div class="input-group">
                <label>Name</label>
                <input class="w3-input" type="text" name="name" value="<?php echo $name; ?>">
            </div>
            <div class="input-group">
                <label>Surname</label>
                <input class="w3-input" type="text" name="surname" value="<?php echo $surname; ?>">
            </div>
            <div class="input-group">
                <label>Father's Name</label>
                <input class="w3-input" type="text" name="fathername" value="<?php echo $fathername; ?>">
            </div>
            <div class="input-group">
                <label>Grade</label>
                <input class="w3-input" type="number" step="0.01" min="0" name="grade" value="<?php echo $grade; ?>">
            </div>
            <div class="input-group">
                <label>Mobile Number</label>
                <input class="w3-input" type="text" name="mobilenumber" value="<?php echo $mobilenumber; ?>">
            </div>
            <div class="input-group">
                <label>Birthday</label>
                <input class="w3-input" type="date" name="birthday" value="<?php echo $birthday; ?>">
            </div>
            <div class="input-group">
                <button class="btn" type="submit" name="update" >Update</button>
            </div>
        </form>
    </div>
</body>
</html>
