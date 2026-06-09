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
         .filter{
    background:#0f172a;
    color: #ffffff;
    border: none;
    border-radius: 8px;
    padding: 10px 20px;
    margin-bottom: 20px;
    cursor:pointer;
    transition: all 0.3s ease;
        }
        .filter:hover{
             transform: translateY(-2px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 1);
            background:#0a1626;
             transition: all 0.3s ease;

        }
         .sort-button{
    background:#0f172a;
    color: #ffffff;
    border: none;
    border-radius: 8px;
    padding: 10px 20px;
    margin-bottom: 20px;
    cursor:pointer;
    transition: all 0.3s ease;
        }
        .sort-button:hover{
             transform: translateY(-2px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 1);
            background:#0a1626;
             transition: all 0.3s ease;

        }
        .select{
    width: 100%;
    max-width: 200px;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
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
                <a href="#" style="background: #0f172a; color: #ffffff; text-align: center;">Categories</a>
                <a href="reports.php">Reports</a>
                <a href="transactions.php">Transactions</a>
                <a href="logout.php">Logout</a>
            </nav>
        </aside>

        <div class="container">
            <h1>Categories</h1>
            <p>Manage your bookstore categories.</p>
            <button class="sort-button" onclick="atoz()">Sort by ASC</button>
            <button class="sort-button" onclick="ztoa()">Sort by DESC</button>
            
             <form method="POST" action="filCategories.php">
              <select id="category" name="category" required class="select">
                <option value="all">All Categories</option>
                <?php while($c = mysqli_fetch_array($sqlCategories)) { ?>
                    <option value="<?php echo $c['category_id']; ?>"><?php echo htmlspecialchars($c['category_name']); ?></option>
                <?php } ?>
            </select>
            <button type="submit" name="filter-btn" class="filter">Filter</button>
        </form>
        
            <br>
             <table class="inventory-table">
                <h1>Books Browse by Category</h1>
                <thead>
                    <tr>
                        <th>Book Title</th>
                        <th>Category</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($results = mysqli_fetch_array($sqlCategoryDESC)) { ?>
                    <tr>
                    
                        <td><?php echo $results['title']; ?></td>
                          <td><span class="status in-stock"><?php echo $results['category_name']; ?></span></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
    <script>
        function atoz() {
            window.location.href = "categories.php";
        }
        function ztoa() {
            window.location.href = "categoDesc.php";
        }
    </script>
</html>