<?php
// Start the session at the beginning of the file
session_start();
include('../includes/db.php');  // Include your DB connection
// include('../templates/header.php');  // Uncomment if using a header template

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="../css/cart-style.css">
</head>
<body>

    <?php
    // Check if the cart exists in the session
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        echo "<h2>Your Cart</h2>";
        echo "<table class='cart-table'>";
        echo "<tr>
                <th>Image</th>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th>Action</th>
            </tr>";

        $total_price = 0;
        foreach ($_SESSION['cart'] as $product_id => $product) {
            $total = $product['price'] * $product['quantity'];
            $total_price += $total;

            echo "<tr>
                    <td><img src='../images/{$product['image']}' alt='{$product['name']}' class='cart-image'></td>
                    <td>{$product['name']}</td>
                    <td>\${$product['price']}</td>
                    <td>
                        <form action='index.php' method='POST'>
                            <input type='number' name='quantity' value='{$product['quantity']}' min='1' class='quantity-input'>
                            <input type='hidden' name='product_id' value='{$product_id}'>
                            <button type='submit' class='update-btn'>Update</button>
                        </form>
                    </td>
                    <td>\${$total}</td>
                    <td><a href='index.php?action=remove&product_id={$product_id}' class='remove-btn'>Remove</a></td>
                </tr>";
        }

        echo "</table>";
        echo "<h3>Total: \${$total_price}</h3>";

        // Provide a checkout link
        echo "<a href='checkout.php' class='checkout-btn'>Proceed to Checkout</a>";
    } else {
        echo "<p>Your cart is empty. <a href='../index.php'>Continue shopping</a></p>";
    }

    // Handle quantity updates
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Sanitize and validate quantity input
        $product_id = isset($_POST['product_id']) ? (int) $_POST['product_id'] : 0;
        $quantity = isset($_POST['quantity']) && is_numeric($_POST['quantity']) && $_POST['quantity'] > 0 ? (int) $_POST['quantity'] : 1;

        // Update the product quantity in the cart if valid
        if ($product_id > 0 && isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['quantity'] = $quantity;
        }

        // Redirect to the same page to reflect changes
        header("Location: index.php");
        exit();
    }

    // Handle product removal from the cart
    if (isset($_GET['action']) && $_GET['action'] == 'remove' && isset($_GET['product_id'])) {
        $product_id = (int) $_GET['product_id'];
        // Validate product ID before removing from cart
        if (isset($_SESSION['cart'][$product_id])) {
            unset($_SESSION['cart'][$product_id]); // Remove the product from the cart
        }
        header("Location: index.php");
        exit();
    }
    ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.5/gsap.min.js"></script>
    <script>
        gsap.fromTo('.cart-table', { opacity: 0, y: 50 }, { opacity: 1, y: 0, duration: 0.8, ease: 'power2.out' });
    </script>

</body>
</html>
