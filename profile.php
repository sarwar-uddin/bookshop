<?php
// start the session
session_start();

// Check if the user is logged in
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php"); 
    exit();
}

// database connection
require_once 'connection.php';

// Get user information from the database
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE user_id = $user_id";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container my-6">
        <h1 class="text-center" style="margin-top: 100px">User Profile</h1>
        <hr>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>Username:</th>
                    <td><?php echo $user['username']; ?></td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td><?php echo $user['email']; ?></td>
                </tr>
                <tr>
                    <th>First Name:</th>
                    <td><?php echo $user['first_name']; ?></td>
                </tr>
                <tr>
                    <th>Last Name:</th>
                    <td><?php echo $user['last_name']; ?></td>
                </tr>
                <tr>
                    <th>Address:</th>
                    <td><?php echo $user['address']; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>
