<?php require "../include/header.php" ?>
<?php require "../config/config.php" ?>
<?php
session_start();

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["loginBtn"])) {
    $userEmail = trim($_POST["useremail"] ?? '');
    $userPassword = $_POST["userpassword"] ?? '';

    if (empty($userEmail)) {
        $errors['email'] = "Email is required.";
    }

    if (empty($userPassword)) {
        $errors['password'] = "Password is required.";
    }

    if (empty($errors)) {
        $query = "SELECT * FROM users WHERE email = :userEmail";
        $statement = $conn->prepare($query);
        $statement->execute([':userEmail' => $userEmail]);
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$user || !password_verify($userPassword, $user['password'])) {
            $errors['general'] = "Invalid email or password.";
        }
    }

    if (empty($errors)) {
        $_SESSION["user_id"] = $user['id'];
        $_SESSION["username"] = $user['username'];
        $_SESSION["role"] = $user['role']; 
        
    if (isset($_SESSION["role"])) {
    $role = $_SESSION["role"];
    
    if ($role === 'admin') {
        header("Location: /server/admin/home.php");
        echo "Welcome, Admin! You can see all the content here.";
    } else {
        echo "Welcome, User! You can only see limited content.";
    }
        }   
        header("Location: /cheacks_adel_project/pages/home.php"); 
        exit();
        }

    $_SESSION["errors"] = $errors;
    $_SESSION["old_data"] = $_POST;
    header("Location: /auth/login.php");
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
                    <h2>Login</h2>
                    <p>Welcome to the official Anime blog.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Normal Breadcrumb End -->

<!-- Login Section Begin -->
<section class="login spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="login__form">
                    <h3>Login</h3>
                    <form action="login.php" method="POST">
                        <div class="input__item">
                            <input id="useremail" name="useremail" type="email" placeholder="Email address" value="<?= htmlspecialchars($oldData['useremail'] ?? '') ?>">
                            <span class="icon_mail"></span>
                            <small style="color: red;"><?= $errors['email'] ?? '' ?></small>
                        </div>

                        <div class="input__item">
                            <input id="userpassword" name="userpassword" type="password" placeholder="Password">
                            <span class="icon_lock"></span>
                            <small style="color: red;"><?= $errors['password'] ?? '' ?></small>
                        </div>

                        <button name="loginBtn" type="submit" class="site-btn">Login Now</button>
                        <small style="color: red;"><?= $errors['general'] ?? '' ?></small>
                    </form>
                    <a href="#" class="forget_pass">Forgot Your Password?</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="login__register">
                    <h3>Don’t Have An Account?</h3>
                    <a href="signup.php" class="primary-btn">Register Now</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Login Section End -->

<?php require "../include/footer.php" ?>