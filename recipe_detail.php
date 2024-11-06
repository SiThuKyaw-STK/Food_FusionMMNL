<?php
include 'db_connect.php'; // Ensure this file connects to your database

$id = $_GET['recipe_id'] ?? '';
$sql = "SELECT * FROM recipe WHERE recipe_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $recipe = $result->fetch_assoc();
} else {
    echo "Recipe not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($recipe['recipe_name']); ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1><?php echo htmlspecialchars($recipe['recipe_name']); ?></h1>
    </header>

    <div class="recipe-detail">
        <img src="<?php echo htmlspecialchars($recipe['recipe_photo']); ?>" alt="<?php echo htmlspecialchars($recipe['recipe_name']); ?>">
        <p><?php echo nl2br(htmlspecialchars($recipe['recipe_description'])); ?></p>
        <div class="tags">
            <span>Cuisine: <?php echo htmlspecialchars($recipe['cuisine_id']); ?></span>
            <span>Dietary: <?php echo htmlspecialchars($recipe['dp_id']); ?></span>
            <span>Difficulty: <?php echo htmlspecialchars($recipe['cook_id']); ?></span>
        </div>
    </div>

</body>
</html>
