<?php
include 'db_connect.php';

// Fetch recipes from the database, joining with users table to get user details
$query = "SELECT recipes.*, users.user_id FROM recipes 
          JOIN users ON recipes.user_id = users.user_id 
          ORDER BY recipes.created_at DESC";
$result = $conn->query($query);

// Check if the query was successful
if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Collection</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Recipe Collection</h1>

    <div class="recipe-collection">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($recipe = $result->fetch_assoc()): ?>
                <div class="recipe-card">
                    <h2><?php echo htmlspecialchars($recipe['recipe_title']); ?></h2>
                    <img src="<?php echo htmlspecialchars($recipe['image']); ?>" alt="Recipe Image" class="recipe-image">
                    <p><strong>Description:</strong> <?php echo htmlspecialchars($recipe['recipe_description']); ?></p>
                    <p><strong>Ingredients:</strong> <?php echo htmlspecialchars($recipe['recipe_ingredients']); ?></p>
                    <p><strong>Instructions:</strong> <?php echo htmlspecialchars($recipe['recipe_instructions']); ?></p>
                    <p><strong>Cuisine:</strong> <?php echo htmlspecialchars($recipe['cuisine_type']); ?></p>
                    <p><strong>Dietary Preference:</strong> <?php echo htmlspecialchars($recipe['dietary_preference']); ?></p>
                    <p><strong>Difficulty:</strong> <?php echo htmlspecialchars($recipe['cooking_difficulty']); ?></p>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No recipes found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
