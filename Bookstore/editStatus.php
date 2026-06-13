<?php
    include "database.php";
    include "get.php";

   
    if(isset($_POST['editStatus'])) {
         $editId = $_POST['transactionId'];
        $editStatus = $_POST['updateStatus'];
    }
  if(isset($_POST['statusSubmit'])){

    $updateId = $_POST['updateId'];
    $updateStatus = $_POST['updatestatus'];

    // Get current transaction information
    $queryCheck = "SELECT status, book_id, transaction_type, quantity
                FROM inventory_transactions
                WHERE transaction_id='$updateId'";

    $resultCheck = mysqli_query($connection, $queryCheck);
    $transaction = mysqli_fetch_assoc($resultCheck);

    $oldStatus = $transaction['status'];
    $bookId = $transaction['book_id'];
    $transactionType = $transaction['transaction_type'];
    $quantity = $transaction['quantity'];

    // Update inventory only once
    if($oldStatus == "Pending" && $updateStatus == "Approved"){

        if($transactionType == "Stock-Out"){

            $queryBook = "SELECT stock_quantity FROM books WHERE book_id='$bookId'";

            $resultBook = mysqli_query($connection, $queryBook);
            $book = mysqli_fetch_assoc($resultBook);

            if($quantity > $book['stock_quantity']){
                echo "<script>alert('Not enough stock available!');</script>";
                exit();
            }

            $queryUpdateBook = "UPDATE books SET stock_quantity = stock_quantity - $quantity WHERE book_id='$bookId'";
            mysqli_query($connection, $queryUpdateBook);

        }else if($transactionType == "Stock-In"){

            $queryUpdateBook = "UPDATE books SET stock_quantity = stock_quantity + $quantity WHERE book_id='$bookId'";
            mysqli_query($connection, $queryUpdateBook);
        }
    }

    // Update status
    $queryeditStatus = "UPDATE inventory_transactions SET status='$updateStatus' WHERE transaction_id='$updateId'";
    mysqli_query($connection, $queryeditStatus);

    echo '<script>alert("Status updated successfully!");</script>';
    echo '<script>window.location.href="index.php";</script>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
    <link rel="stylesheet" href="stylead.css">
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
       
            <form class="form-card" action="editStatus.php" method="post">

    <h1 style="text-align:center;">Edit Status</h1>

    <input type="hidden" name="updateId" value="<?php echo $editId; ?>">

    <label>Status</label>

    <select name="updatestatus" required>
        <option value="Pending" <?= $editStatus == 'Pending' ? 'selected' : '' ?>>Pending</option>

        <option value="Approved" <?= $editStatus == 'Approved' ? 'selected' : '' ?>>Approved</option>

        <option value="Rejected" <?= $editStatus == 'Rejected' ? 'selected' : '' ?>>Rejected</option>
    </select>

    <input type="submit" value="Update Status" name="statusSubmit">

</form>
    </div>
</body>
</html>