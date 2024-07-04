<?php
session_start();

require_once 'connection.php';

// Redirect user to login page if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get user ID and username from session variables
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

// Retrieve cart information from database
$sql = "SELECT shopping_cart.cart_id, shopping_cart.book_id, shopping_cart.quantity, books.title, books.author, books.price FROM shopping_cart INNER JOIN books ON shopping_cart.book_id=books.book_id WHERE shopping_cart.user_id=$user_id";
$result = $conn->query($sql);

// Store cart information
$cart_items = array();
$total_price = 0;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cart_items[] = $row;
        $total_price += $row['price'] * $row['quantity'];
    }
}

// Check if a checkout request was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $shipping_address = $_POST['shipping_address'];
    $payment_method = $_POST['payment_method'];

    // Insert order into orders table
    $sql = "INSERT INTO orders (user_id, order_date, order_status, shipping_address) VALUES ($user_id, NOW(), 'pending', '$shipping_address')";
    if (!$conn->query($sql)) {
        $_SESSION['error'] = "Error placing order: " . $conn->error;
        header("Location: checkout.php");
        exit();
    }

    // Retrieve order ID 
    $order_id = $conn->insert_id;

    // Insert order items into order_items table
    foreach ($cart_items as $item) {
        $book_id = $item['book_id'];
        $quantity = $item['quantity'];
        $price = $item['price'];
        $sql = "INSERT INTO order_items (order_id, book_id, quantity, price) VALUES ($order_id, $book_id, $quantity, $price)";
        if (!$conn->query($sql)) {
            $_SESSION['error'] = "Error placing order: " . $conn->error;
            header("Location: checkout.php");
            exit();
        }
    }

    // Delete items from shopping_cart table
    $sql = "DELETE FROM shopping_cart WHERE user_id=$user_id";
    if (!$conn->query($sql)) {
        $_SESSION['error'] = "Error placing order: " . $conn->error;
        header("Location: checkout.php");
        exit();
    }

    // Redirect to order confirmation page
    header("Location: order_confirmation.php?order_id=$order_id");

    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

   <title>Checkout</title>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="container mt-5">

    <h1 class="mb-4" style="margin-top: 100px;">Checkout</h1>

        <?php if (empty($cart_items)): ?>
            <p>Your cart is empty.</p>
        <?php else: ?>
            <table class="table table-striped table-hover align-middle">
                <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Author</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart_items as $item): ?>
                        <tr>
                            <td><?php echo $item['title']; ?></td>
                            <td><?php echo $item['author']; ?></td>
                            <td>$<?php echo number_format($item['price'], 2); ?></td>
                            <td><?php echo $item['quantity']; ?></td>
                            <td>$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" align="right"><strong>Total Price:</strong></td>
                    </tr>
                    <tr>
                        <td colspan="5" align="right"><strong>Total Price:</strong></td>
                        <td>$<?php echo number_format($total_price, 2); ?></td>
                    </tr>
                </tfoot>
            </table>

            <form method="post">
                <div class="mb-3">
                    <label for="shipping_address" class="form-label">Shipping Address</label>
                    <textarea class="form-control" id="shipping_address" name="shipping_address" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="payment_method" class="form-label">Payment Method</label>
                    <select class="form-select" id="payment_method" name="payment_method" required>
                        <option value="">-- Select Payment Method --</option>
                        <option value="cash_on_delivery">Cash on Delivery</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Place Order</button>
            </form>
        <?php endif; ?>

        <!-- Display success message if set -->
        <?php if (!empty($_SESSION['success'])): ?>
            <div class="alert alert-success"><?php echo $_SESSION['success']; ?></div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <!-- Display error message if set -->
        <?php if (!empty($_SESSION['error'])): ?>
            <div class="alert alert-error"><?php echo $_SESSION['error']; ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>


</body>
</html>
