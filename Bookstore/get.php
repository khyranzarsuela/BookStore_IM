<?php
    include "database.php";
    $queryBooks = "SELECT books.book_id,books.title,authors.author_name,categories.category_name,books.price,books.stock_quantity
                    FROM books
                    INNER JOIN authors ON books.author_id = authors.author_id
                    INNER JOIN categories ON books.category_id = categories.category_id;";
    $sqlBooks = mysqli_query($connection, $queryBooks);

    $queryAuthors = "SELECT * FROM authors;";
    $sqlAuthors = mysqli_query($connection, $queryAuthors);

    $queryCategories = "SELECT * FROM categories;";
    $sqlCategories = mysqli_query($connection, $queryCategories);

    $queryStaff = "SELECT * FROM staff;";
    $sqlStaff = mysqli_query($connection,$queryStaff);

    $queryTotalBooks = "SELECT 
                        categories.category_name,
                        COUNT(books.book_id) AS total_books
                    FROM books
                    INNER JOIN categories
                    ON books.category_id = categories.category_id
                    GROUP BY categories.category_name;
                    ";
    $sqlTotalBooks = mysqli_query($connection, $queryTotalBooks);
    
    $queryTotalStock = "SELECT 
                        categories.category_name,
                        SUM(books.stock_quantity) AS total_stock
                    FROM books
                    INNER JOIN categories
                    ON books.category_id = categories.category_id
                    GROUP BY categories.category_name;
                    ";
    $sqlTotalStock = mysqli_query($connection, $queryTotalStock);

    $queryLowStock = "SELECT `title`, `stock_quantity`
                    FROM `books`
                    WHERE `stock_quantity` < 10;
                    ";
    $sqlLowStock = mysqli_query($connection, $queryLowStock);

    $queryCategoryASC = "SELECT books.title, categories.category_name
                        FROM books
                        INNER JOIN categories ON books.category_id = categories.category_id
                        ORDER BY categories.category_name ASC;";
    $sqlCategoryASC = mysqli_query($connection, $queryCategoryASC);

    $queryCategoryDESC = "SELECT books.title, categories.category_name
                        FROM books
                        INNER JOIN categories ON books.category_id = categories.category_id
                        ORDER BY categories.category_name DESC;";
    $sqlCategoryDESC = mysqli_query($connection, $queryCategoryDESC);


    $queryTransactions = "SELECT inventory_transactions.transaction_id, books.title,staff.staff_name,inventory_transactions.transaction_type,inventory_transactions.quantity,inventory_transactions.transaction_date
                        FROM inventory_transactions
                        INNER JOIN books ON books.book_id = inventory_transactions.book_id
                        INNER JOIN staff ON staff.staff_id = inventory_transactions.staff_id;";
    $sqlTransactions = mysqli_query($connection, $queryTransactions);
?>