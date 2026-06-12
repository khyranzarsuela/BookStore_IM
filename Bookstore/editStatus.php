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

        $queryeditStatus = "UPDATE inventory_transactions SET status='$updateStatus' WHERE transaction_id='$updateId'";
        $sqlStatus = mysqli_query($connection, $queryeditStatus);

        

        echo '<script>alert("Status updated successfully!");</script>';
        echo '<script>window.location.href = "index.php";</script>';

         if($transactionType == "Stock-In" && $status == "Approved"){
                $queryUpdateBook = "UPDATE books SET stock_quantity = stock_quantity + $quantity WHERE book_id = $bookId";
                mysqli_query($connection, $queryUpdateBook);

            }
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
        .form-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-card {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        .form-card h2 {
            margin-bottom: 20px;
            color: #111827;
        }
        .form-card label {
            display: block;
            margin-bottom: 8px;
            color: #374151;
        }
        .form-card input[type="text"],
        .form-card input[type="number"],
        .form-card input[type="date"],
        .form-card select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"]{
        padding: 10px;
        border: none;
        border-radius: 8px;
        color: white;
        cursor:pointer;
        background: #23cc34;
        }
        
        input[type="submit"]:hover{
        background: #2ba111;
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