<?php
    session_start();

    require 'connection.php';

    if($_SESSION['user_role'] != 'admin') {
        header("Location: index.php");
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Add Book</title>
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    
        <?php include 'navbar.php'; ?>

    </head>
    <body>
        <?php
             include 'navbar.php';

            // initialize variables
            $title = $author = $price = $stock = $image_path = $description = $publisher = $publication_date = $page_length = $language = $isbn = "";
            
            // check if form is submitted
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // retrieve form data
              $title = $_POST["title"];
              $author = $_POST["author"];
              $price = $_POST["price"];
              $stock = $_POST["stock"];
              $image_path = $_POST["image_path"];
              $description = $_POST["description"];
              $publisher = $_POST["publisher"];
              $publication_date = $_POST["publication_date"];
              $page_length = $_POST["page_length"];
              $language = $_POST["language"];
              $isbn = $_POST["isbn"];

              // prepare the query
              $query = "INSERT INTO books (title, author, price, stock, image_path, description, publisher, publication_date, page_length, language, isbn) VALUES ('$title', '$author', $price, $stock, '$image_path', '$description', '$publisher', '$publication_date', $page_length, '$language', '$isbn')";

              // execute the query
              if ($conn->query($query) === TRUE) {
                echo '<div class="alert alert-success" role="alert">New book added successfully</div>';
              } else {
                echo '<div class="alert alert-danger" role="alert">Error: ' . $sql . "<br>" . $conn->error . '</div>';
              }
            
              // close connection
              $conn->close();
            }
?>

        <div class="container mt-5">
            <h2 class="mb-4" style="margin-top: 100px;">Add Book</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="row mb-3">
                    <label for="title" class="col-sm-2 col-form-label">Title:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="title" name="title">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="author" class="col-sm-2 col-form-label">Author:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="author" name="author">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="price" class="col-sm-2 col-form-label">Price:</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="price" name="price" step=".01" min="0">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="stock" class="col-sm-2 col-form-label">Stock:</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="stock" name="stock" min="0">
                    </div>
		        </div>

		
                <div class="row mb-3">
                    <label for="image_path" class="col-sm-2 col-form-label">Image Path:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="image_path" name="image_path">
                    </div>
		        </div>


                <div class="row mb-3">
                    <label for="description" class="col-sm-2 col-form-label">Description:</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="publisher" class="col-sm-2 col-form-label">Publisher:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="publisher" name="publisher">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="publication_date" class="col-sm-2 col-form-label">Publication Date:</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="publication_date" name="publication_date">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="page_length" class="col-sm-2 col-form-label">Page Length:</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="page_length" name="page_length" min="0">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="language" class="col-sm-2 col-form-label">Language:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="language" name="language">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="isbn" class="col-sm-2 col-form-label">ISBN:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="isbn" name="isbn">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-12 text-center">
                        <button type="submit" class="btn btn-primary">Add Book</button>
                    </div>
                </div>
            </form>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script> 

    </body>
<html>
