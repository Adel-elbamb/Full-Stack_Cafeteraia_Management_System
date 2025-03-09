<?php require "../config/config.php" ?>
<?php include "../server/adminP/addUser.php" ?>
<?php require "../include/header.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link rel="stylesheet" href="./css/addUser.css?v=<?php echo time(); ?>">
    <!-- <link rel="stylesheet" href="./css/addUser.css"> -->
</head>

<body>
    <?php
    // include 'db.php';
    if (isset($_GET["message"])) {
        echo "<p class='alert alert-danger w-75 m-auto text-center'>" . $_GET["message"] . "</p>";
    }
    ?>
    
    <form action="#" method="post" enctype="multipart/form-data" id="form">
        <h2>Add User</h2>

        <div class="form-row">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="room">Room:</label>
                <input type="text" id="room" name="room" required>
            </div>

            <div class="form-group">
                <label for="ext">Ext:</label>
                <input type="text" id="ext" name="ext" required>
            </div>
        </div>

        <div class="form-group file-input">
            <label for="img">Profile Picture:</label>
            <input type="file" id="img" name="img" required>
        </div>

        <div class="button-group">
            <button type="submit">Submit</button>
            <button type="reset">Reset</button>
        </div>
    </form>
   

    <?php require "../include/footer.php" ?>