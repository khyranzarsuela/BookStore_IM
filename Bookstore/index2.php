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
    .addBooks{
    background:#0f172a;
    color: #ffffff;
    border: none;
    border-radius: 8px;
    padding: 10px 20px;
    margin-bottom: 20px;
    cursor:pointer;
    margin-right: 10px;
    transition: all 0.3s ease;
    }
    .addBooks:hover{
             transform: translateY(-2px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 1);
            background:#0a1626;
             transition: all 0.3s ease;

        }
    .search-form {
    display: inline-block;
    align-items: center;
    justify-content: center;
    gap: 12px;
    margin: 0 auto 24px;
    width: 100%;
    max-width: 500px;
}

.searchbar {
    margin-left: 60px;
    padding: 12px 16px;
    width: 100%;
    max-width: 300px;
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
                <a href="#" style="background: #0f172a; color: #ffffff; text-align: center;">Inventory</a>
                <a href="categories.php">Categories</a>
                <a href="reports.php">Reports</a>
                <a href="transactions.php">Transactions</a>
                <a href="logout.php">Logout</a>
            </nav>
        </aside>

        <div class="container">
            <h1>Bookstore Inventory</h1>
            <p>Welcome to the Bookstore Inventory! See all books inventory,add books, authors, and categories.</p>
            <button class="addBooks" onclick="window.location.href='addBook.php'">Add Book</button>
            <button class="addBooks" onclick="window.location.href='addAuthor.php'">Add Author</button>
            <button class="addBooks" onclick="window.location.href='addCategory.php'">Add Category</button>

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
        echo "<table class='inventory-table'>";
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
            <table class="inventory-table">
                <thead>
                    <tr>
                        <!-- <th>Book ID</th> -->
                        <th>Book Title</th>
                        <th>Author Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock Quantity</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($results = mysqli_fetch_array($sqlBooks)) { ?>
                    <tr>
                        <input type="hidden" name="bookId" value="<?php echo $results['book_id']; ?>">
                        <td><?php echo $results['title']; ?></td>
                        <td><?php echo $results['author_name']; ?></td>
                        <td><?php echo $results['category_name']; ?></td>
                        <td><?php echo $results['price']; ?></td>
                        <td><span class="status in-stock"><?php echo $results['stock_quantity']; ?></span></td>
                        <td>
                            <form action="/bookstore/edit.php" method="post">
                                <input type="submit" value="Edit" name="edit" class="edit-btn"> 
                                <input type="hidden" name="bookId" value="<?php echo $results['book_id']; ?>">
                                 <input type="hidden" name="updateTitle" value="<?php echo $results['title']; ?>">
                                 <input type="hidden" name="updateAuthor" value="<?php echo $results['author_name']; ?>">
                                <input type="hidden" name="updateCategory" value="<?php echo $results['category_name']; ?>">
                                <input type="hidden" name="updatePrice" value="<?php echo $results['price']; ?>"> 
                                <input type="hidden" name="updateStockQuantity" value="<?php echo $results['stock_quantity']; ?>">
                            </form>
                            <form action="/bookstore/delete.php" method="post">
                                <input type="submit" value="Delete" name="delete" class="delete-btn">
                                <input type="hidden" name="DeleteId" value="<?php echo $results['book_id']; ?>">
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>