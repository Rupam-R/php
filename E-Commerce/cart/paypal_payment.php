<?php
session_start();

// PayPal configuration
$paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';  // Use the sandbox URL for testing
$paypal_email = 'your_paypal_email@example.com';  // Your PayPal email address

// Get the total price from the form submission
$total_price = $_POST['total_price'];

// PayPal form data
echo "<form action='{$paypal_url}' method='POST' name='paypal_form'>
        <input type='hidden' name='cmd' value='_xclick'>
        <input type='hidden' name='business' value='{$paypal_email}'>
        <input type='hidden' name='item_name' value='E-Commerce Cart'>
        <input type='hidden' name='amount' value='{$total_price}'>
        <input type='hidden' name='currency_code' value='USD'>
        <input type='hidden' name='return' value='http://yourwebsite.com/order_success.php'>
        <input type='hidden' name='cancel_return' value='http://yourwebsite.com/cart/index.php'>
        <input type='submit' value='Pay with PayPal'>
      </form>";

// Automatically submit the PayPal form to redirect the user to PayPal
echo "<script>document.forms['paypal_form'].submit();</script>";
?>
