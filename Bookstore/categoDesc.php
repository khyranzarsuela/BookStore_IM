<?php
    include "get.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookstore Inventory</title>
    <link rel="stylesheet" href="style3.css">
    <style>
         .filter{
     background:var(--primary);
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
               background: var(--hover);
             transition: all 0.3s ease;

        }
         .sort-button{
    background:var(--primary);
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
            background: var(--hover);
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
                <h2 style="text-align: center; color: var(--text);">Welcome</h2>
            </div>
            <nav class="sidebar-nav">
                <a href="index.php">Home</a>
                <a href="index2.php">Inventory</a>
                <a href="#" style="background: var(--primary); color: #ffffff; text-align: center;">Categories</a>
                <a href="reports.php">Reports</a>
                <a href="transactions.php">Transactions</a>
                <a href="Login.php">Logout</a>
            </nav>
        </aside>

        <div class="container">
            <h1 style="color: var(--text);">Categories</h1>
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
             <div class="inventory-section">
             <table class="inventory-table">
                <h1 style="color: var(--text); font-size: 20px;">Books Browse by Category</h1>
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Book Title</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($results = mysqli_fetch_array($sqlCategoryDESC)) { ?>
                    <tr>
                     <td><span class="status in-stock"><?php echo $results['category_name']; ?></span></td>
                        <td><?php echo $results['title']; ?></td>
                         
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            </div>
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