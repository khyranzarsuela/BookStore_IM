<?php
    include "database.php";
    $queryBooksSimple = "SELECT book_id, title FROM books;";
    $sqlBooksSimple = mysqli_query($connection, $queryBooksSimple);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Transaction</title>
    <link rel="stylesheet" href="stylesss.css">
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
            background-color: var(--background);
        }
        .form-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-card {
            background-color: var(--card);
            color: var(--text);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        .form-card h2 {
            margin-bottom: 20px;
            color: var(--text);
        }
        .form-card label {
            display: block;
            margin-bottom: 8px;
            color: var(--text);
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
    </style>
</head>
<body>
    <div class="form-wrapper">
        <form class="form-card" action="add.php" method="post">
            <h2 style="margin-bottom: 20px; color: var(--text); text-align: center;">Add Transaction</h2>

            <label for="book">Book</label>
            <select id="book" name="book_id" required>
                <option value="">Select a book</option>
                <?php while($b = mysqli_fetch_array($sqlBooksSimple)) { ?>
                    <option value="<?php echo $b['book_id']; ?>"><?php echo htmlspecialchars($b['title']); ?></option>
                <?php } ?>
            </select>

            <label for="type">Transaction Type</label>
            <select name="transactionType" required>
        <option value="Stock-In" <?= ['transaction_type'] == 'Stock-In' ? 'selected' : '' ?>>Stock-In</option>

        <option value="Stock-Out" <?= ['transaction_type'] == 'Stock-Out' ? 'selected' : '' ?>>Stock-Out</option>
    </select>

             <label for="quantity">Quantity</label>
            <input type="number" id="quantity" name="quantity" min="1" required>
                 <input type="hidden" name="status" value="Pending">
            <label for="transaction_date">Date</label>
            <input type="date" id="transaction_date" name="transaction_date" value="2026-06-02" required>

            <button type="submit" name="submitTransaction" style="background-color: var(--primary);">Submit</button>
        </form>
    </div>

</body>
</html>