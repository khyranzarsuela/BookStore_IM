<?php
session_start();
include "database.php";

if(isset($_POST['submit'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $queryUser = "SELECT * FROM users
                INNER JOIN roles On users.role_id = roles.role_id
                WHERE username='$username'
                AND password='$password'";

    $result = mysqli_query($connection, $queryUser);

    if(mysqli_num_rows($result) > 0){

        $user = mysqli_fetch_assoc($result);

        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['full_name'] = $user['full_name'];
        $_SESSION['role_name'] = $user['role_name'];
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