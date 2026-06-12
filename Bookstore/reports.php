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
                <a href="#" style="background: #0f172a; color: #ffffff; text-align: center;">Reports</a>
                <a href="transactions.php">Transactions</a>
                <a href="Login.php">Logout</a>
            </nav>
        </aside>

        <div class="container">
            <h1>Reports</h1>
            <p>Inventory reports for your bookstore.</p>

             <table class="inventory-table">
                <h1>Low Stocks Books</h1>
                <thead>
                    <tr>
                        <th>ISBN</th>
                        <th>Book Title</th>
                        <th>Stock Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($results = mysqli_fetch_array($sqlLowStock)) { ?>
                    <tr>
                        <td><?php echo $results['isbn']; ?></td>
                        <td><?php echo $results['title']; ?></td>
                          <td><span class="status low-stock"><?php echo $results['stock_quantity']; ?></span></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <br>
              <table class="inventory-table">
                <h1>Book Information Report</h1>
                <thead>
                    <tr>
                        <th>ISBN</th>
                        <th>Book Title</th>
                        <th>Author Name</th>
                         <th>Category Name</th>
                         <th>Price</th>
                         <th>Stock Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($results = mysqli_fetch_array($sqlAuthorCategory)) { ?>
                    <tr>
                        <td><?php echo $results['isbn']; ?></td>
                        <td><?php echo $results['title']; ?></td>
                        <td><?php echo $results['author_name']; ?></td>
                         <td><?php echo $results['category_name']; ?></td>
                          <td><?php echo $results['price']; ?></td>
                          <td><span class="status in-stock"><?php echo $results['stock_quantity']; ?></span></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <br>
            <table class="inventory-table">
                <h1>Total Books by Category</h1>
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Total Books</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($results = mysqli_fetch_array($sqlTotalBooks)) { ?>
                    <tr>
                    
                        <td><?php echo $results['category_name']; ?></td>
                        <td><?php echo $results['total_books']; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <br>
             <table class="inventory-table">
                <h1>Total Stocks by Category</h1>
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Total Stocks</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($results = mysqli_fetch_array($sqlTotalStock)) { ?>
                    <tr>
                    
                        <td><?php echo $results['category_name']; ?></td>
                        <td><?php echo $results['total_stock']; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
                <br>
                 <table class="inventory-table">
                <h1>Recent Transactions Report</h1>
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
                        <td><?php echo $results['full_name']; ?></td>
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