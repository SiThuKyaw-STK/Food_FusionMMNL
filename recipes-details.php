<?php
include 'db.php';
include 'components/header.php';

$recipeId = isset($_GET['id']) ? intval($_GET['id']) : 0;

$recipeDetailsQuery = <<<QUERY
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
    CONCAT(
        '[',
        GROUP_CONCAT(
            DISTINCT CONCAT(
                '{"id":',
                rm.id,
                ',"media":"',
                REPLACE(rm.content, '"', '\"'),
                '"}'
            )
        ),
        ']'
    ) AS images,
    CONCAT(
        '[',
        GROUP_CONCAT(
            DISTINCT CONCAT(
                '{"id":',
                rc2.id,
                ',"type":',
                rc2.type,
                ',"content":"',
                REPLACE(REPLACE(rc2.content, '"', '\''), '"', '\"'),
                '"}'
            )
        ),
        ']'
    ) AS contents
FROM
    recipes r
LEFT JOIN recipes_category rc ON
    rc.recipe_id = r.id
LEFT JOIN category c ON
    c.id = rc.category_id
LEFT JOIN recipes_media rm ON
    rm.recipe_id = r.id
LEFT JOIN recipes_content rc2 ON
    rc2.recipe_id = r.id
WHERE
    r.id = $recipeId
GROUP BY
    r.id,
    r.recipe_name,
    r.recipe_description;
QUERY;

$recipeResult = $conn->query($recipeDetailsQuery);

if ($recipeResult && $recipeResult->num_rows > 0) {
    $recipe = $recipeResult->fetch_assoc();

    $categories = json_decode($recipe['categories'], true);
    $images = json_decode($recipe['images'], true);
    $contents = json_decode($recipe['contents'], true);

    // Separate ingredients and directions from contents
    $ingredients = [];
    $directions = [];

    foreach ($contents as $content) {
        if ($content['type'] == 1) {
            $ingredients[] = $content['content']; // Type 1: Ingredients
        } elseif ($content['type'] == 2) {
            $directions[] = $content['content']; // Type 2: Directions
        }
    }

} else {
    echo "Recipe not found.";
    exit;
}
?>

<section class="about-us w-4/5 max-w-screen-xl mx-auto py-8">
    <div class="max-w-5xl mx-auto p-4">
        <!-- Main Image Carousel -->
        <div id="main-carousel" class="splide p-0">
            <div class="splide__track">
                <ul class="splide__list">
                    <?php if (!empty($images)): ?>
                        <?php foreach ($images as $image): ?>
                            <li class="splide__slide">
                                <img src="<?= htmlspecialchars($image['media']); ?>" alt="Recipe Image" class="object-cover w-full h-10">
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li class="splide__slide">
                            <img src="https://via.placeholder.com/500x300?text=No+Image+Available" alt="No Image Available" class="object-cover w-full h-10">
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

        <!-- Thumbnails Carousel -->
        <div id="thumbnail-carousel" class="splide mt-4 p-0">
            <div class="splide__track">
                <ul class="splide__list">
                    <?php if (!empty($images)): ?>
                        <?php foreach ($images as $image): ?>
                            <li class="splide__slide w-16 h-16 bg-gray-200">
                                <img src="<?= htmlspecialchars($image['media']); ?>" alt="Thumbnail" class="object-cover w-full h-full">
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li class="splide__slide w-16 h-16 bg-gray-200">
                            <img src="https://via.placeholder.com/100x100?text=No+Image" alt="No Image Available" class="object-cover w-full h-full">
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

        <!-- Title and Tags -->
        <div class="mt-4">
            <h1 class="text-2xl font-semibold"><?= htmlspecialchars($recipe['recipe_name']); ?></h1>
            <div class="flex space-x-2 mt-2">
                <?php foreach ($categories as $category): ?>
                    <span class="bg-orange-600 text-white text-sm px-2 py-1 rounded-full"><?= htmlspecialchars($category['name']); ?></span>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Ingredients and Directions -->
        <div class="mt-6 grid grid-cols-2 gap-4">
            <!-- Ingredients -->
            <div>
                <h2 class="text-lg font-semibold">Ingredients</h2>
                    <?php foreach ($ingredients as $ingredient): ?>
                        <?= $ingredient; ?>
                    <?php endforeach; ?>
            </div>
            
            <!-- Directions -->
            <div>
                <h2 class="text-lg font-semibold">Directions</h2>
                    <?php foreach ($directions as $direction): ?>
                        <?= $direction; ?>
                    <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize main carousel
        var mainCarousel = new Splide('#main-carousel', {
            type       : 'fade',
            heightRatio: 0.5,
            pagination : false,
            arrows     : false,
            cover      : true,
        }).mount();

        // Initialize thumbnails carousel
        var thumbnails = new Splide('#thumbnail-carousel', {
            fixedWidth  : 120,
            fixedHeight : 120,
            isNavigation: true,
            gap         : 10,
            focus       : 'left',
            pagination  : false,
            arrows      : false,
            cover       : true,
            breakpoints : {
                600: {
                    fixedWidth : 48,
                    fixedHeight: 48,
                },
            },
        }).mount();

        // Sync thumbnails with main carousel
        mainCarousel.sync(thumbnails);
    });
</script>

<?php include 'components/footer.php'; ?>
