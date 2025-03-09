<?php
include '../config/config.php';


?>



<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <title>My Orders</title>
    <link rel="stylesheet" href="./css/almyorder.css?v=<?php echo time(); ?>">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Lobster+Two:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Heebo:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg ">
        <div class="container">
          <a class="navbar-brand" href="#"><img src="../assets/imgs/logopop.png" alt=""></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <div class="dropdown">
                <a href="./home.php" class="btn " style="border:none"  >
                  Home
                  </a>
                  <!-- <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Products</a></li>
                    <li><a class="dropdown-item" href="#">Users</a></li>
                    <li><a class="dropdown-item" href="#">Manual Order</a></li>
                    <li><a class="dropdown-item" href="#">Checks</a></li>
                  </ul> -->
                </div>
              </li>
              <li class="nav-item">
                <div class="dropdown">
                  <a href="./myorder.php" class="btn " style="border:none"  >
                   My Order
                  </a>
                  <!-- <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Products</a></li>
                    <li><a class="dropdown-item" href="#">Users</a></li>
                    <li><a class="dropdown-item" href="#">Manual Order</a></li>
                    <li><a class="dropdown-item" href="#">Checks</a></li>
                  </ul> -->
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
  </nav>

  <div class="cont">
    
  <h2 id="title-page">My Orders</h2>
    <form id="filterForm" class="filter_data" action="../server/admin/Filter_data.php">
        <label>From: <input type="date" id="start_date" name="start_date"></label>
        <label>To: <input type="date" id="end_date" name="end_date"></label>
        <button type="submit">Filter</button>
    </form>

    <section class="container-section">
        <table>
            <thead>
                <tr>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Amount</th>
                    <th>Price</th>
                    <th>Total Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="orders_table">
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td class="order-details" data-order-id="<?= $order['order_id'] ?>" style="cursor: pointer;">
                            <?= $order['created_at'] ?>
                        </td>
                        <td><?= $order['status'] ?></td>
                        <td>
                            <form method="POST" action="../server/admin/Amount.php">
                                <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
                                <button type="submit" name="change_amount" value="-1"  >-</button>
                                <?= (int)$order['amount'] ?>
                                <button type="submit" name="change_amount" value="1">+</button>
                            </form>
                        </td>
                        <td><?= $order['unit_price'] ?></td>
                        <td><?= $order['total_price'] ?></td>
                        <td>
                            <?php if ($order['status'] == 'pending'): ?>
                                <form method="POST" action="../server/admin/cancel_order.php">
                                    <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
                                    <button type="submit">Cancel</button>
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

            <tfoot>
                <tr id="orderDetailsRow" style="display: none;">
                    <td colspan="6">
                        <div id="orderDetails"></div>
                    </td>
                </tr>
            </tfoot>

        </table>
    </section>

  </div>
     <?php   require "../include/footer.php" ?>
  

</body>
<script src="./js/myorder.js?v=<?php echo time(); ?>"></script>

</html>