<?php
    require_once 'connection.php';
    
    // start the session
    session_start();
    
    if($_SESSION['user_role'] != 'admin') {
        header("Location: index.php");
    }
    
    // Update order status
    if(isset($_POST['update'])) {
        $orderId = $_POST['order_id'];
        $status = $_POST['status'];
        $sql = "UPDATE orders SET order_status='$status' WHERE order_id=$orderId";
        $conn->query($sql);
        header("Location: orders.php");
    }
    
    $sql = "SELECT o.order_id, u.username, o.shipping_address, o.order_date, o.order_status,
            GROUP_CONCAT(b.title SEPARATOR '<br>') AS book_titles,
            GROUP_CONCAT(oi.quantity SEPARATOR '<br>') AS book_quantities
            FROM orders o 
            JOIN users u ON o.user_id = u.user_id 
            JOIN order_items oi ON o.order_id = oi.order_id 
            JOIN books b ON oi.book_id = b.book_id 
            GROUP BY o.order_id
            ORDER BY o.order_date DESC";
    $result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Orders</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    </head>
    <body>
        <?php include 'navbar.php'; ?>
        <div class="container mt-4">
            <h2 class="text-center mb-3" style="margin-top: 100px;">Orders</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">User</th>
                        <th scope="col">Shipping Address</th>
                        <th scope="col">Book</th>
                        <th scope="col">QTY</th>
                        <th scope="col">Order Date</th>
                        <th scope="col">Status</th>
                        <th scope="col">Change Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <form method="POST">
                            <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
                            <td><?php echo $row['order_id']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['shipping_address']; ?></td>
                            <td><?php echo $row['book_titles']; ?></td>
                            <td><?php echo $row['book_quantities']; ?></td>
                            <td><?php echo date('F jS, Y g:iA', strtotime($row['order_date'])); ?></td>
                            <td><?php echo $row['order_status']; ?></td>
                            <td>
                                <select name="status" class="form-select" required>
                                    <option value="">Select Status</option>
                                    <option value="Processing">Processing</option>
                                    <option value="Shipped">Shipped</option>
                                    <option value="Delivered">Delivered</option>
                                </select>
                                <button type="submit" name="update" class="btn btn-primary mt-2">Update</button>
                            </td>
                        </form>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
    </body>
</html>
