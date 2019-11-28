<?php
include('session.php');
include('searchStudent.php');
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
        <div class="search-container">
            <form type="a" action="teacher.php" method="post">
            <input type="text" name="valueToSearch" placeholder="Search name or surname">
            <button type="submit" name="search"><i class="fa fa-search"></i></button>
        </div>
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
<?php 
$row = mysqli_fetch_array($search_result);
if(!isset($_POST['search']) and $row): ?>
    <div>
        <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Surame</th>
                <th>Father's Name</th>
                <th>Grade</th>
                <th>Mobile Number</th>
                <th>Birthday</th>
                <th></th>
                <th></th>
            </tr>
        </thead>

        <?php do {?>
            <tr>
                <td><?php echo $row['NAME'];?></td>
                <td><?php echo $row['SURNAME'];?></td>
                <td><?php echo $row['FATHERNAME'];?></td>
                <td><?php echo $row['GRADE'];?></td>
                <td><?php echo $row['MOBILENUMBER'];?></td>
                <td><?php echo $row['BIRTHDAY'];?></td>
                <td>
                    <a href="editStudent.php?edit=<?php echo $row['ID']; ?>" class="edit_btn" ><i class="fa fa-edit"></i></a>
                </td>
                <td>
                    <a href="deleteStudent.php?del=<?php echo $row['ID']; ?>" class="del_btn"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        <?php }while ($row = mysqli_fetch_array($search_result));?>
        </table>
    </div>
    <? elseif (isset($_POST['search']) and !$row): ?>
    <div class="msg">
        <h2>Entry not found!</h2>
    </div>
    <? else: ?>
    <div class="msg">
        <h2>Database is Empty.</h2>
        <h2>Please add a student!</h2>
    </div>
    <? endif ?>
</body>
</html>
