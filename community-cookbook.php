<?php
include 'db_connect.php'; // Include database connection

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = 1; // Replace with actual logged-in user ID
    $title = $_POST['recipe_title'];
    $description = $_POST['recipe_description'];
    $ingredients = $_POST['recipe_ingredients'];
    $instructions = $_POST['recipe_instructions'];
    $cuisine_type = $_POST['cuisine_type'];
    $dietary_preference = $_POST['dietary_preference'];
    $cooking_difficulty = $_POST['cooking_difficulty'];

    // Image upload handling
    $image = $_FILES['image']['name'];
    $target = "images/" . basename($image);
    
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        // Insert recipe into the database
        $stmt = $conn->prepare("INSERT INTO recipes (user_id, recipe_title, recipe_description, recipe_ingredients, recipe_instructions, cuisine_type, dietary_preference, cooking_difficulty, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssssss", $user_id, $title, $description, $ingredients, $instructions, $cuisine_type, $dietary_preference, $cooking_difficulty, $target);
        
        if ($stmt->execute()) {
            // Redirect to Recipe Collection page after successful submission
            header("Location: recipe_collection.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        
        $stmt->close();
    } else {
        echo "Failed to upload image.";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community Cookbook</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1 class="cookbook-title">Share Your Favorite Recipe</h1>

    <!-- Recipe Submission Form -->
    <form action="community_cookbook.php" method="POST" enctype="multipart/form-data" class="cookbook-form">
        <label for="recipeTitle" class="form-label">Recipe Title:</label>
        <input type="text" id="recipeTitle" name="recipe_title" class="form-input" required>

        <label for="recipeDescription" class="form-label">Description:</label>
        <textarea id="recipeDescription" name="recipe_description" class="form-textarea" required></textarea>

        <label for="recipeIngredients" class="form-label">Ingredients:</label>
        <textarea id="recipeIngredients" name="recipe_ingredients" class="form-textarea" required></textarea>

        <label for="recipeInstructions" class="form-label">Instructions:</label>
        <textarea id="recipeInstructions" name="recipe_instructions" class="form-textarea" required></textarea>

        <label for="cuisineType" class="form-label">Cuisine Type:</label>
        <input type="text" id="cuisineType" name="cuisine_type" class="form-input">

        <label for="dietaryPreference" class="form-label">Dietary Preference:</label>
        <input type="text" id="dietaryPreference" name="dietary_preference" class="form-input">

        <label for="cookingDifficulty" class="form-label">Cooking Difficulty:</label>
        <input type="text" id="cookingDifficulty" name="cooking_difficulty" class="form-input">

        <label for="recipeImage" class="form-label">Upload Image:</label>
        <input type="file" id="recipeImage" name="image" class="form-file-input" accept="image/*">

        <button type="submit" class="form-submit-button">Submit Recipe</button>
    </form>
</body>
</html>

