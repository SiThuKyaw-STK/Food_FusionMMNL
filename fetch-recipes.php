<?php
include 'db_connection.php';

$cuisine = isset($_GET['cuisine']) ? $_GET['cuisine'] : '';
$dietary = isset($_GET['dietary']) ? $_GET['dietary'] : '';
$difficulty = isset($_GET['difficulty']) ? $_GET['difficulty'] : '';

$query = "SELECT * FROM recipes WHERE 1";

if ($cuisine) {
    $query .= " AND cuisine_type = '$cuisine'";
}

if ($dietary) {
    $query .= " AND dietary_preference = '$dietary'";
}

if ($difficulty) {
    $query .= " AND cooking_difficulty = '$difficulty'";
}

$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='recipe'>";
        echo "<h2>" . $row['title'] . "</h2>";
        echo "<p>" . $row['description'] . "</p>";
        echo "<img src='" . $row['image'] . "' alt='" . $row['title'] . "' />";
        echo "<p><strong>Cuisine:</strong> " . $row['cuisine_type'] . "</p>";
        echo "<p><strong>Dietary Preference:</strong> " . $row['dietary_preference'] . "</p>";
        echo "<p><strong>Difficulty:</strong> " . $row['cooking_difficulty'] . "</p>";
        echo "</div>";
    }
} else {
    echo "<p>No recipes found for the selected filters.</p>";
}

$conn->close();
?>
