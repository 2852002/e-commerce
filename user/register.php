<?php
session_start();
require_once('../includes/db_connection.php');

// Function to generate random token
function generateToken($length = 32) {
    return bin2hex(random_bytes($length));
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $pincode = $_POST['pincode'];
    $password = $_POST['password'];

    // Validate inputs
    if(empty($name) || empty($email) || empty($phone) || empty($address) || empty($pincode) || empty($password)) {
        $error = "All fields are required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format";
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $error = "Only letters and white space allowed for name";
    } elseif (!preg_match("/^[0-9]{10}$/", $phone)) {
        $error = "Phone number must be 10 digits";
    } else {
        // Check if the email already exists
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $error = "Email already exists";
        } else {
            // Generate verification token
            $verification_token = generateToken();

            // Insert user into database with verification token
            $sql = "INSERT INTO users (name, email, phone, address, pincode, password, verification_token) 
                    VALUES ('$name', '$email', '$phone', '$address', '$pincode', '$password', '$verification_token')";
            if ($conn->query($sql) === TRUE) {
                // Send verification email with login credentials
                $to = $email;
                $subject = "Welcome to Our E-commerce Site";
                $message = "Dear $name,\r\nThank you for registering with our website. Below are your login credentials:\r\n";
                $message .= "Email: $email\r\n";
                $message .= "Password: $password\r\n";
                $message .= "Please click the following link to verify your email address and complete your registration:\r\n";
                $message .= "http://yourdomain.com/user/verify.php?email=$email&token=$verification_token\r\n";
                $headers = "From: admin@yourdomain.com";
                mail($to, $subject, $message, $headers);

                $_SESSION['registered'] = true;
                header("Location: login.php");
                exit();
            } else {
                $error = "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <header class="container">
        <h1>Welcome to Our E-commerce Site</h1>
    </header>

    <div class="container">
        <form class="form-group" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="phone">Phone Number:</label>
            <input type="text" id="phone" name="phone" required>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>

            <label for="pincode">Pincode:</label>
            <input type="text" id="pincode" name="pincode" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" class="btn">Register</button>
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
