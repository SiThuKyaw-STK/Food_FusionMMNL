<?php
session_start();
include 'db.php';

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit;
}

$userId = $_SESSION['user']['id'];
$recipeName = $_POST['recipe_name'];
$description = $_POST['description'];
$level = $_POST['level'];
$categoryIds = isset($_POST['category']) ? (is_array($_POST['category']) ? $_POST['category'] : [$_POST['category']]) : [];

// Debug: Print incoming ingredients and directions data
file_put_contents("debug_log.txt", "Ingredients: " . $_POST['ingredients'] . "\nDirections: " . $_POST['directions'] . "\n", FILE_APPEND);

// Decode JSON strings if needed
$ingredients = $_POST['ingredients'];
$directions = $_POST['directions'];

// Check if upload directory exists; create it if it doesn't
$uploadDir = 'uploads/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Start transaction to handle multiple table inserts safely
$conn->begin_transaction();

try {
    // Insert recipe data
    $stmt = $conn->prepare("INSERT INTO recipes (user_id, recipe_name, recipe_description, level, created_at) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("issi", $userId, $recipeName, $description, $level);
    $stmt->execute();
    $recipeId = $stmt->insert_id;
    $stmt->close();

    // Insert category associations
    $stmt = $conn->prepare("INSERT INTO recipes_category (recipe_id, category_id) VALUES (?, ?)");
    foreach ($categoryIds as $categoryId) {
        $stmt->bind_param("ii", $recipeId, $categoryId);
        $stmt->execute();
    }

    // Insert each ingredient as a separate row
    $stmt = $conn->prepare("INSERT INTO recipes_content (recipe_id, type, content) VALUES (?, 1, ?)");
    $stmt->bind_param("is", $recipeId, $ingredients);
    $stmt->execute();
    $stmt->close();

    // Insert each direction as a separate row
    $stmt = $conn->prepare("INSERT INTO recipes_content (recipe_id, type, content) VALUES (?, 2, ?)");
    $stmt->bind_param("is", $recipeId, $directions);
    $stmt->execute();
    $stmt->close();

    // Handle image uploads (multiple files) and associate with recipe_id
    if (isset($_FILES['images']) && count($_FILES['images']['name']) > 0) {
        $imageCount = count($_FILES['images']['name']);
        
        // Loop through each uploaded image
        for ($i = 0; $i < $imageCount; $i++) {
            if ($_FILES['images']['error'][$i] === 0) {
                // Generate a unique random filename
                $fileExtension = pathinfo($_FILES['images']['name'][$i], PATHINFO_EXTENSION);
                $randomFilename = uniqid(rand(), true) . '.' . $fileExtension;
                $imagePath = $uploadDir . $randomFilename;

                // Validate image type and size (optional)
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                $fileType = $_FILES['images']['type'][$i];
                $fileSize = $_FILES['images']['size'][$i];
                $maxSize = 5 * 1024 * 1024; // Max size 5MB
                
                if (in_array($fileType, $allowedTypes) && $fileSize <= $maxSize) {
                    // Move the uploaded file to the uploads directory
                    if (move_uploaded_file($_FILES['images']['tmp_name'][$i], $imagePath)) {
                        // Insert image path into media table with recipe_id
                        $stmt = $conn->prepare("INSERT INTO recipes_media (recipe_id, type, content) VALUES (?, 1, ?)");
                        $stmt->bind_param("is", $recipeId, $imagePath);
                        $stmt->execute();
                    } else {
                        throw new Exception("Error moving uploaded file.");
                    }
                } else {
                    throw new Exception("Invalid file type or size.");
                }
            }
        }
    }

    // Commit transaction
    $conn->commit();
    echo json_encode(['success' => 'Recipe created successfully']);
} catch (Exception $e) {
    // Rollback transaction on error
    $conn->rollback();
    echo json_encode(['error' => 'Error creating recipe: ' . $e->getMessage()]);
}
?>
