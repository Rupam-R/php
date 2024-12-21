<?php
// cart/cart.php
session_start();
// include('../includes/header.php');

if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
    echo '<table>';
    echo '<tr><th>Product</th><th>Price</th><th>Quantity</th><th>Total</th></tr>';

    $total = 0;
    foreach ($_SESSION['cart'] as $item) {
        $subtotal = $item['price'] * $item['quantity'];
        $total += $subtotal;
        echo "<tr>
                <td>{$item['name']}</td>
                <td>\${$item['price']}</td>
                <td>{$item['quantity']}</td>
                <td>\${$subtotal}</td>
              </tr>";
    }

    echo "<tr><td colspan='3'>Total</td><td>\${$total}</td></tr>";
    echo '</table>';
    echo '<a href="checkout.php">Proceed to Checkout</a>';
} else {
    echo 'Your cart is empty!';
}

// include('../includes/footer.php');
?>
