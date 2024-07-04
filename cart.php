<?php
    session_start();
    
    require_once 'connection.php';
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Check if a delete request was submitted
        if (isset($_POST['delete_item'])) {
            $cart_id = $_POST['delete_item'];
            $sql = "DELETE FROM shopping_cart WHERE cart_id = $cart_id";
            if ($conn->query($sql) === TRUE) {
                $_SESSION['success'] = "Item removed from cart successfully.";
            } else {
                $_SESSION['error'] = "Error removing item from cart: " . $conn->error;
            }
        }
    }
    
    // Get user ID and username from session variables
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : null;
    
    if (!$user_id) {
        // If user is not logged in, redirect to login page 
        header("Location: login.php");
    
    }
    
    //cart information from the database
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
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <title>Shopping Cart</title>
    </head>
    <body>
        <?php include 'navbar.php'; ?>
        <div class="container mt-5">
            <h1 class="mb-4" style="margin-top: 100px;">Shopping Cart</h1>
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
                        <th scope="col">Action</th>
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
                        <td>
                            <form method="post">
                                <input type="hidden" name="delete_item" value="<?php echo $item['cart_id']; ?>">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" align="right"><strong>Total Price:</strong></td>
                        <td>$<?php echo number_format($total_price, 2); ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="6" class="text-end">
                            <a href="checkout.php" class="btn btn-primary">Checkout</a>
                        </td>
                    </tr>
                </tfoot>
            </table>
            <?php endif; ?>
            <!-- Display success message -->
            <?php if (!empty($_SESSION['success'])): ?>
            <div class="alert alert-success"><?php echo $_SESSION['success']; ?></div>
            <?php unset($_SESSION['success']); ?>
            <?php endif; ?>
            <!-- Display error message -->
            <?php if (!empty($_SESSION['error'])): ?>
            <div class="alert alert-error"><?php echo $_SESSION['error']; ?></div>
            <?php unset($_SESSION['error']); ?>
            <?php endif; ?>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
        <?php include 'footer.php'; ?>
    </body>
</html>
