<?php
include 'db.php';
$query = "SELECT * FROM categories";
$sqlQuery = $connection->prepare($query);
$sqlQuery->execute();
$categories = $sqlQuery->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productName = $_POST['product'];
    $price       = $_POST['price'];
    $image       = $_FILES["img"];
    if (!empty($_POST['new_category'])) {
        $categoryName = $_POST['new_category'];
        $stmt = $connection->prepare("SELECT category_id FROM categories WHERE name = ?");
        $stmt->execute([$categoryName]);
        $existingCategory = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingCategory) {
            $category_id = $existingCategory['category_id'];
        } else {
            $stmt = $connection->prepare("INSERT INTO categories (name, created_at, updated_at) VALUES (?, NOW(), NOW())");
            $stmt->execute([$categoryName]);
            $category_id = $connection->lastInsertId();
        }
    } elseif(!empty($_POST['category'])) {
        $category_id = $_POST['category'];
        $stmt = $connection->prepare("SELECT name FROM categories WHERE category_id = ?");
        $stmt->execute([$category_id]);
        $category = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($category) {
            $categoryName = $category['name'];
        } else {
            echo "Category not found.";
            exit;
        }
    } else{
        echo "Should add Category";
        exit;
    }
    $validExtensions = ["jpeg", "jpg", "png"];
    $imgExtension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));

    if (!in_array($imgExtension, $validExtensions)) {
        echo"insert photo as a jpeg,jpg,png";
        exit;
    }
    if (!is_dir("images")) {
        mkdir("images");
    }
    $newImage = time() . '.' . $imgExtension;
    $targetFilePath = "images/" . $newImage;

    if (!move_uploaded_file($image['tmp_name'], $targetFilePath)) {
        echo "Failed";
        exit;
    }
    $stmt = $connection->prepare("INSERT INTO products (productName, price, product_img, category_id, product_description) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$productName, $price, $newImage, $category_id, $categoryName]);
    echo "<script>
            var select = document.getElementById('categorySelect');
            var newOption = document.createElement('option');
            newOption.value = '$category_id';
            newOption.textContent = '$categoryName';
            select.appendChild(newOption);
            select.value = '$category_id';
          </script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="style.css">
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
    <div class="form-group"></div>
</form>

<script src="script.js"></script>

</body>
</html>
