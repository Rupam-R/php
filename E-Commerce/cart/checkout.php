<?php
session_start();
include('../includes/db.php');
include('../templates/header.php');

// Check if the cart exists in the session
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    echo "<h2>Checkout</h2>";
    echo "<h3>Your Cart</h3>";
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

    // Stripe Payment
    echo "<form action='stripe_payment.php' method='POST'>
            <script src='https://checkout.stripe.com/checkout.js' class='stripe-button'
                data-key='your_publishable_key' 
                data-amount='" . ($total_price * 100) . "'
                data-name='E-Commerce Site'
                data-description='Checkout'
                data-image='https://yourwebsite.com/logo.png'
                data-currency='usd'>
            </script>
          </form>";

    // PayPal Payment Button
    echo "<form action='paypal_payment.php' method='POST'>
            <input type='hidden' name='total_price' value='{$total_price}'>
            <button type='submit' name='submit_paypal'>Pay with PayPal</button>
          </form>";

} else {
    echo "<p>Your cart is empty. Please add items to your cart first.</p>";
}

include('../templates/footer.php');
?>
