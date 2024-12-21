
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="cart.css">
</head>
<body>
    


<?php
// cart/add_to_cart.php
session_start();
include('../config.php');

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $productId = (int) $_GET['id']; // Ensure the product ID is an integer
    
    // Fetch product details
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$productId]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // If product is found
    if ($product) {
        // Prepare cart item
        $cartItem = [
            'id' => $product['id'],
            'name' => $product['name'],
            'price' => (float) $product['price'], // Ensure the price is a float
            'quantity' => 1
        ];
        
        // Check if the product is already in the cart
        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId]['quantity']++;
        } else {
            $_SESSION['cart'][$productId] = $cartItem;
        }
        
        // Optional: Set a message to show to the user after adding the product
        $_SESSION['message'] = "Product added to cart!";
    } else {
        // Optional: Set an error message if the product isn't found
        $_SESSION['message'] = "Product not found.";
    }
} else {
    // Optional: Set an error message if the 'id' parameter is invalid
    $_SESSION['message'] = "Invalid product ID.";
}

// Redirect back to the homepage (or wherever you want)
header('Location: ../index.php');
exit;
?>
</body>
</html>