<?php
// login.php
session_start();
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "foodfusion";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check login attempts
    $attempts_sql = "SELECT attempts, last_attempt FROM login_attempts WHERE username = ?";
    $attempts_stmt = $conn->prepare($attempts_sql);
    $attempts_stmt->bind_param("s", $username);
    $attempts_stmt->execute();
    $attempts_stmt->store_result();
    $attempts_stmt->bind_result($attempts, $last_attempt);
    $attempts_stmt->fetch();

    if ($attempts >= 3) {
        $time_diff = time() - strtotime($last_attempt);
        if ($time_diff < 180) { // Lockout for 3 minutes
            echo "You are temporarily locked out. Please try again later.";
            exit;
        } else {
            // Reset attempts after 3 minutes
            $reset_sql = "DELETE FROM login_attempts WHERE username = ?";
            $reset_stmt = $conn->prepare($reset_sql);
            $reset_stmt->bind_param("s", $username);
            $reset_stmt->execute();
        }
    }

    // Validate user credentials
    $sql = "SELECT password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($hashed_password);
    $stmt->fetch();

    if ($stmt->num_rows > 0 && password_verify($password, $hashed_password)) {
        // Successful login
        $_SESSION['username'] = $username;
        echo "Login successful!";
    } else {
        // Increment login attempts
        if ($attempts_stmt->num_rows > 0) {
            $update_sql = "UPDATE login_attempts SET attempts = attempts + 1, last_attempt = NOW() WHERE username = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("s", $username);
            $update_stmt->execute();
        } else {
            $insert_sql = "INSERT INTO login_attempts (username, attempts, last_attempt) VALUES (?, 1, NOW())";
            $insert_stmt = $conn->prepare($insert_sql);
            $insert_stmt->bind_param("s", $username);
            $insert_stmt->execute();
        }
        echo "Invalid username or password.";
    }

    $stmt->close();
}

$conn->close();
?>

