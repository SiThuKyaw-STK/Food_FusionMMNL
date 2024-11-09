<?php
include 'db.php';
include 'components/header.php';

// Fetch recipes latest
$query1 = <<<QUERY
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
        GROUP BY
            r.id, r.recipe_name, r.recipe_description
        ORDER BY
            r.created_at DESC;
QUERY;

$recipes = $conn->query($query1);
if (!$recipes) {
    die("Error fetching recipes: " . $conn->error);
}

// Fetch categories
$categories = $conn->query("SELECT id, name FROM category");
if (!$categories) {
    die("Error fetching categories: " . $conn->error);
}

?>

<div class="bg-gray-200">
    <section class="container max-w-7xl mx-auto py-10">
        <div class="flex flex-wrap gap-2 my-4">
            <button onclick="filterRecipes(0)"
                class="px-4 py-2 text-sm font-medium text-white bg-orange-500 rounded-full hover:bg-orange-600 focus:ring-2 focus:ring-orange-400 focus:outline-none transition ease-in-out duration-150">
                All
            </button>
            <?php while ($row = $categories->fetch_assoc()): ?>
                <button onclick="filterRecipes(<?= $row['id']; ?>)"
                    class="px-4 py-2 text-sm font-medium text-white bg-orange-500 rounded-full hover:bg-orange-600 focus:ring-2 focus:ring-orange-400 focus:outline-none transition ease-in-out duration-150">
                    <?= $row['name']; ?>
                </button>
            <?php endwhile; ?>
        </div>

        <!-- Recipe Cards -->
        <div class="recipe-list grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 p-6" id="recipeList">
            <?php while ($recipe = $recipes->fetch_assoc()): ?>
                <div class="recipe-card bg-white border border-gray-300 rounded-lg shadow-md overflow-hidden transition-transform transform hover:translate-y-1">
                    <a href="recipes-details.php?id=<?= $recipe['id']; ?>">
                        <img src="<?= $recipe['media']; ?>" alt="Recipe Image" class="w-full h-44 object-cover">
                    </a>
                    <div class="recipe-content p-4 text-gray-800">
                        <h3 class="recipe-title text-xl text-orange-600 mb-2"><?= $recipe['recipe_name']; ?></h3>
                        <p class="recipe-description text-sm text-gray-600 mb-2"><?= $recipe['recipe_description']; ?></p>
                        <div class="recipe-tags flex flex-wrap gap-2">
                            <?php
                            // Decode categories JSON
                            $categories = json_decode($recipe['categories'], true);
                            if (is_array($categories)) {
                                foreach ($categories as $category) {
                                    echo '<span class="tag bg-orange-600 text-white text-xs py-1 px-2 rounded-full whitespace-nowrap">' . htmlspecialchars($category['name']) . '</span>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <!-- No Recipes Found Message -->
        <div id="noRecipes" class="hidden text-center p-6">
            <h3 class="text-2xl text-gray-600">There are no recipes available.</h3>
            <p class="text-gray-500 mt-2">Try selecting a different category or check back later!</p>
        </div>
    </section>
</div>


<script>
function filterRecipes(categoryId) {
    $.ajax({
        url: 'fetch_recipes.php',
        type: 'GET',
        data: { category_id: categoryId },
        dataType: 'json',
        success: function(data) {
            $('#recipeList').empty(); // Clear current recipes
            if (data.length > 0) {
                $('#noRecipes').addClass('hidden'); // Hide "No Recipes" message
                $.each(data, function(index, recipe) {
                    const recipeCard = `
                        <div class="recipe-card bg-white border border-gray-300 rounded-lg shadow-md overflow-hidden transition-transform transform hover:translate-y-1">
                            <a href="recipes-details.php?id=${recipe.id}">
                                <img src="${recipe.media}" alt="Recipe Image" class="w-full h-44 object-cover">
                            </a>
                            <div class="recipe-content p-4 text-gray-800">
                                <h3 class="recipe-title text-xl text-orange-600 mb-2">${recipe.recipe_name}</h3>
                                <p class="recipe-description text-sm text-gray-600 mb-2">${recipe.recipe_description}</p>
                                <div class="recipe-tags flex flex-wrap gap-2">
                                    ${recipe.categories.map(cat => `<span class="tag bg-orange-600 text-white text-xs py-1 px-2 rounded-full whitespace-nowrap">${cat.name}</span>`).join('')}
                                </div>
                            </div>
                        </div>
                    `;
                    $('#recipeList').append(recipeCard); // Append each filtered recipe card
                });
            } else {
                $('#noRecipes').removeClass('hidden'); // Show "No Recipes" message
            }
        },
        error: function() {
            console.error('Error fetching filtered recipes');
        }
    });
}

// Initial load to display all recipes
$(document).ready(function() {
    filterRecipes(0);
});
</script>
<?php include 'components/footer.php'; ?>