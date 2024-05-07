<?php
session_start();
require_once('../includes/db_connection.php');

if(isset($_SESSION['user_id'])) {
    header("Location: profile.php");
    exit();
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['user_id'] = $result->fetch_assoc()['id'];
        header("Location: profile.php");
        exit();
    } else {
        $error = "Invalid email or password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <header class="container">
        <h1>Welcome User</h1>
    </header>

    <div class="container">
        <form class="form-group" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
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
