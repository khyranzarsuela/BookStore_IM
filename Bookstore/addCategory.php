 <?php
    include "get.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
    <style>
body{
    margin: 0;
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}
.form-wrapper{
    width: 100%;
    display: flex;
    justify-content: center;
}
.form-card{
    background: #fff;
    padding: 25px;
    width: 350px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

.form-card label{
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

.form-card input[type="text"],
.form-card select{
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}


.form-card input[type="submit"]{
    width: 100%;
    padding: 10px;
    border: none;
    background:#0f172a;
    color: #ffffff;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.form-card input[type="submit"]:hover{
      box-shadow: 0 2px 4px rgba(0, 0, 0, 1);
            background:#0a1626;
             transition: all 0.3s ease;
}
    </style>
</head>
<body>
    <div class="form-wrapper">
         <form class="form-card" action="add.php" method="post">
            <!-- <label for="bookId">BookId</label>
            <input type="text" placeholder="Enter book ID" name="bookId"> <br> -->

            <h1 style="text-align: center; margin-bottom: 20px;">Add New Category</h1>

            <label for="categoryName">Category Name</label>
            <input type="text" placeholder="Enter category name" name="categoryName">
            <input type="submit" value="Submit" name="submitcategory">

            </form>
    </div>

</body>
</html>