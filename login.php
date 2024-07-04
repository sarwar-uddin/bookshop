<?php
// start the session
session_start();

require 'connection.php';

// check if the user is already logged in
if(isset($_SESSION['user_id'])) {
  // redirect to home page if the user is already logged in
  header('Location: index.php');
}

// initialize errors array
$errors = [];

// handle form submission
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  // get the username and password from the form data
  $username = $_POST['username'];
  $password = $_POST['password'];

  // query the database to find a matching username and password hash
  $query = "SELECT * FROM users WHERE username='$username'";
  $result = mysqli_query($conn, $query);

  if(mysqli_num_rows($result) > 0) { // if user exists
    $user_data = mysqli_fetch_assoc($result);
    $stored_password_hash = $user_data['password'];
    $user_role = $user_data['user_role']; // get the user role from the database

    // verify the password hash using the PHP password_verify() function
    if(password_verify($password, $stored_password_hash)) {
      // set session variables and redirect to home page
      $_SESSION['user_id'] = $user_data['user_id'];
      $_SESSION['username'] = $user_data['username'];
      $_SESSION['user_role'] = $user_role; // set the user role in the session
      header('Location: index.php');
      exit();
    } else {
      // add error message to array
      $errors[] = "Invalid username or password";
    }
  } else {
    // add error message to array
    $errors[] = "Invalid username or password";
  }

  // close the database connection
  mysqli_close($conn);
}
?>


<!DOCTYPE html>
<html>
  <head>
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
  
  <body>
    <?php include 'navbar.php'; ?>

    <div class="container mt-5">
      <h1 style="margin-top: 100px;">Login</h1>
      <form method="POST">
        <?php if(count($errors) > 0): ?>
          <div class="alert alert-danger">
            <?php foreach($errors as $error): ?>
              <p><?php echo $error ?></p>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>

        <div class="mb-3">
          <label for="username" class="form-label">Username:</label>
          <input type="text" class="form-control" id="username" name="username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : '' ?>" required>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password:</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <button type="submit" class="btn btn-primary">Login</button>
        <p class="mt-3">Not a member? <a href="registration.php">Register Now!</a></p>

      </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
  </body>
</html>

