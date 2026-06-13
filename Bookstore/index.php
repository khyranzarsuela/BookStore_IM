<?php 
    include "session.php";
    include "add.php";

    
     $queryTotalBooksCount = "SELECT COUNT(*) AS total_books FROM books;";
    $sqlTotalBooksCount = mysqli_query($connection, $queryTotalBooksCount);

     $queryTotalCategCount = "SELECT COUNT(*) AS total_categories FROM categories;";
    $sqlTotalCategCount = mysqli_query($connection, $queryTotalCategCount);

    $queryLowStockCount = "SELECT COUNT(*) AS low_stock_books FROM books WHERE stock_quantity < 10;";
    $sqlLowStockCount = mysqli_query($connection, $queryLowStockCount);

     $queryLowStock = "SELECT isbn, title, stock_quantity FROM books WHERE stock_quantity < 10;";
    $sqlLowStock = mysqli_query($connection, $queryLowStock);

    $queryRecentTransactionsCount = "SELECT COUNT(*) AS recent_transactions FROM inventory_transactions WHERE transaction_date >= DATE_SUB(CURDATE(), INTERVAL 7 DAY);";
    $sqlRecentTransactionsCount = mysqli_query($connection, $queryRecentTransactionsCount);

    //q11
    $queryApprovedCount = "SELECT users.full_name, COUNT(inventory_transactions.transaction_id) AS approved_transactions 
                        FROM users 
                        INNER JOIN inventory_transactions 
                        ON users.user_id = inventory_transactions.user_id WHERE inventory_transactions.status = 'Approved' GROUP BY users.full_name;";
     $sqlApprovedCount = mysqli_query($connection,$queryApprovedCount);

     //q6
     $queryTransactionsP = "SELECT inventory_transactions.transaction_id, books.title, users.full_name, inventory_transactions.transaction_type, inventory_transactions.quantity, inventory_transactions.status, inventory_transactions.transaction_date 
                        FROM inventory_transactions 
                        INNER JOIN books ON inventory_transactions.book_id = books.book_id 
                        INNER JOIN users ON inventory_transactions.user_id = users.user_id
                        WHERE inventory_transactions.status = 'Pending';";
    $sqlTransactionsP = mysqli_query($connection, $queryTransactionsP);

    //q7
    $queryUsers = "SELECT users.full_name, users.username, roles.role_name, users.status 
                FROM users 
                INNER JOIN roles ON users.role_id = roles.role_id;";
     $sqlUsers = mysqli_query($connection,$queryUsers);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookstore Inventory</title>
    <link rel="stylesheet" href="s.css">
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
    background: var(--primary);
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
    background: var(--hover);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(15, 23, 42, 0.2);
}

.search-button:active {
    transform: translateY(0);
}
/* .card1, .card2, .card3, .card4 {
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
} */
.card1, .card2, .card3, .card4, .card5{
   display: inline-block;
  margin-right: 20px;
  vertical-align: top;
    align-items: center;
    justify-content: center;
    background: var(--card);
    border-top: 10px solid  #8B5E3C;
    border-radius: 20px;
    padding: 20px;
    height: 110px;
    width: 100%;
    max-width: 230px;

    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    transition: all 0.5s ease;
}
.card1:hover {
    transform: translateY(-5px);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 1);
     background-color:  #eae4df;
    cursor:pointer;

}
.card2:hover {
    transform: translateY(-5px);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 1);
     background-color:  #eae4df;
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
.card5:hover {
    transform: translateY(-5px);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 1);
    background-color: #F0F8FF;
    cursor:pointer;

}
.summary-table{
    text-align: center;

}
.summary-table .t1, .t2{
    text-align: center;
    margin: 0px;
    padding:10px;
    font-size: 15px;
    color: var(--text);
}
.t2{
    font-weight: bold;
     text-align: center;
    margin: 0px;
    padding:10px;
    font-size: 40px;
}
.inventory-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}
.inventory-table th,
.inventory-table td {
    font-size: 12px;
    padding: 16px 14px;
    text-align: left;
    border-bottom: 1px solid #e2e8f0;
}
.inventory-table th {
    background: var(--secondary);
    font-weight: 700;
    color: var(--text);
}
.inventory-table tr:hover {
    background: var(--background);
    transition: 0.3s ease;
}
.inventory-table tbody tr:last-child td {
    border-bottom: none;
}
.status {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 6px 10px;
    border-radius: 999px;
    font-size: 0.95rem;
    font-weight: 600;
    color: var(--text);
    background: #e2e8f0;
}
.status.low-stock {
    background: #fee2e2;
    color: #991b1b;
}
.status.in-stock {
    background: #dcfce7;
    color: #166534;
}
.caption {
    font-size: 0.95rem;
    color: #64748b;
    margin-top: 8px;
}
:root{
    --primary: #8B5E3C;
    --secondary: #D2B48C;

    --background: #F8F5F0;
    --card: #FFFFFF;
    --text: #3E2C23;

    --hover: #A47149;
    --border: #E5DDD3;
}
 .dashboard-panels {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    align-items: flex-start;
    margin-top: 24px;
     opacity: 0;
     transform: translateY(50px);
     transition: opacity 1s ease, transform 1s ease;
}

