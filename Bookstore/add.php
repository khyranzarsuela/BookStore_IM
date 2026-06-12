<?php
    include "database.php";

    if(isset($_POST['submit'])){
        $bookId = uniqid();
        $bookTitle = $_POST['bookTitle'];
        $author = $_POST['author'];
        $category = $_POST['category'];
        $price = $_POST['price'];
        $stockQuantity = $_POST['stockQuantity'];

        $queryAdd = "INSERT INTO books (title,author_id,category_id,price,stock_quantity) VALUES ('$bookTitle','$author','$category','$price','$stockQuantity')";
        $sqlAdd = mysqli_query($connection, $queryAdd);

        echo '<script>alert("Book added successfully!");</script>';
        echo '<script>window.location.href = "index2.php";</script>';
    }

    if(isset($_POST['submitauthor'])){
        $authorid = uniqid();
        $authorName = $_POST['authorName'];

        $queryAddAuthor = "INSERT INTO authors (author_name) VALUES ('$authorName')";
        $sqlAddAuthor = mysqli_query($connection, $queryAddAuthor);

        echo '<script>alert("Author added successfully!");</script>';
        echo '<script>window.location.href = "index2.php";</script>';
    }

     if(isset($_POST['submitcategory'])){
        $categoryid = uniqid();
        $categoryName = $_POST['categoryName'];

        $queryAddCategory = "INSERT INTO categories (category_name) VALUES ('$categoryName')";
        $sqlAddCategory = mysqli_query($connection, $queryAddCategory);

        echo '<script>alert("Category added successfully!");</script>';
        echo '<script>window.location.href = "index2.php";</script>';
    }

    if(isset($_POST['submitTransaction'])){
         session_start();
        $bookId = $_POST['book_id'];
        $users = $_SESSION['user_id'];
        $transactionType = $_POST['transactionType'];
        $quantity = $_POST['quantity'];
        $status = $_POST['status'];
        $date = $_POST['transaction_date'];
            
            $queryAddTransaction = "INSERT INTO inventory_transactions (book_id, user_id, transaction_type, quantity, status, transaction_date) VALUES ('$bookId', '$users','$transactionType','$quantity','$status','$date')";
            $sqlAddTransaction = mysqli_query($connection, $queryAddTransaction);
        
            // if($transactionType == "Stock-In" && $status == "Approved"){
            //     $queryUpdateBook = "UPDATE books SET stock_quantity = stock_quantity + $quantity WHERE book_id = $bookId";
            //     mysqli_query($connection, $queryUpdateBook);

            // }
            // elseif($transactionType == "Stock-Out"){
            //     $queryUpdateBook = "UPDATE books SET stock_quantity = stock_quantity - $quantity WHERE book_id = $bookId";
            //     mysqli_query($connection, $queryUpdateBook);

            // }

        echo '<script>alert("Transaction added successfully!");</script>';
        echo '<script>window.location.href = "transactions.php";</script>';

        // $queryBook = "SELECT stock_quantity FROM books WHERE book_id = $bookId";
        // $resultBook = mysqli_query($connection, $queryBook);
        // $book = mysqli_fetch_assoc($resultBook);
        // $currentStock = $book['stock_quantity'];

        // if($transactionType == "Stock Out"){

        //     if($quantity > $currentStock){

        //         echo '<script>alert("Not enough stock available!");</script>';
        //         exit();
        //     }

        //     $queryUpdateBook = "UPDATE books SET stock_quantity = stock_quantity - $quantity WHERE book_id = $bookId";
        //     mysqli_query($connection, $queryUpdateBook);
        // }
        //     }
    }

        if(isset($_POST['filter-btn'])){

        $category = $_POST['category'];

            if($category != "all"){
        $queryBooksCateg = "SELECT books.title, categories.category_name
                        FROM books
                        INNER JOIN categories
                        ON books.category_id = categories.category_id
                        WHERE categories.category_id = '$category'
                        ORDER BY categories.category_name ASC";
                        $sqlBooksCateg = mysqli_query($connection, $queryBooksCateg);
        }
        else{
            $queryBooksCateg = "SELECT books.title, categories.category_name
                            FROM books
                            INNER JOIN categories
                            ON books.category_id = categories.category_id
                            ORDER BY categories.category_name ASC";
                            $sqlBooksCateg = mysqli_query($connection, $queryBooksCateg);
    }
        }
        
?>