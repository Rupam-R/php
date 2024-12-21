<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce Shop</title>
    <link rel="stylesheet" href="../css/product-style.css">
</head>
<body>

    <?php
    // Include database connection file
    include '../includes/db.php'; 

    // Fetch products from the database
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);
    ?>

    <div class="container">
        <h1>Our Products</h1>

        <div class="product-grid">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="product">';
                    echo '<div class="product-image-container">'; 
                    echo '<img src="../images/' . $row['image'] . '" alt="' . $row['name'] . '" class="product-image">'; 
                    echo '</div>';
                    echo '<h3>' . $row['name'] . '</h3>';
                    echo '<p>' . $row['description'] . '</p>';
                    echo '<p>Price: $' . $row['price'] . '</p>';
                    echo '<a href="product_detail.php?id=' . $row['id'] . '" class="view-details">View Details</a>';
                    echo '</div>';
                }
            } else {
                echo "<p>No products found.</p>";
            }
            ?>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.5/gsap.min.js" defer></script> 
    <script src="../products/script-product.js" defer></script>

</body>
</html>