<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $conn = mysqli_connect('localhost', 'root', '', 'bookshop');
     
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $address = $_POST['address'];
    
        $query = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $query);
    
        if (mysqli_num_rows($result) > 0) {
            echo "<p>Username already taken</p>";
        } else {
            $errors = [];
    
            if (empty($username)) { $errors[] = "Username is required"; }
            if (empty($email)) { $errors[] = "Email is required"; }
            if (empty($password)) { $errors[] = "Password is required"; }
    
            if ($password != $confirm_password) {
                $errors[] = "The two passwords do not match";
            }
    
            if (strlen($password) < 8) {
                $errors[] = "Password must be at least 8 characters long";
            }
            //hash the password using bcrypt and store user data in the database
            if (empty($errors)) {
                $hashed_password = password_hash($password, PASSWORD_BCRYPT);
                //insert user data into the database
                $query = "INSERT INTO users (username, email, password, first_name, last_name, address) VALUES ('$username', '$email', '$hashed_password', '$first_name', '$last_name', '$address')";
                $result = mysqli_query($conn, $query);
                // redirect to login.php
                $_SESSION['loggedin'] = true;
                header('location: login.php');
                exit();
            } else {
                // Display error messages
                foreach ($errors as $error) {
                    echo "<p>$error</p>";
                }
            }
        }
        //close connection
        mysqli_close($conn);
    }
    ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Registration</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    </head>
    <body>
        <?php include 'navbar.php'; ?>
        <div class="container mt-5">
            <h1 style="margin-top: 100px;">Registration</h1>
            <form method="post">
                <?php if(isset($errors)): ?>
                <div class="alert alert-danger">
                    <?php foreach($errors as $error): ?>
                    <p><?php echo $error ?></p>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label> <input type="text" class="form-control" id="username" name="username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : '' ?>" required="">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label> <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>" required="">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label> <input type="password" class="form-control" id="password" name="password" onkeyup="validatePassword()" required="">
                    <div id="password-error" class="invalid-feedback"></div>
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm Password</label> <input type="password" class="form-control" id="confirm_password" name="confirm_password" onkeyup="validateConfirmPassword()" required="">
                    <div id="confirm-password-error" class="invalid-feedback"></div>
                </div>
                <div class="mb-3">
                    <label for="first_name" class="form-label">First Name (Optional)</label> <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo isset($_POST['first_name']) ? $_POST['first_name'] : '' ?>">
                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label">Last Name (Optional)</label> <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo isset($_POST['last_name']) ? $_POST['last_name'] : '' ?>">
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address (Optional)</label> 
                    <textarea class="form-control" id="address" rows="3" name="address"><?php echo isset($_POST['address']) ? $_POST['address'] : '' ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
                <p class="mt-3">Already Registered? <a href="registration.php">Login!</a></p>
            </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script> 
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script> 
        <script>
            function validatePassword() {
            var passwordInput = document.getElementById('password');
            var passwordLength = passwordInput.value.length;
            var errorElement = document.getElementById('password-error');
            
            if (passwordLength < 8) {
              errorElement.innerHTML = 'Password must be at least 8 characters long';
              passwordInput.classList.add('is-invalid'); // Add bootstrap invalid class
            } else {
              errorElement.innerHTML = '';
              passwordInput.classList.remove('is-invalid');
            }
            }
        </script> 
        <script>
            function validateConfirmPassword() {
            var passwordInput = document.getElementById('password');
            var confirmPasswordInput = document.getElementById('confirm_password');
            var errorElement = document.getElementById('confirm-password-error');
            
            if (passwordInput.value != confirmPasswordInput.value) {
              errorElement.innerHTML = 'Passwords do not match';
              passwordInput.classList.add('is-invalid'); // Add bootstrap invalid class
              confirmPasswordInput.classList.add('is-invalid');
            } else {
              errorElement.innerHTML = '';
              passwordInput.classList.remove('is-invalid');
              confirmPasswordInput.classList.remove('is-invalid');
            }
            }
        </script>
    </body>
</html>