.pendings{
    flex: 1 1 320px;
   width: 100%;
   max-width:70%;
    border-radius: 12px;
    background-color: var(--card);
    padding: 30px;
    box-sizing: border-box;
}
.low{
     flex: 1 1 320px;
    width: 100%;
    max-width: 28%;
    border-radius: 12px;
    background-color: var(--card);
    padding-top:20px;
    padding-left:15px;
    padding-right: 10px;
    box-sizing: border-box;
    
}
.lower{
     flex: 1 1 320px;
    width: 100%;
    max-width: 100%;
    border-radius: 12px;
    background-color: var(--card);
    padding-top:20px;
    padding-left:15px;
    padding-right: 10px;
    box-sizing: border-box;
    
}

.pendings {
     opacity: 0;
     transform: translateY(50px);
     transition: opacity 1s ease, transform 1s ease;
}
.appear{
          opacity: 1;
        transform: translateY(0);
    }
.edit-btn{
    background:#10b981;
    border: none;
    border-radius: 8px;
    color: #ffffff;
    padding: 5px 10px; 
    margin-bottom: 5px;
    cursor:pointer;
    }
    .edit-btn:hover{
        background:#059669;
    }
    .delete-btn{
        background:#ef4444;
         border: none;
    border-radius: 8px;
    color: #ffffff;
    padding: 5px 10px; 
     margin-top: 5px;
     cursor:pointer;
    }
    .delete-btn:hover{
        background:#dc2626;
    }
    .hellopage{
        animation: it 1s ease;
    }
    @keyframes it {
        from{opacity:0; transform: translateY(-10px);}
       to{opacity:1; transform: translateY(0px)};

    }

    </style>
</head>
<body>
    <div class="layout">
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2 style="text-align: center; color: var(--text);">Welcome</h2>
            </div>
            <nav class="sidebar-nav">
                 <a href="#" style="  background-color: var(--primary); color: var(--background); text-align: center;">Home</a>
                <a href="index2.php">Inventory</a>
                <a href="categories.php">Categories</a>
                <a href="reports.php">Reports</a>
                <a href="transactions.php">Transactions</a>
                <a href="Login.php">Logout</a>
            </nav>
        </aside>

    <div class="container">
        <div class="hellopage">
           <h1> Welcome, <?php echo $_SESSION['full_name']; ?>!</h1>
        <p> Role: <?php echo ucfirst($_SESSION['role_name']); ?> </p>
         
        <p> This is your dashboard. Use the navigation menu to manage inventory, view reports, and handle transactions. </p>
       </div>
        <h1>Summary Dashboard</h1>

              <div class="card1">
        <div class="summary-table">
            <h1 class="t1">Total Books</h1>
                        <h2 class="t2">
                        <?php $r = mysqli_fetch_assoc($sqlTotalBooksCount); ?>
                         <?php echo $r['total_books']; ?></h2>
            </div>
        </div>

           <div class="card2">
        <div class="summary-table">
            <h1 class="t1">Total Categories</h1>
                    <h2 class="t2">
                            <?php $r = mysqli_fetch_assoc($sqlTotalCategCount); ?>
                        <?php echo $r['total_categories']; ?>
            </div>
        </div>

        <div class="card3">
        <div class="summary-table">
                <h1 class="t1">Low Stock Books</h1></th>
                   <h2 class="t2">
                            <?php $r = mysqli_fetch_assoc($sqlLowStockCount); ?>
                        <?php echo $r['low_stock_books']; ?></h2>
