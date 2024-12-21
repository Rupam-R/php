<?php
session_start();
include('../templates/header.php');

// Display the order confirmation message
echo "<h2>Thank you for your order!</h2>";
echo "<p>Your payment has been processed successfully. An email confirmation will be sent to you.</p>";
echo "<p>Order Summary:</p>";

if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    echo "<table>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>";

    $total_price = 0;
    foreach ($_SESSION['cart'] as $product_id => $product) {
        $total = $product['price'] * $product['quantity'];
        $total_price += $total;

        echo "<tr>
                <td>{$product['name']}</td>
                <td>\${$product['price']}</td>
                <td>{$product['quantity']}</td>
                <td>\${$total}</td>
              </tr>";
    }

    echo "</table>";
    echo "<h3>Total: \${$total_price}</h3>";
} else {
    echo "<p>Your cart is empty.</p>";
}

// Optionally, clear the cart after successful order
unset($_SESSION['cart']);

include('../templates/footer.php');
?>
