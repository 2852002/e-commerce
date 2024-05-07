<?php
// Include database connection
require_once('includes/db_connection.php');

// Fetch products from the database
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header class="container">
        <h1>Welcome to Our E-commerce Site</h1>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Products</a></li>
                <li><a href="#">Cart</a></li>
                <li><a href="#">Orders</a></li>
                <li><a href="#">Login</a></li>
                <li><a href="#">Register</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <h2>Products</h2>
        <div class="product-list">
            <?php
            // Check if there are any products
            if ($result->num_rows > 0) {
                // Loop through each product and generate HTML
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='product-card'>";
                    echo "<img src='images/{$row['image']}' alt='Product Image'>";
                    echo "<h2>{$row['name']}</h2>";
                    echo "<p>{$row['description']}</p>";
                    echo "<span>Price: {$row['price']}</span>";
                    echo "<button>Edit</button>";
                    echo "<button>Delete</button>";
                    echo "</div>";
                }
            } else {
                // No products found
                echo "No products available.";
            }
            ?>

        </div>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>
==========================================================================