<?php
// start the session
session_start();

require_once 'connection.php';

// Retrieve search query from the URL parameter
$searchQuery = $_GET['query'];

// Retrieve product information
$sql = "SELECT book_id, title, author, price, stock, image_path FROM books WHERE title LIKE '%$searchQuery%'";
$result = $conn->query($sql);

// Store product information in an array
$products = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Search Results | Bookshop </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
        .card {
            height: 100%;
            width: 300px; /*custom width for each card */
            margin-bottom: 20px; /*spacing between the cards */
        }
        .card-img-top {
            height: 450px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <h2 class="text-center mb-3" style="margin-top: 100px;">Search Results for '<?php echo $searchQuery; ?>'</h2>
        <hr>
        <?php if (count($products) > 0) { ?>
            <div class="row row-cols-4 g-4">
                <?php foreach ($products as $product) { ?>
                    <div class="col mb-4">
                        <div class="card">
                            <a href="product.php?id=<?php echo $product['book_id']; ?>">
                                <img src="<?php echo $product['image_path']; ?>" class="card-img-top" alt="<?php echo $product['title']; ?>">
                            </a>
                            <div class="card-body">
                                <p class="card-title text-center"><a href="product.php?id=<?php echo $product['book_id']; ?>" style="text-decoration:none;"><strong><?php echo $product['title']; ?></strong></a></p>
                                <p class="card-text text-center"><strong><?php echo $product['author']; ?></strong></p>
                                <p class="card-text text-center">$<?php echo $product['price']; ?></p>
                                <p class="card-text text-center"><a href="product.php?id=<?php echo $product['book_id']; ?>" class="btn btn-primary">View Details</a></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } else { ?>
            <p class="text-center">No search results found.</p>
        <?php } ?>
	</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <?php include 'footer.php'; ?>
</body>
</html>
