<?php
$query = "SELECT * FROM categories";
$sqlQuery = $conn->prepare($query);
$sqlQuery->execute();
$categories = $sqlQuery->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productName = $_POST['product'];
    $price       = $_POST['price'];
    $image       = $_FILES["img"];
    if (!empty($_POST['new_category'])) {
        $categoryName = $_POST['new_category'];
        $stmt = $conn->prepare("SELECT category_id FROM categories WHERE name = ?");
        $stmt->execute([$categoryName]);
        $existingCategory = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingCategory) {
            $category_id = $existingCategory['category_id'];
        } else {
            $stmt = $conn->prepare("INSERT INTO categories (name, created_at, updated_at) VALUES (?, NOW(), NOW())");
            $stmt->execute([$categoryName]);
            $category_id = $conn->lastInsertId();
        }
    } elseif(!empty($_POST['category'])) {
        $category_id = $_POST['category'];
        $stmt = $conn->prepare("SELECT name FROM categories WHERE category_id = ?");
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
    $stmt = $conn->prepare("INSERT INTO products (productName, price, product_img, category_id, product_description) VALUES (?, ?, ?, ?, ?)");
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