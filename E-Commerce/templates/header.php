<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce Website</title>
    <link rel="stylesheet" href="css/styleheader.css">
    <style>
        /* Basic styles */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

/* Header styles */
header {
    background-color: #333;
    color: white;
    padding: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    animation: fadeIn 2s ease-in;
}

/* Logo styles with animation */
.logo {
    font-size: 2rem;
    font-weight: bold;
    letter-spacing: 2px;
    color: #ff7f50;
    animation: slideInFromLeft 1.5s ease-out;
}

/* Navigation styles */
nav ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
}

nav ul li {
    margin-right: 20px;
}

.nav-link {
    color: white;
    text-decoration: none;
    font-size: 1.1rem;
    font-weight: 500;
    position: relative;
    display: inline-block;
    transition: color 0.3s ease;
}

/* Hover effect on nav links */
.nav-link:hover {
    color: #ff7f50;
}

/* Animation for nav links */
.nav-link::after {
    content: '';
    position: absolute;
    bottom: -5px;
    left: 0;
    width: 100%;
    height: 2px;
    background-color: #ff7f50;
    transform: scaleX(0);
    transform-origin: bottom right;
    transition: transform 0.3s ease;
}

.nav-link:hover::after {
    transform: scaleX(1);
    transform-origin: bottom left;
}

/* Keyframe animations */
@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

@keyframes slideInFromLeft {
    from {
        transform: translateX(-100%);
    }
    to {
        transform: translateX(0);
    }
}

    </style>
</head>
<body>
    <header>
        <div class="logo">E-Shop</div>
        <nav>
            <ul>
                <li><a href="index.php" class="nav-link">Home</a></li>
                <li><a href="products/index.php" class="nav-link">Shop</a></li>
                <li><a href="cart/index.php" class="nav-link">Cart</a></li>
                <li><a href="auth/login.php" class="nav-link">Login</a></li>
            </ul>
        </nav>
    </header>
</body>
</html>
