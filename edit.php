<?php
    // start the session
    session_start();
    
    // connect to the database
    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "bookshop";
    
    // Create connection
    $mysqli = new mysqli($host, $user, $password, $dbname);
    
    // Check for connection to database
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get form data
        $book_id = $_POST['book_id'];
        $title = $_POST['title'];
        $author = $_POST['author'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $description = $_POST['description'];
        $publisher = $_POST['publisher'];
        $publication_date = $_POST['publication_date'];
        $page_length = $_POST['page_length'];
        $language = $_POST['language'];
        $isbn = $_POST['isbn'];
    
        //update statement
        $sql = "UPDATE books SET title='$title', author='$author', price=$price, stock=$stock, description='$description', publisher='$publisher', publication_date='$publication_date', page_length=$page_length, language='$language', isbn='$isbn' WHERE book_id=$book_id";
    
        // Execute statement
        if ($mysqli->query($sql) === TRUE) {
              //success message 
//            $_SESSION['success'] = "Book updated successfully.";
    
            // Close connection
            $mysqli->close();
    
            // Redirect back to catalog 
            header("Location: allbooks.php");
            exit;
        } else {
            echo "Error updating book: " . $mysqli->error;
        }

    } else {
        // Retrieve product information from database
        $book_id = $_GET['id'];
        $sql = "SELECT book_id, title, author, price, stock, image_path, description, publisher, publication_date, page_length, language, isbn FROM books WHERE book_id=$book_id";
        $result = $mysqli->query($sql);
    
        // Store product information in an array
        $products = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
        }
    
        $mysqli->close();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Edit Book Information</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <?php include 'navbar.php'; ?>
    </head>
    <body>
        <div class="container">
            <h2 style="margin-top: 100px;" >Edit Book Information</h2>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="book_id" value="<?php echo $book_id; ?>">
                <div class="form-group mb-2">
                    <label>Title:</label>
                    <input type="text" class="form-control" name="title" value="<?php echo $products[0]['title']; ?>">
                </div>
                <div class="form-group mb-2">
                    <label>Author:</label>
                    <input type="text" class="form-control" name="author" value="<?php echo $products[0]['author']; ?>">
                </div>
                <div class="form-group mb-2">
                    <label>Price:</label>
                    <input type="text" class="form-control" name="price" value="<?php echo $products[0]['price']; ?>">
                </div>
                <div class="form-group mb-2">
                    <label>Stock:</label>
                    <input type="number" class="form-control" name="stock" value="<?php echo $products[0]['stock']; ?>">
                </div>
                <div class="form-group mb-2">
                    <label>Description:</label>
                    <textarea class="form-control" name="description"><?php echo $products[0]['description']; ?></textarea>
                </div>
                <div class="form-group mb-2">
                    <label>Publisher:</label>
                    <input type="text" class="form-control" name="publisher" value="<?php echo $products[0]['publisher']; ?>">
                </div>
                <div class="form-group mb-2">
                    <label>Publication Date:</label>
                    <input type="date" class="form-control" name="publication_date" value="<?php echo $products[0]['publication_date']; ?>">
                </div>
                <div class="form-group mb-2">
                    <label>Page Length:</label>
                    <input type="text" class="form-control" name="page_length" value="<?php echo $products[0]['page_length']; ?>">
                </div>
                <div class="form-group mb-2">
                    <label>Language:</label>
                    <input type="text" class="form-control" name="language" value="<?php echo $products[0]['language']; ?>">
                </div>
                <div class="form-group mb-2">
                    <label>ISBN:</label>
                    <input type="text" class="form-control" name="isbn" value="<?php echo $products[0]['isbn']; ?>">
                </div>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
    </body>
</html>
