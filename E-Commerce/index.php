<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/styleIndex.css">
</head>
<body>

<?php
// index.php - Home page with product showcase
include('includes/db.php');
include('loadingScreen/loadingscreen.html');

// Check for a successful database connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch products from the database
$sql = "SELECT * FROM products LIMIT 4";
$result = $conn->query($sql);
?>

<h2>Featured Products</h2><br>
<div class="product-grid">
    <?php
    // Check if products exist
    if ($result->num_rows > 0) {
        // Loop through each product
        while ($row = $result->fetch_assoc()) {
            $image = htmlspecialchars($row['image']);
            $name = htmlspecialchars($row['name']);
            $description = htmlspecialchars($row['description']);
            $price = htmlspecialchars($row['price']);
            $id = $row['id'];

            // Display the product
            echo "<div class='product'>
                    <img src='images/{$image}' alt='{$name}'>
                    <h3>{$name}</h3>
                    <p>{$description}</p>
                    <p>\${$price}</p>
                    <a href='products/product_detail.php?id={$id}'>View Details</a>
                  </div>";
        }
    } else {
        echo "No products found.";
    }
    ?>
</div>

<?php
// include('templates/footer.php');
?>

<!-- Include GSAP CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.1/gsap.min.js"></script>

<!-- Include your custom script.js -->
<script src="script.js" defer></script>

</body>
</html>
