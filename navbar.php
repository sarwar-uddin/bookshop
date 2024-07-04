<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php"><img src="logo.png" alt="Logo"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="books.php">Books</a>
        </li>
        <?php if(isset($_SESSION['user_id'])) { ?>
          <li class="nav-item">
            <a class="nav-link active" href="cart.php">Cart</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="order_status.php">Order Status</a>
          </li>
          <?php if($_SESSION['user_role'] == 'admin') { ?>
            <li class="nav-item">
              <a class="nav-link active" href="adminpanel.php">Admin Panel</a>
            </li>
          <?php } ?>
        <?php } ?>
      </ul>

      <form class="d-flex ms-auto" action="search.php" method="GET">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
        <button class="btn btn-outline-success me-2" type="submit">Search</button>
      </form>

      <?php if(isset($_SESSION['user_id'])) { ?>
        <div class="dropdown">
          <a class="btn btn-secondary dropdown-toggle ms-1 me-2" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo $_SESSION['username']; ?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
<!--            <li><a class="dropdown-item" href="#">Settings</a></li>  -->
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
          </ul>
        </div>
      <?php } else { ?>
        <div>
          <a class="btn btn-outline-primary me-1" href="login.php">Log In</a>
          <a class="btn btn-primary me-1" href="registration.php">Sign Up</a>
        </div>
      <?php } ?>
    </div>
  </div>
</nav>
