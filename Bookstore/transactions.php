<?php
    include "get.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookstore Inventory</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .addTransaction-btn{
    background:#0f172a;
    color: #ffffff;
    border: none;
    border-radius: 8px;
    padding: 10px 20px;
    margin-bottom: 20px;
    cursor:pointer;
    transition: all 0.3s ease;
        }
        .addTransaction-btn:hover{
             transform: translateY(-2px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 1);
            background:#0a1626;
             transition: all 0.3s ease;

        }
    </style>
</head>
<body>
    <div class="layout">
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>Welcome</h2>
            </div>
            <nav class="sidebar-nav">
                <a href="index.php">Home</a>
                <a href="index2.php">Inventory</a>
                <a href="categories.php">Categories</a>
                <a href="reports.php">Reports</a>
                <a href="#" style="background: #0f172a; color: #ffffff; text-align: center;">Transactions</a>
                <a href="Login.php">Logout</a>
            </nav>
        </aside>

        <div class="container">
            <h1>Transactions</h1>
            <p>Transaction records for your bookstore.</p>
            <button class="addTransaction-btn" onclick="window.location.href='addTransaction.php'">Add Transaction</button>
             <table class="inventory-table">
                <h1>Recent Transactions</h1>
                <thead>
                    <tr>
                        <th>Transaction ID</th>
                        <th>Book Title</th>
                        <th>Staff</th>
                        <th>Type</th>
                        <th>Quantity</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($results = mysqli_fetch_array($sqlTransactions)) { ?>
                    <tr>
                        <td><?php echo $results['transaction_id']; ?></td>
                        <td><?php echo $results['title']; ?></td>
                        <td><?php echo $results['staff_name']; ?></td>
                        <td><?php echo $results['transaction_type']; ?></td>
                        <td><?php echo $results['quantity']; ?></td>
                        <td><?php echo $results['transaction_date']; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>