</div>
        </div>

         <div class="card4">
        <div class="summary-table">
            <h1 class="t1">Recent Transactions</h1>
             <h2 class="t2">
             <?php $r = mysqli_fetch_assoc($sqlRecentTransactionsCount); ?>
             <?php echo $r['recent_transactions']; ?></h2>
</div>
        </div>
        <div class="card5">
        <div class="summary-table">
            <h1 class="t1">Approved Request</h1>
             <h2 class="t2">
             <?php $r = mysqli_fetch_assoc($sqlApprovedCount); ?>
             <?php echo $r['approved_transactions']; ?></h2>
</div>
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
      
            <div class="dashboard-panels">
            <?php if ($_SESSION['role_name'] === "Admin") { ?>
  <div class="pendings">
    <h1 style="color: var(--text); font-size: 20px;">Pending Transactions</h1>

    <table class="inventory-table">
        <thead>
            <tr>
               
                <th>Book Title</th>
                <th>Staff</th>
                <th>Type</th>
                <th>Quantity</th>
                <th>Status</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

        <?php while ($results = mysqli_fetch_array($sqlTransactionsP)) { ?>
            <tr>
               
                <td><?php echo $results['title']; ?></td>
                <td><?php echo $results['full_name']; ?></td>
                <td><?php echo $results['transaction_type']; ?></td>
                <td><?php echo $results['quantity']; ?></td>
                <td><?php echo $results['status']; ?></td>
                <td><?php echo $results['transaction_date']; ?></td>
                <td>
                <form action="editStatus.php" method="post">
                    <input type="submit" value="Edit Status" name="editStatus" class="edit-btn"> 
                    <input type="hidden" name="transactionId" value="<?php echo $results['transaction_id']; ?>">
                    <input type="hidden" name="updateStatus" value="<?php echo $results['status']; ?>">
                </form>
                <!-- <form action="delete.php" method="post">
                    <input type="submit" value="Delete" name="deleteStatus" class="delete-btn">
                    <input type="hidden" name="DeleteId" value="<?php echo $results['transaction_id']; ?>">
                </form> -->
            </td>
            </tr>
        <?php } ?>

        </tbody>
    </table>

<?php } ?>
</div>
        <div class="low">
                 <table class="inventory-table">
                <h1 style="color: var(--text); font-size: 20px; margin-bottom:20px;">Low Stocks Books</h1>
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
            </div>

             <div class="lower">
                 <table class="inventory-table">
                <h1 style="color: var(--text); font-size: 20px; margin-bottom:20px;">Admins and Staff</h1>
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($results = mysqli_fetch_array($sqlUsers)) { ?>
                    <tr>
                        <td><?php echo $results['full_name']; ?></td>
                        <td><?php echo $results['username']; ?></td>
                        <td><?php echo $results['role_name']; ?></td>
                        <td><?php echo $results['status']; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            </div>
            </div>

        </div>
    </div>
    <script>
     const fadeElement1 = document.querySelectorAll('.pendings');
     const fadeElement2 = document.querySelectorAll('.dashboard-panels');

    const observer = new IntersectionObserver((entries) => {

        entries.forEach(entry => {

            if(entry.isIntersecting){
                entry.target.classList.add('appear');
            }

        });

    });

    fadeElement1.forEach(el => observer.observe(el));
     fadeElement2.forEach(el => observer.observe(el));
</script>
</body>
</html>