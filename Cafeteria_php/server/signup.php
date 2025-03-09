<?php require "../include/header.php" ?>
<?php require "../config/config.php" ?>
<?php
session_start();

$errors = []; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["registerBtn"])) {
    $userName = trim($_POST["username"] ?? '');
    $userPassword = $_POST["userpassword"] ?? '';
    $confirmPassword = $_POST["confirmpassword"] ?? '';
    $userEmail = trim($_POST["useremail"] ?? '');
    $userPhone = trim($_POST["userphone"] ?? ''); 
    $userImg = $_FILES["userimg"] ?? null;
    $roomNum = $_POST["roomnum"] ?? null;

    // ✅ Data validation
    if (empty($userName)) {
        $errors['username'] = "Username is required.";
    }

    if (empty($userPassword) || empty($confirmPassword)) {
        $errors['password'] = "Password is required.";
    } elseif ($userPassword !== $confirmPassword) {
        $errors['password'] = "Passwords do not match.";
    }

    if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    }

    if (!preg_match('/^01[0-9]{9}$/', $userPhone)) {
        $errors['phone'] = "Phone number must be 11 digits and start with 01.";
    }




    // Check if the email already exists
    if (empty($errors)) {
        $query = "SELECT COUNT(*) FROM users WHERE email = :userEmail";
        $statement = $conn->prepare($query);
        $statement->execute([':userEmail' => $userEmail]);
        $emailCount = $statement->fetchColumn();

        if ($emailCount > 0) {
            $errors['email'] = "Email is already registered.";
        }
    }




    if ($userImg && $userImg['error'] === UPLOAD_ERR_OK) {

        $imagePath = "uploads/" . basename($userImg["name"]);
        move_uploaded_file($userImg["tmp_name"], $imagePath);
    } else {
        $imagePath = "uploads/default.jpg"; 
    }

    // If no errors, proceed with registration
    if (empty($errors)) {
        $hashedPassword = password_hash($userPassword, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (username, password, email, phone,user_img) 
                  VALUES (:userName, :userPassword, :userEmail, :userPhone,:userImg)";
        $statement = $conn->prepare($query);
        $success = $statement->execute([
            ':userName' => $userName,
            ':userPassword' => $hashedPassword,
            ':userEmail' => $userEmail,
            ':userPhone' => $userPhone,
            ':userImg' => $imagePath
        ]);

        if ($success) {
            $_SESSION["success"] = "Account created successfully!";
            header("location:./login.php");
            exit();
        } else {
            $errors['general'] = "An error happen during registration. Please try again.";
        }
    }

    $_SESSION["errors"] = $errors;
    $_SESSION["old_data"] = $_POST;
    header("location:./signup.php");
    exit();
}
?>



<?php $errors = $_SESSION["errors"] ?? []; ?>
<?php $oldData = $_SESSION["old_data"] ?? []; ?>
<?php unset($_SESSION["errors"], $_SESSION["old_data"]); ?>

<!-- Normal Breadcrumb Begin -->
<section class="normal-breadcrumb set-bg" data-setbg="<?php echo APPURL;?>/img/normal-breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="normal__breadcrumb__text">
                    <h2>Sign Up</h2>
                    <p>Welcome to the official Anime blog.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Normal Breadcrumb End -->

<!-- Signup Section Begin -->
<section class="signup spad">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="login__form">
                    <h3>Sign Up</h3>
                    <form action="signup.php" method="POST" enctype="multipart/form-data">
                        <div class="input__item">
                            <input id="username" name="username" type="text" placeholder="Your Name" value="<?= htmlspecialchars($oldData['username'] ?? '') ?>">
                            <span class="icon_profile"></span>
                            <small style="color: red;"><?= $errors['username'] ?? '' ?></small>
                        </div>

                        <div class="input__item">
                            <input id="useremail" name="useremail" type="email" placeholder="Email address" value="<?= htmlspecialchars($oldData['useremail'] ?? '') ?>">
                            <span class="icon_mail"></span>
                            <small style="color: red;"><?= $errors['email'] ?? '' ?></small>
                        </div>

                        <div class="input__item">
                            <input id="userphone" name="userphone" type="text" placeholder="Phone" 
                            value="<?= htmlspecialchars($oldData['userphone'] ?? '') ?>">
                            <span class="icon_phone"></span>
                            <small style="color: red;"><?= $errors['phone'] ?? '' ?></small>
                        </div> 

                        <div class="input__item">
                            <input id="roomnum" name="roomnum" type="number" min=0 placeholder="Room" value="<?= htmlspecialchars($oldData['roomnum'] ?? '') ?>">
                            <span class="icon_lock"></span>
                            <small style="color: red;"><?= $errors['roomnum'] ?? '' ?></small>
                        </div>                            

                        <div class="input__item">
                            <input id="userpassword" name="userpassword" type="password" placeholder="Password">
                            <span class="icon_lock"></span>
                            <small style="color: red;"><?= $errors['password'] ?? '' ?></small>
                        </div> 

                        <div class="input__item">
                            <input id="confirmpassword" name="confirmpassword" type="password" placeholder="Confirm Password">
                            <span class="icon_lock"></span>
                            <small style="color: red;"><?= $errors['password'] ?? '' ?></small>
                        </div>                              

                        <div ><!-- class="input__item" --> 
                            <input id="profile_image" name="userimg" type="file" accept="image/*">
                            <!-- <span class="icon/span> -->
                            <small style="color: red;"><?= $errors['userimg'] ?? '' ?></small>
                        </div>  

                        <button name="registerBtn" type="submit" class="site-btn">Register</button>
                    </form>
                    <h5>Already have an account? <a href="login.php">Log In!</a></h5>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Signup Section End -->

<?php require "../include/footer.php" ?>

