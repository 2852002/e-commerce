<?php

// Function to establish a database connection
function db_connect() {
    $host = "localhost"; // Change this to your database host
    $username = "root"; // Change this to your database username
    $password = ""; // Change this to your database password
    $database = "project"; // Change this to your database name

    $conn = mysqli_connect($host, $username, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    return $conn;
}

// Function to sanitize input data
function sanitize_input($data) {
    $conn = db_connect();
    $data = mysqli_real_escape_string($conn, trim($data));
    mysqli_close($conn);
    return $data;
}

// Function to validate email format
function validate_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Function to validate phone number format
function validate_phone($phone) {
    return preg_match("/^\d{10}$/", $phone);
}

// Function to validate name format
function validate_name($name) {
    return preg_match("/^[a-zA-Z ]*$/", $name);
}

// Function to hash passwords
function hash_password($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

// Function to verify password
function verify_password($password, $hashed_password) {
    return password_verify($password, $hashed_password);
}

// Function to generate a random token
function generate_token($length = 32) {
    return bin2hex(random_bytes($length));
}

?>
