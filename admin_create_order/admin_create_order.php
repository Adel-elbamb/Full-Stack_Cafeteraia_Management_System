<?php
include 'admin_create_order_func.php';
$products = getProducts();
$rooms = getRooms();
$users = getUsers();
?>
<html>
<head>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="./admin_create_order.css">
    
</head>
<body>

        <!-- show products -->
        <section class="show-products">
            <section class="container">
                <section class="row">
                    <?php while ($row = $products->fetch_assoc()) { ?>
                        <div class="col-xl-3 col-md-6">
                            <div class="img-prod ">
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
                                <?php while ($row = $users->fetch_assoc()) { ?>
                                    <option value="<?= $row['user_id'] ?>"><?= $row['username'] ?></option>
                                <?php } ?>
                            </select>

                            <!-- select room -->
                            <select name="room_id" required>
                                <option value="">Select Room</option>
                                <?php while ($row = $rooms->fetch_assoc()) { ?>
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

                                    // createOrder(1, $total_price, $room_id, $note);

                                    createOrder($user_id, $total_price, $room_id, $note);
                                    echo "<h4>Order has been created for User ID: $user_id!</h4>";
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
                <img src="./imgs/burger.jfif" alt="" class="w-100 ">
                <img src="./imgs/cheesecake.jfif" alt="" class="w-100 ">
              </div>
              <div class="col-xl-4 col-md-4 col-sm-4">
                <img src="./imgs/coffee.jfif" alt="" class="w-100 ">
                <img src="./imgs/orangejuice.jfif" alt="" class="w-100 ">
              </div>
              <div class="col-xl-4 col-md-4 col-sm-4">
                <img src="./imgs/grilledchicken.jfif" alt="" class="w-100 ">
                <img src="./imgs/pizza.jfif" alt="" class="w-100 ">
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


<script src="./admin_create_order.js"></script>
</body>
</html>

