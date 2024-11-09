<?php
include 'db.php';

// Get category ID from the query parameter, default to 0 if not set
$categoryId = isset($_GET['category_id']) ? (int)$_GET['category_id'] : 0;

// SQL Query to retrieve recipes and their associated categories
$query = <<<QUERY
    SELECT
        r.id,
        r.recipe_name,
        r.recipe_description,
        CONCAT(
            '[', 
            GROUP_CONCAT(
                DISTINCT CONCAT(
                    '{"id":', 
                    c.id,
                    ',"name":"', 
                    REPLACE(c.name, '"', '\"'),
                    '"}'
                )
            ),
            ']'
        ) AS categories,
        rm.content AS 'media'
    FROM
        recipes r
    LEFT JOIN recipes_category rc ON
        rc.recipe_id = r.id
    LEFT JOIN category c ON
        c.id = rc.category_id
    LEFT JOIN recipes_media rm ON
        rm.recipe_id = r.id
    WHERE
        ($categoryId = 0 OR c.id = $categoryId)
    GROUP BY
        r.id, r.recipe_name, r.recipe_description
    ORDER BY
        r.created_at DESC;
QUERY;

$result = $conn->query($query);

// Error handling for query execution
if (!$result) {
    // Output an error message if the query fails
    echo json_encode(["error" => "Failed to retrieve recipes: " . $conn->error]);
    exit;
}

// Initialize recipes array
$recipes = [];

// Fetch and format results if query was successful
while ($row = $result->fetch_assoc()) {
    // Decode JSON string in categories
    $row['categories'] = json_decode($row['categories'], true);
    $recipes[] = $row;
}

// Return the recipes array as JSON
echo json_encode($recipes, JSON_UNESCAPED_UNICODE);
?>
