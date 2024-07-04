<?php
    // start the session
    session_start();

    if($_SESSION['user_role'] != 'admin') {
        header("Location: index.php");
    }



?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>All Books</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

  <!-- Custom CSS -->
  <style>
    .btn-edit {
      font-size: 14px;
      padding: 6px 12px;
    }

    .btn-delete {
      font-size: 14px;
      padding: 6px 12px;
    }
  </style>
</head>
<body>
    <?php include 'navbar.php'; ?>


  <div class="container">
        <h2 class="text-center mb-3" style="margin-top: 100px;">All Books</h2>
        <hr>
<?php
      //database connection
      require_once 'connection.php';

      // Check if the form has been submitted for deleting a book
      if(isset($_POST['delete_book_id'])) {
        $book_id = $_POST['delete_book_id'];
        $query = "DELETE FROM books WHERE book_id='$book_id'";
        $result = mysqli_query($conn, $query);
        if(!$result) {
          die('Error deleting book');
        }
        echo '<div class="alert alert-success">Book deleted successfully!</div>';
      }

      // Fetch all books from the database
      $query = "SELECT * FROM books";
      $result = mysqli_query($conn, $query);

      // Check if there are any books in the database
      if (mysqli_num_rows($result) > 0) {
        echo '<table class="table table-bordered">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Book Title</th>';
        echo '<th>ISBN</th>';
        echo '<th>Publisher</th>';
        echo '<th>Price</th>';
        echo '<th>QTY</th>';
        echo '<th>Image Path</th>';
        echo '<th>Action</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        // Loop through all the books to  display them in a table
        while ($row = mysqli_fetch_assoc($result)) {
          echo '<tr>';
          echo '<td>' . $row['title'] . '</td>';
          echo '<td>' . $row['isbn'] . '</td>';
          echo '<td>' . $row['publisher'] . '</td>';
          echo '<td>$' . $row['price'] . '</td>';
          echo '<td>' . $row['stock'] . '</td>';
          echo '<td>' . $row['image_path'] . '</td>';
          echo '<td>
                  <div class="btn-group" role="group">
                    <a href="edit.php?id=' . $row['book_id'] . '" class="btn btn-primary btn-edit">Edit Book</a>
                    <form method="post" onsubmit="return confirm(\'Are you sure you want to delete this book?\')">
                      <input type="hidden" name="delete_book_id" value="' . $row['book_id'] . '">
                      <button type="submit" class="btn btn-danger btn-delete">Delete Book</button>
                    </form>
                  </div>
                </td>';
          echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
      } else {
        echo '<p class="lead">No books found.</p>';
      }
    ?>

  </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>

</body>
</html>

