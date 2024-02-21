<?php
include('header.php');
phpinfo();
// Connect to the database
$mysqli = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);

// output any connection error
if ($mysqli->connect_error) {
	die('Error : ('.$mysqli->connect_errno .') '. $mysqli->connect_error);
}

session_start();
if($_POST['username'] != "" && $_POST['password'] != "") {
    extract($_POST);

    $username = mysqli_real_escape_string($mysqli,$_POST['username']);
    $password = mysqli_real_escape_string($mysqli,$_POST['password']);

    $fetch = $mysqli->query("SELECT * FROM `users` WHERE username='$username'");

    $row = mysqli_fetch_array($fetch);

    if (password_verify($password, $row['password'])){
        $_SESSION['login_username'] = $row['username'];    
        echo 1;  
    } else {
        echo 0;
    }

} else {
    header("Location:index.php");
}
?>

<?php include('footer.php'); ?>
