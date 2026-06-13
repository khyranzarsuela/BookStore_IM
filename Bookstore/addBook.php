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
    margin: 0;
    font-family: Arial, sans-serif;
    background-color: var(--background);
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
    background: var(--card);
    color: var(--text);
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
    background: var(--primary);
    color: #ffffff;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.form-card input[type="submit"]:hover{
      box-shadow: 0 2px 4px rgba(0, 0, 0, 1);
            background: var(--hover);
             transition: all 0.3s ease;
}
    </style>
</head>
<body>
    <div class="form-wrapper">
         <form class="form-card" action="add.php" method="post">
            <!-- <label for="bookId">BookId</label>
            <input type="text" placeholder="Enter book ID" name="bookId"> <br> -->

            <h1 style="text-align: center; margin-bottom: 20px; color: var(--text);">Add New Book</h1>

            <label for="ISBN">ISBN</label>
            <input type="text" placeholder="Enter book ISBN" name="ISBN">

            <label for="bookTitle">Title</label>
            <input type="text" placeholder="Enter book Title" name="bookTitle">

            <label for="Author">Author</label>
            <select name="author" id="author">
                <?php while($author = mysqli_fetch_assoc($sqlAuthors)) { ?>
                    <option value="<?php echo $author['author_id']; ?>"><?php echo $author['author_name']; ?></option>
                <?php } ?>
            </select>

            <label for="Category">Category</label>
            <select name="category" id="category">
                <?php while($category = mysqli_fetch_assoc($sqlCategories)) { ?>
                    <option value="<?php echo $category['category_id']; ?>"><?php echo $category['category_name']; ?></option>
                <?php } ?>
            </select> 

            <label for="Price">Price</label>
            <input type="text" placeholder="Enter Price" name="price">

            <label for="Quantity">Quantity</label>
            <input type="text" placeholder="Enter book quantity" name="stockQuantity">

            <input type="submit" value="Submit" name="submit">

            </form>
    </div>

</body>
</html>