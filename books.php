<?php
// start the session
session_start();

require_once 'connection.php';

//product information from the database
$sql = "SELECT book_id, title, author, price, stock, image_path, description FROM books";
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

    <title>Books</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
        .card {
            height: 100%;
            width: 300px;
            margin-bottom: 20px;
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
    <h2 class="text-center mb-3" style="margin-top: 100px;">All Books</h2>
    <hr class="border border-primary border-3 opacity-75">
    <div class="row row-cols-4 g-4">
        <?php
            $books_per_page = 16;
            $page = isset($_GET['page']) ? $_GET['page'] : 1;
            $start_index = ($page - 1) * $books_per_page;
            $end_index = $start_index + $books_per_page - 1;

            for ($i = $start_index; $i <= $end_index && $i < sizeof($products); $i++) {
                $product = $products[$i];
        ?>
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
</div>
    <!-- pagination -->
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <?php
                    $total_pages = ceil(sizeof($products) / $books_per_page);
                    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                    $start_page = max($current_page - 2, 1);
                    $end_page = min($current_page + 2, $total_pages);

                    if ($current_page > 1) {
                        echo '<li class="page-item"><a class="page-link" href="?page='.($current_page - 1).'">&laquo;</a></li>';
                    } else {
                        echo '<li class="page-item disabled"><a class="page-link" href="#">&laquo;</a></li>';
                    }

                    for ($i = $start_page; $i <= $end_page; $i++) {
                        if ($i == $current_page) {
                            echo '<li class="page-item active"><a class="page-link" href="#">'.$i.'</a></li>';
                        } else {
                            echo '<li class="page-item"><a class="page-link" href="?page='.$i.'">'.$i.'</a></li>';
                        }
                    }

                    if ($current_page < $total_pages) {
                        echo '<li class="page-item"><a class="page-link" href="?page='.($current_page + 1).'">&raquo;</a></li>';
                    } else {
                        echo '<li class="page-item disabled"><a class="page-link" href="#">&raquo;</a></li>';
                    }
                ?>
            </ul>
        </nav>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <?php include 'footer.php'; ?>
</body>
</html>

