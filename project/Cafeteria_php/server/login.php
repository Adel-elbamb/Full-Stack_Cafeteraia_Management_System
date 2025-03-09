

<?php require "../config/config.php" ?>
<?php



session_start(); $errors = [];

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

    $errors = $_SESSION["errors"] ?? [];
     $oldData = $_SESSION["old_data"] ?? []; 
     unset($_SESSION["errors"], $_SESSION["old_data"]);

    if (empty($errors)) {
        // $_SESSION["user_id"] = $user['id'];
        $_SESSION["user_id"] = $user['user_id'];
        $_SESSION["username"] = $user['username'];
        $_SESSION["role"] = $user['role']; 
        
    if (isset($_SESSION["role"])) {
    $role = $_SESSION["role"];
    
    if ($role === 'admin') {
        header("Location:/project/Cafeteria_php/pages/admin_create_order.php");
        echo "Welcome, Admin! You can see all the content here.";
    } else {
        echo "Welcome, User! You can only see limited content.";
        header("Location:/project/Cafeteria_php/pages/home.php");
    }
        }   
        // header("Location: /cheacks_adel_project/pages/home.php"); 
        exit();
        }

    $_SESSION["errors"] = $errors;
    $_SESSION["old_data"] = $_POST;
    header("Location:/project/Cafeteria_php/server/login.php");
    exit();
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
  /* Coffee-Themed Login Card */
body {
    background-color: #f4e9dc; /* Light coffee background */
    font-family: 'Poppins', sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.container {
    width: 600px;
    background-color: #fff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    text-align: center;
}

h3 {
    color: #5d4037;
    font-weight: bold;
    margin-bottom: 20px;
}

.input__item {
    position: relative;
    margin-bottom: 15px;
}

.input__item input {
    width: 100%;
    padding: 12px;
    border: 2px solid #d7ccc8;
    border-radius: 8px;
    font-size: 16px;
    outline: none;
    transition: 0.3s;
}

.input__item input:focus {
    border-color: #8d6e63;
    box-shadow: 0 0 5px rgba(141, 110, 99, 0.5);
}

.site-btn {
   
    background-color: #5d4037 ;
    color: white;
    padding: 12px;
    width: 100%;
    border: none;
    border-radius: 8px;
    font-size: 18px;
    cursor: pointer;
    transition: background 0.3s;
}

.site-btn:hover {
    background-color: #998065;
}

.forget_pass {
    display: block;
    margin-top: 10px;
    color: #795548;
    text-decoration: none;
    font-size: 14px;
}

.forget_pass:hover {
    text-decoration: underline;
}

.login__register {
    margin-top: 20px;
    padding: 15px;
    border-top: 1px solid #d7ccc8;
}

.primary-btn {
    display: inline-block;
    background-color: #8d6e63;
    color: white;
    padding: 10px 20px;
    border-radius: 8px;
    text-decoration: none;
    font-size: 16px;
}

.primary-btn:hover {
    background-color: #795548;
}



    </style>
</head>
<body>
<!-- <section class="normal-breadcrumb set-bg" data-setbg="/img/normal-breadcrumb.jpg">
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
</section> -->
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

</body>
</html>


<!-- Normal Breadcrumb Begin -->

