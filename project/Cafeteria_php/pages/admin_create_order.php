<?php require "../config/config.php" ?>

<?php
include '../server/adminP/admin_create_order.php';
$products = getProducts();
$rooms = getRooms();
$users = getUsers();
?>
<html>
<head>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Lobster+Two:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Heebo:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="./css/admin_create_order.css">
    
</head>
<body>

        <!-- start nav -->
  <!-- <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brand" href="#"><img src="../assets/imgs/logopop.png" alt=""></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <div class="dropdown">
                  <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                   Home
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Products</a></li>
                    <li><a class="dropdown-item" href="#">Users</a></li>
                    <li><a class="dropdown-item" href="#">Manual Order</a></li>
                    <li><a class="dropdown-item" href="#">Checks</a></li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <div class="dropdown">
                  <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                   Products
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Products</a></li>
                    <li><a class="dropdown-item" href="#">Users</a></li>
                    <li><a class="dropdown-item" href="#">Manual Order</a></li>
                    <li><a class="dropdown-item" href="#">Checks</a></li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <div class="dropdown">
                  <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                   Manual Orders
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="./people.html">Pupular drinks</a></li>
                    
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                
                <div class="dropdown">
                  <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Checks
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Products</a></li>
                    <li><a class="dropdown-item" href="#">Users</a></li>
                    <li><a class="dropdown-item" href="#">Manual Order</a></li>
                    <li><a class="dropdown-item" href="#">Checks</a></li>
                  </ul>
                </div>
                
              </li>
             
             
             
            </ul>
            <ul class="nav-icon">
                <li><a href=""><i class="fa-solid fa-plus"></i> </a></li>
                <li><button class="btn">EN</button></li>
                <li><a href=""><i class="fa-solid fa-bell"></i></a></li>
                <li><a href=""><i class="fa-solid fa-magnifying-glass lens"></i></a></li>
            </ul>
           
          </div>
        </div>
  </nav> -->

  <nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="../assets/imgs/logopop.png" alt="Logo" style="width: 100px; height: 60px;">
        </a>
        <a class="navbar-toggler" href="#">
            <span class="navbar-toggler-icon"></span>
        </a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="../pages/admin_create_order.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="../pages/allProducts.php">Products</a></li>
                <li class="nav-item"><a class="nav-link" href="../pages/allUser.php">Users</a></li>
                <li class="nav-item"><a class="nav-link" href="../pages/admin_orders.php">Manual Orders</a></li>
                <li class="nav-item"><a class="nav-link" href="../pages/check.php">Checks</a></li>
            </ul>
            <ul class="nav-icon">
                <li><a href="#"><i class="fa-solid fa-plus"></i></a></li>
                <li><a href="#" class="btn">EN</a></li>
                <li><a href="#"><i class="fa-solid fa-bell"></i></a></li>
                <li><a href="#"><i class="fa-solid fa-magnifying-glass lens"></i></a></li>
            </ul>
        </div>
    </div>
</nav> 
  <!-- end nav -->

        <!-- show products -->
          <!-- show products -->
    <section class="show-products ">
        <section class="container">
            <section class="row">
                <?php foreach ($products as $row) { ?>
                    <div class="col-xl-3 col-md-6">
                        <div class="img-prod">
                            <img class="w-100 h-75" src="<?= $row['product_img'] ?>" width="100" 
                                onclick="addToCart(<?= $row['product_id'] ?>, <?= $row['price'] ?>, '<?= addslashes($row['productName']) ?>')">
                        </div>
                        <div class="prod-details">
                            <div class="title-prod fs-4"><?= $row['productName'] ?></div>
                            <span class="price-prod"> $ <?= $row['price'] ?> </span>
                        </div>
                    </div>
                <?php } ?>
            </section>
        </section>
    </section>
<!-- end show products -->

