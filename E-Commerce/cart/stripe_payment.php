<?php
session_start();
require_once('vendor/autoload.php');  // Include Stripe PHP library (via Composer)

\Stripe\Stripe::setApiKey('your_secret_key'); // Replace with your secret key

// Handle the payment request from checkout
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $token = $_POST['stripeToken']; // Stripe token from frontend

    // Create the charge
    try {
        $charge = \Stripe\Charge::create([
            'amount' => $_POST['amount'],
            'currency' => 'usd',
            'description' => 'E-Commerce Purchase',
            'source' => $token,
        ]);

        // If payment is successful
        if ($charge->status == 'succeeded') {
            echo "<h2>Payment Successful!</h2>";
            // Clear the cart after payment
            unset($_SESSION['cart']);
            // Redirect to a success page or order summary
            header('Location: order_success.php');
            exit();
        } else {
            echo "<p>Payment failed. Please try again.</p>";
        }
    } catch (\Stripe\Exception\CardException $e) {
        echo "<p>Error: " . $e->getError()->message . "</p>";
    }
} else {
    // Handle invalid access attempts
    echo "<p>Invalid access.</p>";
}
?>
