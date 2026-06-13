<?php
    include "database.php";
    include "get.php";

    if(isset($_POST['edit'])) {
          $bookId = $_POST['bookId'];
           $editISBN = $_POST['updateISBN'];
        $editTitle = $_POST['updateTitle'];
        $editPrice = $_POST['updatePrice'];
        $editStockQuantity = $_POST['updateStockQuantity'];
    }
    if(isset($_POST['updateSubmit'])){
        $bookId = $_POST['bookId'];
          $updateISBN = $_POST['updateISBN'];
        $updateTitle = $_POST['updateTitle'];    
        $updatePrice = $_POST['updatePrice'];
        $updateStockQuantity = $_POST['updateStockQuantity'];

       $queryUpdate = "UPDATE books SET isbn='$updateISBN', title='$updateTitle', price='$updatePrice', stock_quantity='$updateStockQuantity' WHERE book_id='$bookId'";
        $sqlUpdate = mysqli_query($connection, $queryUpdate);

        echo '<script>alert("Book updated successfully!");</script>';
        echo '<script>window.location.href = "index2.php";</script>';

    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookstore Inventory</title>
    <link rel="stylesheet" href="styles.css">
    <style>
                   :root{
    --primary: #8B5E3C;
    --secondary: #D2B48C;

    --background: #F8F5F0;
    --card: #FFFFFF;
    --text: #3E2C23;

    --hover: #A47149;
    --border: #E5DDD3;
}
body{
    margin: 0;
    font-family: Arial, sans-serif;
    background-color: var(--background);
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}
.form-wrapper{
    width: 100%;
    display: flex;
    justify-content: center;
}
.form-card{
    background: var(--card);
    color: var(--text);
    padding: 25px;
    width: 350px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

.form-card label{
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

.form-card input[type="text"],
.form-card select{
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}


.form-card input[type="submit"]{
    width: 100%;
    padding: 10px;
    border: none;
    background: var(--primary);
    color: #ffffff;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.form-card input[type="submit"]:hover{
      box-shadow: 0 2px 4px rgba(0, 0, 0, 1);
            background: var(--hover);
             transition: all 0.3s ease;
}
    </style>
</head>
<body>
        <div class="form-wrapper">
            <form class="form-card" action="/bookstore/edit.php" method="post">
                 <h1 style="color: var(--text); text-align: center;">Edit Details</h1>
            <!-- <label for="bookId">BookId</label>
            <input type="text" placeholder="Enter book ID" name="bookId"> <br> -->

            <input type="hidden" name="bookId" value="<?php echo $bookId; ?>">

                <label for="bookTitle">ISNB</label>
            <input type="text" name="updateISBN" value="<?php echo $editISBN; ?>"> <br>
            <label for="bookTitle">Title</label>
             <input type="text" name="updateTitle" value="<?php echo $editTitle; ?>"> <br>
        <br>

            <label for="Price">Price</label>
            <input type="text" name="updatePrice" value="<?php echo $editPrice; ?>"> <br>

            <label for="Quantity">Quantity</label>
            <input type="text" name="updateStockQuantity" value="<?php echo $editStockQuantity; ?>"> <br>

            <input type="submit" value="Submit" name="updateSubmit">

            </form>
                </div>
    </div>
</body>
</html>