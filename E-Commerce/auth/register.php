<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="reg.css">
</head>
<body>
    



<?php
include('../includes/db.php');
// include('../templates/header.php');

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the input values
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Password Hashing for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if user already exists
    $sql = "SELECT * FROM users WHERE username = ? OR email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User already exists
        echo "<p style='color:red;'>Username or email already exists. Please choose a different one.</p>";
    } else {
        // Insert new user into the database
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $email, $hashed_password);
        
        if ($stmt->execute()) {
            echo "<p style='color:green;'>Registration successful! <a href='../auth/login.php'>Login here</a></p>";
        } else {
            echo "<p style='color:red;'>Error: Could not register the user. Please try again.</p>";
        }
    }

    // Close the statement
    $stmt->close();
}

?>

<!-- Registration Form -->
<h2>Register Yourself</h2>
<form action="register.php" method="POST" class = "form-container">
    <div class="input-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
    </div>
    <div class="input-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div class="input-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
    </div>
    <button type="submit">Register</button>
</form>

<!-- <?php include('../templates/footer.php'); ?> -->
</body>
</html>