<!-- start user-cart -->
<section class="user-cart mt-5">
    <section class="container text-center pt-3">
        <h3 class="mb-5 fs-2">Cart</h3>
        <section class="row">
            <div class="col-xl-6">
                <div id="cart"></div>
                <h3 class="">Total Price: <span id="total">0</span> $</h3>
            </div>
            <div class="col-xl-6 order-conf">
                <form method="POST">
                    <!-- select user -->
                    <select name="user_id" required>
                        <option value="">Select User</option>
                        <?php foreach ($users as $row) { ?>
                            <option value="<?= $row['user_id'] ?>"><?= $row['username'] ?></option>
                        <?php } ?>
                    </select>

                    <!-- select room -->
                    <select name="room_id" required>
                        <option value="">Select Room</option>
                        <?php foreach ($rooms as $row) { ?>
                            <option value="<?= $row['room_id'] ?>"><?= $row['room_id'] ?></option>
                        <?php } ?>
                    </select>
                    <input type="hidden" id="total_price_input" name="total_price">
                    <input type="text" name="note" placeholder="Notes">
                    <button type="submit" name="confirm_order">Confirm Order</button>
                </form>
            </div>

            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm_order'])) {
                $user_id = isset($_POST['user_id']) ? intval($_POST['user_id']) : 0;
                $total_price = isset($_POST['total_price']) ? floatval($_POST['total_price']) : 0;
                $room_id = isset($_POST['room_id']) ? intval($_POST['room_id']) : 0;
                $note = isset($_POST['note']) ? $_POST['note'] : '';

                if ($user_id > 0 && $total_price > 0 && $room_id > 0) {
                    createOrder($user_id, $total_price, $room_id, $note);
                    echo "<h4>Order created for User ID $user_id</h4>";
                } else {
                    echo "<h4>Please select a user, a room, and add items to the cart.</h4>";
                }
            }
            ?>
        </section>
    </section>
</section>
        <!-- end user-cart -->
    
   


<!-- footer -->
<footer>
      <div class="container">
        <div class="row pb-5 pt-5">
          <div class="col-xl-3 col-md-6">
           
            <ul>
              <li><h4>Get In Touch</h4></li>
              <li><i class="fa-solid fa-location-dot"></i> 123 Street, New York, USA</li>
              <li><i class="fa-solid fa-phone"></i> +012 345 67890</li>
              <li><i class="fa-regular fa-envelope"></i> info@example.com</li>
              <li><i class="fa-brands fa-facebook"></i>
                <i class="fa-brands fa-twitter"></i>
                <i class="fa-brands fa-youtube"></i>
                <i class="fa-brands fa-linkedin"></i></li>
            </ul>
          </div>
          <div class="col-xl-3 col-md-6">
            
            <ul>
              <li><h4>Quick Links</h4></li>
              <li><i class="fa-solid fa-chevron-right"></i> About Us</li>
              <li><i class="fa-solid fa-chevron-right"></i> Contact Us</li>
              <li><i class="fa-solid fa-chevron-right"></i> Our Services</li>
              <li><i class="fa-solid fa-chevron-right"></i> Privacy Policy</li>
              <li><i class="fa-solid fa-chevron-right"></i> Terms & Condition</li>
             
            </ul>
          </div>
          <div class="col-xl-3 col-md-6">
            <h4>Photo Gallery</h4>
            <div class="row">
              <div class="col-xl-4 col-md-4 col-lg-4">
                <img src="../assets/imgs/burger.jfif" alt="" class="w-100 ">
                <img src="../assets/imgs/cheesecake.jfif" alt="" class="w-100 ">
              </div>
              <div class="col-xl-4 col-md-4 col-sm-4">
                <img src="../assets/imgs/coffee.jfif" alt="" class="w-100 ">
                <img src="../assets/imgs/orangejuice.jfif" alt="" class="w-100 ">
              </div>
              <div class="col-xl-4 col-md-4 col-sm-4">
                <img src="../assets/imgs/grilledchicken.jfif" alt="" class="w-100 ">
                <img src="../assets/imgs/latte.jfif" alt="" class="w-100 ">
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6">
            <h4>Newsletter</h4>
            <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
            <div class="form-floating mb-3">
              <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
              <label for="floatingInput">Email address</label>
            </div>
          </div>
        </div>
        <hr>
        <p class="pb-4"> <span>© Cafetria</span>, All Right Reserved.</p>
      </div>

</footer>



       



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" 
integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" 
crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
crossorigin="anonymous"></script>


<script src="./js/admin_create_order.js"></script>
</body>
</html>

