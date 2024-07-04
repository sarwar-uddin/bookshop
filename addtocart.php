<?php
session_start();

require 'connection.php';

// Check if the required form fields are set
if (!isset($_POST['book_id'], $_POST['quantity'])) {
    $_SESSION['error'] = "Invalid request.";
    header('Location: product.php?id='.$_POST['book_id']);
    exit();
}

// Retrieve book information from database
$book_id = $_POST['book_id'];
$sql = "SELECT book_id, title, author, price, stock FROM books WHERE book_id=$book_id";
$result = $conn->query($sql);

// Store book information in a variable
if ($result->num_rows > 0) {
    $book = $result->fetch_assoc();
} else {
    // Redirect to product page with error message if book is not found
    $_SESSION['error'] = "Book not found.";
    header('Location: product.php?id='.$book_id);
    exit();
}

// Get user ID and username from session variables
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$username = isset($_SESSION['username']) ? $_SESSION['username'] : null;

if (!$user_id) {
    // If user is not logged in redirect to login page 
    header("Location: login.php");

}

// Check if the book already exists in the cart for this user
$sql = "SELECT * FROM shopping_cart WHERE user_id=$user_id AND book_id=$book_id";
$result = $conn->query($sql);

// If the book is already in the cart, update the quantity
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $cart_id = $row['cart_id'];
    $quantity = $row['quantity'] + $_POST['quantity'];

    // Check if the requested quantity exceeds the stock
    if ($quantity > $book['stock']) {
        // Redirect to product page with error message if stock is insufficient
        $_SESSION['error'] = "Insufficient stock.";
        header('Location: product.php?id='.$book_id);
        exit();
    }

    $sql = "UPDATE shopping_cart SET quantity=$quantity, date_added=NOW() WHERE cart_id=$cart_id";
    $conn->query($sql);

    //success message
    $_SESSION['success'] = "Item added to cart.";

    // Redirect to product page
    header('Location: product.php?id='.$book_id);
} else {
    // insert a new record
    $quantity = $_POST['quantity'];

    // Check if the quantity exceeds the stock
    if ($quantity > $book['stock']) {
        // if stock is insufficient redirect
        $_SESSION['error'] = "Insufficient stock.";
        header('Location: product.php?id='.$book_id);
        exit();
    }

    $sql = "INSERT INTO shopping_cart (user_id, username, book_id, quantity, date_added) VALUES ($user_id, '$username', $book_id, $quantity, NOW())";
    $conn->query($sql);

    // Success message
    $_SESSION['success'] = "Item added to cart.";

    // Redirect to product page
    header('Location: product.php?id='.$book_id);
}

$conn->close();
