<?php
session_start();
require_once('../includes/db_connection.php');

if(isset($_SESSION['admin_id'])) {
    header("Location: dashboard.php");
    exit();
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admins WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['admin_id'] = $result->fetch_assoc()['id'];
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid username or password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <header class="container">
        <h1>Welcome Admin</h1>
    </header>

    <div class="container">
        <form class="form-group" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" class="btn">Login</button>
        </form>
        <?php
        if(isset($error)) {
            echo "<p class='error'>$error</p>";
        }
        ?>
    </div>

    <footer>
        <div class="container">
            <p>&copy; 2024 E-commerce Website. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
