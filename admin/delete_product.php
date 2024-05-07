<?php
session_start();
if(!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}
// Handle deleting product
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Product</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <header class="container">
        <h1>Welcome to Our E-commerce Site</h1>
        <nav>
            <ul>
                <li><a href="#">Dashboard</a></li>
                <li><a href="#">Products</a></li>
                <li><a href="#">Orders</a></li>
                <li><a href="#">Logout</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <!-- Delete product confirmation -->
    </div>

    <footer>
        <div class="container">
            <p>&copy; 2024 E-commerce Website. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
