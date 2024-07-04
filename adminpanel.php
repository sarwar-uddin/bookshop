<?php
    // Start the session
    session_start();
    
    // Check if the user is logged in and has admin privileges
    if(!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
        // Redirect the user to the login page
        header('Location: login.php');
        exit();
    }
    
    // Include the database connection file
    require_once 'connection.php';
    ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Admin Panel</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    </head>
    <body>
        <?php include 'navbar.php'; ?>
        <main>
            <div class="container">
                <h1 class="text-center mb-3" style="margin-top: 100px;">Welcome to the Admin Panel</h1>
            </div>
            <div class="container">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Page</th>
                            <th>Purpose</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Add Books</td>
                            <td>Add new books to the database.</td>
                            <td><a href="addbooks.php" class="btn btn-primary">Go to Page</a></td>
                        </tr>
                        <tr>
                            <td>Products</td>
                            <td>Manage all books in the database</td>
                            <td><a href="allbooks.php" class="btn btn-primary">Go to Page</a></td>
                        </tr>
                        <tr>
                            <td>Orders</td>
                            <td>View and manage orders placed by customers.</td>
                            <td><a href="orders.php" class="btn btn-primary">Go to Page</a></td>
                        </tr>
                        <tr>
                            <td>Users</td>
                            <td>List and Manage Users</td>
                            <td><a href="users.php" class="btn btn-primary">Go to Page</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
    </body>
</html>

