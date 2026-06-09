<?php 
    include "database.php";

    if(isset($_POST['delete'])) {
        $deleteId = $_POST['DeleteId'];
        $queryDelete = "DELETE FROM books WHERE book_id = '$deleteId'";
        $sqlDelete = mysqli_query($connection, $queryDelete);

        echo '<script>alert("Book deleted successfully!");</script>';
        echo '<script>window.location.href = "index2.php";</script>';
    }
?>