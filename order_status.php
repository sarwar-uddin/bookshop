<?php
// start the session
session_start();

// check if user is logged in
if(!isset($_SESSION['user_id'])){
    header('Location: login.php');
}

require_once 'connection.php';

// retrieve orders for the current user with details, sorted by order date in descending order
$user_id = $_SESSION['user_id'];
$sql = "SELECT o.order_id, b.title, oi.quantity, oi.price, o.shipping_address, o.order_date, o.order_status 
        FROM orders o 
        JOIN order_items oi ON o.order_id = oi.order_id 
        JOIN books b ON oi.book_id = b.book_id 
        WHERE o.user_id = $user_id 
        ORDER BY o.order_date DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Status</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
    <h2 class="text-center mb-3" style="margin-top: 100px;">Order Status</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Books Ordered</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Shipping Address</th>
                    <th>Order Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['order_id']; ?></td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td><?php echo $row['shipping_address']; ?></td>
                    <td><?php echo $row['order_date']; ?></td>
                    <td><?php echo $row['order_status']; ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>
</html>

