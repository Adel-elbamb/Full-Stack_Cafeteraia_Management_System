<?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $room = $_POST['room'];
        $ext = $_POST['ext'];
        $image = $_FILES["img"];
        $encpassword = md5($password);

        if ($password !== $confirm_password) {
            header("location:addUser.php?message=Passwords do not match.");
            exit;
        }
        $namePattern = "/^[a-zA-Z ]{3,}$/";
        if (!preg_match($namePattern, $name)) {
            header("location:addUser.php?message=Name must contain only characters and be more than 3 characters.");
            exit;
        }
        $passwordPattern = "/^[0-9]{8,15}$/";
        if (!preg_match($passwordPattern, $password)) {
            header("location:addUser.php?message=Password must be between 8 and 15 characters.");
            exit;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("location:addUser.php?message=Invalid email format. Email must contain '@' and end with '.com'");
            exit;
        }
        $checkEmail = "SELECT * FROM users WHERE email = ?";
        $emailQuery = $conn->prepare($checkEmail);
        $emailQuery->execute([$email]);
        $result = $emailQuery->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            header("location:addUser.php?message=Email already exists");
            exit;
        }
        $validExtensions = ["jpeg", "jpg", "png"];
        $imgExtension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));

        if (!in_array($imgExtension, $validExtensions)) {
            header("location:addUser.php?message=Invalid file type. Only JPEG, JPG, and PNG allowed.");
            exit;
        }

        if (!is_dir("images")) {
            mkdir("images");
        }

        $newImage = time() . '.' . $imgExtension;
        $targetFilePath = "images/" . $newImage;

        if (!move_uploaded_file($image['tmp_name'], $targetFilePath)) {
            header("location:addUser.php?message=Failed to upload image.");
            exit;
        }
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, phone, user_img, role) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $email, $encpassword, $ext, $targetFilePath, "user"]);
    }
    ?>