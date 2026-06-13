<?php
    include "database.php";
    //q1
    $queryBooks = "SELECT book_id, isbn, title, price, stock_quantity FROM books;";
    $sqlBooks = mysqli_query($connection, $queryBooks);

    $queryAuthors = "SELECT * FROM authors;";
    $sqlAuthors = mysqli_query($connection, $queryAuthors);

    $queryCategories = "SELECT * FROM categories;";
    $sqlCategories = mysqli_query($connection, $queryCategories);

    $queryUsers = "SELECT * FROM users;";
    $sqlUsers = mysqli_query($connection,$queryUsers);

    //q9
    $queryTotalBooks = "SELECT 
                        categories.category_name,
                        COUNT(books.book_id) AS total_books
                    FROM books
                    INNER JOIN categories
                    ON books.category_id = categories.category_id
                    GROUP BY categories.category_name;";
    $sqlTotalBooks = mysqli_query($connection, $queryTotalBooks);
    
    //q10
    $queryTotalStock = "SELECT 
                        categories.category_name,
                        SUM(books.stock_quantity) AS total_stock
                    FROM books
                    INNER JOIN categories
                    ON books.category_id = categories.category_id
                    GROUP BY categories.category_name;";
    $sqlTotalStock = mysqli_query($connection, $queryTotalStock);

    //q2
    $queryLowStock = "SELECT isbn, title, stock_quantity FROM books WHERE stock_quantity < 10;";
    $sqlLowStock = mysqli_query($connection, $queryLowStock);

    //q8 - ASC
    $queryCategoryASC = "SELECT books.title, categories.category_name
                        FROM books
                        INNER JOIN categories ON books.category_id = categories.category_id
                        ORDER BY categories.category_name ASC;";
    $sqlCategoryASC = mysqli_query($connection, $queryCategoryASC);
    //q8 - DESC
    $queryCategoryDESC = "SELECT books.title, categories.category_name
                        FROM books
                        INNER JOIN categories ON books.category_id = categories.category_id
                        ORDER BY categories.category_name DESC;";
    $sqlCategoryDESC = mysqli_query($connection, $queryCategoryDESC);

    //q4
    $queryTransactions = "SELECT inventory_transactions.transaction_id, books.title, users.full_name, inventory_transactions.transaction_type, inventory_transactions.quantity, inventory_transactions.status, inventory_transactions.transaction_date 
                        FROM inventory_transactions 
                        INNER JOIN books ON inventory_transactions.book_id = books.book_id 
                        INNER JOIN users ON inventory_transactions.user_id = users.user_id;";
    $sqlTransactions = mysqli_query($connection, $queryTransactions);

    //q3
    $queryAuthorCategory = "SELECT books.isbn, books.title, authors.author_name, categories.category_name, books.price, books.stock_quantity 
                        FROM books 
                        INNER JOIN authors ON books.author_id = authors.author_id 
                        INNER JOIN categories ON books.category_id = categories.category_id;";
    $sqlAuthorCategory = mysqli_query($connection, $queryAuthorCategory);

    //q5
    $queryTransactionsA = "SELECT inventory_transactions.transaction_id, books.title, users.full_name, inventory_transactions.transaction_type, inventory_transactions.quantity, inventory_transactions.status, inventory_transactions.transaction_date 
                        FROM inventory_transactions 
                        INNER JOIN books ON inventory_transactions.book_id = books.book_id 
                        INNER JOIN users ON inventory_transactions.user_id = users.user_id
                        WHERE inventory_transactions.status = 'Approved';";
    $sqlTransactionsA = mysqli_query($connection,$queryTransactionsA);
?>