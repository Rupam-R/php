<?php
// product_detail.php - Display product details and add to cart

session_start();
include('../includes/db.php');
// include('../templates/header.php');

// Get the product ID from the URL and ensure it's an integer to prevent invalid input
$product_id = isset($_GET['id']) && is_numeric($_GET['id']) ? (int) $_GET['id'] : 0;

// Fetch product details from the database using prepared statements to prevent SQL injection
if ($product_id > 0) {
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    $stmt->close();
} else {
    echo "Invalid product ID.";
    exit;
}

// If the product is not found, display an error
if (!$product) {
    echo "Product not found.";
    exit;
}

// Handle the form submission to add the product to the cart
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate and sanitize the quantity
    $quantity = isset($_POST['quantity']) && is_numeric($_POST['quantity']) && $_POST['quantity'] > 0 ? (int) $_POST['quantity'] : 1;
    $product_id = (int) $_POST['product_id'];

    // If the cart does not exist, create one
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // If the product is already in the cart, update its quantity
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity'] += $quantity;
    } else {
        // Otherwise, add the product to the cart
        $_SESSION['cart'][$product_id] = array(
            'name' => $product['name'],
            'price' => $product['price'],
            'quantity' => $quantity,
            'image' => $product['image']
        );
    }

    echo "<p>Product added to cart! <a href='../cart/index.php'>View Cart</a></p>";
}

?>

<h2><?php echo htmlspecialchars($product['name']); ?></h2>
<img src="../images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
<p><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
<p>Price: $<?php echo number_format($product['price'], 2); ?></p>

<!-- Add to Cart Form -->
<form action="product_detail.php?id=<?php echo $product_id; ?>" method="POST">
    <label for="quantity">Quantity:</label>
    <input type="number" id="quantity" name="quantity" value="1" min="1" required>
    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
    <button type="submit">Add to Cart</button>
</form>

<!-- <?php include('../templates/footer.php'); ?> -->
