<?php
// process_order.php
session_start();
include('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['cart'])) {
    // Get user info
    $name = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];

    // Insert order into database (you can add more order details as needed)
    $stmt = $pdo->prepare("INSERT INTO orders (name, address, email) VALUES (?, ?, ?)");
    $stmt->execute([$name, $address, $email]);

    // Get the last inserted order ID
    $orderId = $pdo->lastInsertId();

    // Insert products into the order_items table
    foreach ($_SESSION['cart'] as $item) {
        $stmt = $pdo->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
        $stmt->execute([$orderId, $item['id'], $item['quantity'], $item['price']]);
    }

    // Clear the cart
    unset($_SESSION['cart']);

    // Redirect to order confirmation page
    header('Location: order_confirmation.php');
    exit;
}
?>
