<?php
session_start();
include "database.php";

if(isset($_POST['submit'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $queryUser = "SELECT * FROM staff
              WHERE username='$username'
              AND password='$password'";

    $result = mysqli_query($connection, $queryUser);

    if(mysqli_num_rows($result) > 0){

        $user = mysqli_fetch_assoc($result);

        $_SESSION['staff_id'] = $user['staff_id'];
        $_SESSION['staff_name'] = $user['staff_name'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['username'] = $user['username'];

        header("Location: index.php");
        exit();
    }
    else{
        echo '<script>alert("Invalid username or password!");</script>';
        echo '<script>window.location.href="Login.php";</script>';
    }
}
?>