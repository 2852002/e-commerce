<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | E-commerce Website</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
</head>
<body>
    <header class="container">
        <h1>Welcome to Our E-commerce Site</h1>
        <nav>
            <ul class="menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="orders.php">Orders</a></li>
                <li><a href="admin/login.php">Admin Login</a></li>
                <li><a href="user/login.php">User Login</a></li>
                <li><a href="user/register.php">Register</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <h2>Featured Products</h2>
        <div class="featured-products">
            <div class="product">
                <img src="images/product1.jpg" alt="Product 1">
                <h3>Product Name</h3>
                <p>Description of the product goes here.</p>
                <span>$19.99</span>
                <button class="btn">Add to Cart</button>
            </div>

            <div class="product">
                <img src="images/product2.jpg" alt="Product 2">
                <h3>Product Name</h3>
                <p>Description of the product goes here.</p>
                <span>$29.99</span>
                <button class="btn">Add to Cart</button>
            </div>

            <div class="product">
                <img src="images/product3.jpg" alt="Product 3">
                <h3>Product Name</h3>
                <p>Description of the product goes here.</p>
                <span>$39.99</span>
                <button class="btn">Add to Cart</button>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <p>&copy; 2024 E-commerce Website. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        <?php
        // Check if registered or logged in successfully
        if (isset($_SESSION['registered']) && $_SESSION['registered']) {
            echo "toastr.success('Registered successfully!');";
            unset($_SESSION['registered']);
        }
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
            echo "toastr.success('Logged in successfully!');";
            unset($_SESSION['logged_in']);
        }
        ?>
    </script>
</body>
</html>
