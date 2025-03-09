
<?php require "../config/config.php" ?>
<?php
include "../server/adminP/addProduct.php"
?>
<?php require "../include/header.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="http://localhost/project/Cafeteria_php/pages/css/myorder.css">
</head>
<body>

 
<form action="" method="POST" enctype="multipart/form-data">
<h2>Add Product</h2>
<div class="form-group">
    <label>Product :</label>
    <input type="text" name="product" required> 
    </div>
<div class="form-group">
    <label>Price</label>
    <input type="number" step="10.0" name="price" required></div>

    <div class="form-group"> 
    <label>Category</label>
    <select name="category" id="categorySelect">
        <?php
        foreach ($categories as $row) {
            echo '<option value="' . $row['category_id'] . '">' . $row['name'] . '</option>';
        }
        ?>
    </select>
    <a href="#" onclick="showCategoryField()">Add Category</a>
    

    <div id="newCategoryDiv" style="display: none;">
        <input type="text" name="new_category" id="newCategory" placeholder="Add Category">
        <button type="submit">Add</button>
    </div>

    </div>
    <div class="form-group">
    <label>Product Picture</label> 
    <input type="file" name="img" required>
     </div>
     <div class="form-btn"> 
    <button type="submit">Submit</button>
    <button type="reset"  >Reset</button>
      <div class="form-group"></div>  </div>
</form>

<script src="./js/addProduct.js"></script>

</body>
</html>
