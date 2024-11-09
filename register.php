<?php
include 'db.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Encrypt password

    $stmt = $conn->prepare("INSERT INTO user (user_fname, user_lname, user_password, user_email) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $firstName, $lastName, $password, $email);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Registration succesdwdwdsful!"]);
    } else {
        echo json_encode(["fail" => false, "message" => "Registration failed. Try again."]);
    }

    $stmt->close();
    $conn->close();
}
?>
