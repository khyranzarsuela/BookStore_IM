<?php 
    include "session.php";
    include "add.php";

     $queryTotalBooksCount = "SELECT COUNT(*) AS total_books FROM books;";
    $sqlTotalBooksCount = mysqli_query($connection, $queryTotalBooksCount);

     $queryTotalCategCount = "SELECT COUNT(*) AS total_categories FROM categories;";
    $sqlTotalCategCount = mysqli_query($connection, $queryTotalCategCount);

    $queryLowStockCount = "SELECT COUNT(*) AS low_stock_books FROM books WHERE stock_quantity < 10;";
    $sqlLowStockCount = mysqli_query($connection, $queryLowStockCount);

    $queryRecentTransactionsCount = "SELECT COUNT(*) AS recent_transactions FROM inventory_transactions WHERE transaction_date >= DATE_SUB(CURDATE(), INTERVAL 7 DAY);";
    $sqlRecentTransactionsCount = mysqli_query($connection, $queryRecentTransactionsCount);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookstore Inventory</title>
    <link rel="stylesheet" href="styless.css">
    <style>
        .search-form {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    margin: 0 auto 24px;
    width: 100%;
    max-width: 500px;
}

.searchbar {
    flex: 1;
    padding: 12px 16px;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    font-size: 1rem;
    color: #1d2939;
    font-family: Arial, sans-serif;
    transition: all 0.3s ease;
    background: #ffffff;
    margin-top: 60px;
}

.searchbar::placeholder {
    color: #94a3b8;
}

.searchbar:focus {
    outline: none;
    border-color: #0f172a;
    box-shadow: 0 0 0 3px rgba(15, 23, 42, 0.1);
}

.searchbar:hover {
    border-color: #cbd5e1;
}

.search-button {
    padding: 12px 20px;
    background: #0f172a;
    color: #ffffff;
    border: none;
    border-radius: 12px;
    font-weight: 600;
    font-size: 0.95rem;
     margin-top: 60px;
    cursor: pointer;
    transition: all 0.2s ease;
}

.search-button:hover {
    background: #1e293b;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(15, 23, 42, 0.2);
}

.search-button:active {
    transform: translateY(0);
}
.card1, .card2, .card3, .card4 {
   display: inline-block;
  margin-right: 20px;
  vertical-align: top;
    align-items: center;
    justify-content: center;
    background: #f8f9fa;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 20px;
    height: auto;
    width: 100%;
    max-width: 190px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    transition: all 0.5s ease;
}
.card1:hover {
    transform: translateY(-5px);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 1);
     background-color: #F0F8FF;
    cursor:pointer;

}
.card2:hover {
    transform: translateY(-5px);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 1);
     background-color: #F0F8FF;
    cursor:pointer;

}
.card3:hover {
    transform: translateY(-5px);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 1);
     background-color: #fff0f0;
    cursor:pointer;

}
.card4:hover {
    transform: translateY(-5px);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 1);
    background-color: #F0F8FF;
    cursor:pointer;

}
.summary-table{
    text-align: center;

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
                 <a href="#" style="background: #0f172a; color: #ffffff; text-align: center;">Home</a>
                <a href="index2.php">Inventory</a>
                <a href="categories.php">Categories</a>
                <a href="reports.php">Reports</a>
                <a href="transactions.php">Transactions</a>
                <a href="Login.php">Logout</a>
            </nav>
        </aside>

    <div class="container">
           <h1> Welcome, <?php echo $_SESSION['staff_name']; ?>!</h1>
        <p> Role: <?php echo ucfirst($_SESSION['role']); ?> </p>
         
        <p> This is your dashboard. Use the navigation menu to manage inventory, view reports, and handle transactions. </p>
        <h1>Summary Dashboard</h1>
              <div class="card1">
        <table class="summary-table">
                <thead>
                    <tr>
                        <th>Total Books: <?php $r = mysqli_fetch_assoc($sqlTotalBooksCount); ?>
                        <?php echo $r['total_books']; ?></th>
                    </tr>
            </thead>
            </table>
        </div>

          <div class="card2">
        <table class="summary-table">
                <thead>
                    <tr>
                         <th>Total Categories: <?php $r = mysqli_fetch_assoc($sqlTotalCategCount); ?>
                        <?php echo $r['total_categories']; ?></th>
                    </tr>
            </thead>
            </table>
        </div>

        <div class="card3">
        <table class="summary-table">
                <thead>
                    <tr>
                         <th>Low Stock Books: <?php $r = mysqli_fetch_assoc($sqlLowStockCount); ?>
                        <?php echo $r['low_stock_books']; ?></th>
                    </tr>
            </thead>
            </table>

        </div>

         <div class="card4">
        <table class="summary-table">
                <thead>
                    <tr>
                         <th>Recent Transactions: <?php $r = mysqli_fetch_assoc($sqlRecentTransactionsCount); ?>
                        <?php echo $r['recent_transactions']; ?></th>
                    </tr>
            </thead>
            </table>

        </div>

        <form method="POST" class="search-form">
            <input type="text" class="searchbar" name="searchh" placeholder="Search by book title..." required>
            <button type="submit" class="search-button">Search</button>
        </form>
        <?php
          if(isset($_POST['searchh'])){
        $searchTerm = $_POST['searchh'];
        $querySearch = "SELECT books.book_id,books.title,authors.author_name,categories.category_name,books.price,books.stock_quantity
                        FROM books
                        INNER JOIN authors ON books.author_id = authors.author_id
                        INNER JOIN categories ON books.category_id = categories.category_id
                        WHERE books.title LIKE '%".$searchTerm."%';";
        $sqlSearch = mysqli_query($connection, $querySearch);

           if(mysqli_num_rows($sqlSearch) > 0){
            $result = mysqli_fetch_assoc($sqlSearch);
        echo "<table class='search-table'>";
        echo "<tr>";
        echo "<th>Book ID</th>";
        echo "<th>Title</th>";
        echo "<th>Author</th>";
        echo "<th>Category</th>";
        echo "<th>Price</th>";
        echo "<th>Stock Quantity</th>";
        echo "<tr>";
        echo "<td>".$result['book_id']."</td>";
        echo "<td>".$result['title']."</td>";
        echo "<td>".$result['author_name']."</td>";
        echo "<td>".$result['category_name']."</td>";
        echo "<td>".$result['price']."</td>";
        echo "<td>".$result['stock_quantity']."</td>";
        echo "</tr>";
        echo "</table>";
            }
            else{
            echo "<h3 class='h3'>Book not found.</h3>";
            }
    } ?>
        </div>
    </div>
</body>
</html>