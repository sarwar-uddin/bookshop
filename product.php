<?php

// Start the session
session_start();

require_once 'connection.php';

// retrieve product information
$book_id = $_GET['id'];
$sql = "SELECT book_id, title, author, price, stock, image_path, description, publisher, publication_date, page_length, language, isbn FROM books WHERE book_id=$book_id";
$result = $conn->query($sql);

// store product information
$products = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php
        // Set the $book_name variable to the title of the first product in the $products array
        $book_name = $products[0]['title'];
    ?>
    <title><?php echo $book_name; ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    
    <?php include 'navbar.php'; ?>
        
</head>
<body>
    <div class="container" style="margin-top: 100px;">
        <?php foreach ($products as $product) { ?>
        <div class="row">
            <div class="col-md-4">
                <img src="<?php echo $product['image_path']; ?>" alt="<?php echo $product['title']; ?>" class="img-fluid">
            </div>
            <div class="col-md-8">
		<h2><?php echo $product['title']; ?></h2>
		<h3><?php echo $product['author']; ?></h3>
        <p><?php echo $product['description']; ?></p>
		
		<div class="col-md-8">
                    <div class="row">
                        <p><strong>Price:</strong> $<?php echo $product['price']; ?></p>
                    </div>
                    <div class="row">
                        <p><strong>Stock Availability:</strong> <?php echo $product['stock']; ?></p>
		    </div>

<div class="col-md-4">
        <form method="post" action="addtocart.php">
          <input type="hidden" name="book_id" value="<?php echo $product['book_id']; ?>">
          <div class="input-group">
            <input type="number" class="form-control" name="quantity" value="1" min="1">
            <button type="submit" class="btn btn-primary">Add to Cart</button>
          </div>
        </form>
      </div>
   		</div>
	    </div>
        </div>
	<?php } ?>

	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<hr>
               			<h3>Book Details</h3>
                		<p><strong>Publisher:</strong> <?php echo $product['publisher']; ?></p>
                		<p><strong>Publication Date:</strong> <?php echo $product['publication_date']; ?></p>
                		<p><strong>Page Length:</strong> <?php echo $product['page_length']; ?></p>
                		<p><strong>Language:</strong> <?php echo $product['language']; ?></p>
                        <p><strong>ISBN:</strong> <?php echo $product['isbn']; ?></p>
            </div>
		</div>
    </div>
<script>
// Check if session variable is set
if ('<?php if(isset($_SESSION['success'])) {echo "true";} ?>' == "true") {
    // Display success message in pop-up
    alert('<?php echo $_SESSION['success'];?>');

    // Unset session variable
    <?php unset($_SESSION['success']); ?>
}
</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>
