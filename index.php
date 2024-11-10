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
            r.created_at DESC
        LIMIT 4;
QUERY;

$recipesLatest = $conn->query($query1);
if (!$recipesLatest) {
    die("Error fetching recipes: " . $conn->error);
}

// Fetch recipes popular
$query2 = <<<QUERY
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
            r.view_count DESC
        LIMIT 4;
QUERY;

$recipesPopular = $conn->query($query2);
if (!$recipesPopular) {
    die("Error fetching recipes: " . $conn->error);
}

?>

    <!-- Hero Section -->

    <section class="hero bg-cover bg-center text-fdf5f1 py-16 px-5 flex items-center justify-center flex-col" style="background-image: url('./images/westernbg.jpg');">
        <div class="hero-content max-w-2xl p-8 rounded-lg shadow-lg bg-transparent text-center">
            <h2 class="text-5xl mb-4 text-[#ffd166]">
                Welcome to <b class="text-[#e65c00]">FoodFusion</b>
            </h2>
            <p class="text-xl mb-5 leading-6 text-gray-800">
            Explore a world of flavors, recipes, and culinary creativity. Join us and be a part of our vibrant food community.
            </p>
            <button id="join_us" class="join-us-btn bg-[#ffd166] text-[#e65c00] border-none py-2 px-4 text-xl font-bold rounded-md cursor-pointer transition-colors duration-300 hover:bg-[#e65c00] hover:text-[#fdf5f1]">
            Join the community
            </button>
        </div>
    </section>


    <!-- Join Us Pop-Up Form -->
    <div id="joinUsPopup" class="popup-form hidden fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex items-center justify-center z-10">
        <div class="popup-content bg-white p-8 w-11/12 max-w-sm rounded-lg shadow-lg relative text-center mx-auto">
            <span id="close_btn" class="close-btn absolute top-2 right-4 text-2xl text-deep-red cursor-pointer">&times;</span>
            <h2 class="text-deep-red mb-5">Join FoodFusion</h2>
            <form id="register_form">
                <label for="firstName" class="block text-sm text-deep-red mt-2 text-left">First Name</label>
                <input type="text" id="firstName" name="firstName" required class="w-full p-3 mt-1 mb-4 border border-deep-red rounded-md">

                <label for="lastName" class="block text-sm text-deep-red mt-2 text-left">Last Name</label>
                <input type="text" id="lastName" name="lastName" required class="w-full p-3 mt-1 mb-4 border border-deep-red rounded-md">

                <label for="email" class="block text-sm text-deep-red mt-2 text-left">Email</label>
                <input type="email" id="email" name="email" required class="w-full p-3 mt-1 mb-4 border border-deep-red rounded-md">

                <label for="password" class="block text-sm text-deep-red mt-2 text-left">Password</label>
                <input type="password" id="password" name="password" required class="w-full p-3 mt-1 mb-4 border border-deep-red rounded-md">

                <label for="confirmPassword" class="block text-sm text-deep-red mt-2 text-left">Confirm Password</label>
                <input type="password" id="confirmPassword" name="confirmPassword" required class="w-full p-3 mt-1 mb-4 border border-deep-red rounded-md">

                <button type="submit" class="submit-btn bg-yellow-400 text-deep-red font-bold py-2 px-6 rounded-md cursor-pointer transition-all duration-300 hover:bg-orange-600 hover:text-white">Join Now</button>
                <p id="join-text" class="mt-3 text-blue-600">
                    <span>Already have an account?</span>
                    <a href="" class="text-blue-600 no-underline">Login</a>
                </p>
            </form>
        </div>
    </div>

    <!-- News Feed Section -->
    <section class="news-feed bg-white bg-opacity-30 rounded-lg shadow-lg mb-5">
        <h2 class="text-orange-600 mb-4 text-center text-lg">Recent Recipes and Culinary Trends</h2>
        <div class="recipe-list flex flex-wrap gap-6 justify-center p-6" id="recipeList">
            <?php while ($recipe = $recipesLatest->fetch_assoc()): ?>
                <div class="recipe-card bg-white border border-gray-300 rounded-lg shadow-md overflow-hidden w-full md:w-72 transition-transform transform hover:translate-y-1">
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
    </section>

    <!-- about us section-->
    <div class="about-section w-4/5 text-gray-800 rounded-lg mx-auto my-10 shadow-lg text-center">
        <h2 class="text-orange-600 text-xl mb-5 px-4 py-2">About Us</h2>
        <div class="about-flex-container lg:flex flex-row-reverse justify-around items-center gap-5 p-5 md:p-10">
            <!-- Image Section -->
            <div class="about-image">
                <img src="images/about.jpg" class="w-full lg:w-[400px] rounded-lg shadow-md" />
            </div>
            
            <!-- Text Content Section -->
            <div class="about-text max-w-[500px] text-left leading-7">
                <p>At FoodFusion, we believe in the power of home cooking to bring people together and inspire culinary creativity. Our mission is to provide a community where food enthusiasts can share recipes, learn new techniques, and celebrate the joy of cooking from all around the world.</p>
                <button id="see-more-btn" class="bg-orange-600 text-white px-4 py-2 rounded-lg mt-4 hover:bg-orange-700">
                    <a href="about.php" class="no-underline">See More</a>
                </button>
            </div>
        </div>
    </div>


    <!-- Recipe collection start-->
    <h2 id="recipe-card-title">Popular Recipes</h2>
    <div class="recipe-cards-container">
    <div class="recipe-card">
        <img src="images/Spicy Tofu Stir-Fry.jpg" alt="Recipe Image" class="recipe-image">
        <div class="recipe-content">
            <h3 class="recipe-title">Spicy Tofu Stir-Fry</h3>
            <p class="recipe-description">A quick, healthy, and spicy tofu stir-fry that’s bursting with flavor.</p>
            <div class="recipe-tags">
                <span class="tag">Vegan/Gluten-Free</span>
                <span class="tag">Chinese</span>
                <span class="tag">Easy</span>
            </div>
        </div>
    </div>
    
    <div class="recipe-card">
        <img src="images/Classic Margherita Pizza.jpg" alt="Recipe Image" class="recipe-image">
        <div class="recipe-content">
            <h3 class="recipe-title">Classic Margherita Pizza</h3>
            <p class="recipe-description">An Italian classic with fresh mozzarella, tomatoes, and basil.</p>
            <div class="recipe-tags">
                <span class="tag">Vegetarian</span>
                <span class="tag">Italian</span>
                <span class="tag">Intermediate</span>
            </div>
        </div>
    </div>
    
    <div class="recipe-card">
        <img src="images/Vegetarian-Italian-Stuffed-Peppers.jpg" alt="Recipe Image" class="recipe-image">
        <div class="recipe-content">
            <h3 class="recipe-title">Stuffed Bell Peppers</h3>
            <p class="recipe-description">Colorful bell peppers filled with a savory mixture of rice, beans, and spices, baked to perfection for a delicious meal.</p>
            <div class="recipe-tags">
                <span class="tag">Vegetarian</span>
                <span class="tag">Mexican</span>
                <span class="tag">Moderate</span>
            </div>
        </div>
    </div>

    <div class="recipe-card">
        <img src="images/teri.jpg" alt="Recipe Image" class="recipe-image">
        <div class="recipe-content">
            <h3 class="recipe-title">Teriyaki Chicken</h3>
            <p class="recipe-description">Grilled or pan-seared chicken glazed with a sweet and savory teriyaki sauce, served with steamed rice and vegetables.</p>
            <div class="recipe-tags">
                <span class="tag">Poultry</span>
                <span class="tag">Japanese</span>
                <span class="tag">Moderate</span>
            </div>
        </div>
    </div>

    <div class="recipe-card">
        <img src="images/ChickenBiryani.jpg" alt="Recipe Image" class="recipe-image">
        <div class="recipe-content">
            <h3 class="recipe-title">Biryani</h3>
            <p class="recipe-description">A fragrant rice dish layered with marinated meat (or vegetables) and aromatic spices, often garnished with fried onions and boiled eggs.</p>
            <div class="recipe-tags">
                <span class="tag">Poultry/Vegetarian</span>
                <span class="tag">Indian</span>
                <span class="tag">Moderate</span>
            </div>
        </div>
    </div>

    <div class="recipe-card">
        <img src="images/creamy-mushroom-soup.jpg" alt="Recipe Image" class="recipe-image">
        <div class="recipe-content">
            <h3 class="recipe-title">Creamy Mushroom Soup</h3>
            <p class="recipe-description">A rich and creamy soup made with sautéed mushrooms and heavy cream, perfect for a comforting keto-friendly starter.</p>
            <div class="recipe-tags">
                <span class="tag">Keto</span>
                <span class="tag">Amarican</span>
                <span class="tag">Easy</span>
            </div>
        </div>
    </div>

    <div class="recipe-card">
        <img src="images/croissant.jpg" alt="Recipe Image" class="recipe-image">
        <div class="recipe-content">
            <h3 class="recipe-title">Croissants</h3>
            <p class="recipe-description">Flaky, buttery pastries made with a laminated dough that requires multiple folds and turns to create layers, resulting in a delicate texture.</p>
            <div class="recipe-tags">
                <span class="tag">Vegetarian</span>
                <span class="tag">French</span>
                <span class="tag">Hard</span>
            </div>
        </div>
    </div>

    <div class="recipe-card">
        <img src="images/ramen.jpg" alt="Recipe Image" class="recipe-image">
        <div class="recipe-content">
            <h3 class="recipe-title">Ramen from Scratch</h3>
            <p class="recipe-description">A labor-intensive dish that includes making homemade noodles, rich pork broth (or vegetarian dashi), and toppings like soft-boiled eggs, chashu pork, and menma (bamboo shoots).</p>
            <div class="recipe-tags">
                <span class="tag">Pork/Vegetarian</span>
                <span class="tag">Japanese</span>
                <span class="tag">Hard</span>
            </div>
        </div>
    </div>
    <!-- Repeat .recipe-card for more recipes -->
</div>
  
    <div class="carousel-container">
        <div class="carousel">
            <input type="radio" name="slides" id="slide1" checked>
            <input type="radio" name="slides" id="slide2">
            <input type="radio" name="slides" id="slide3">
            <input type="radio" name="slides" id="slide4">

            <div class="slides">
                <div class="slide">
                    <img src="images/event1.jpg" alt="Event 1">
                    <div class="overlay">
                        <h3 class="card-title">Upcoming Event 1</h3>
                        <p class="card-description">Join us for an exciting culinary event!</p>
                    </div>
                </div>
                <div class="slide">
                    <img src="images/event2.jpg" alt="Event 2">
                    <div class="overlay">
                        <h3 class="card-title">Upcoming Event 2</h3>
                        <p class="card-description">Learn new cooking techniques with expert chefs!</p>
                    </div>
                </div>
                <div class="slide">
                    <img src="images/palak_paneer_85769_16x9.jpg" alt="Featured Recipe 1">
                    <div class="overlay">
                        <h3 class="card-title">Featured Recipe 1</h3>
                        <p class="card-description">Try our delicious new recipe!</p>
                    </div>
                </div>
                <div class="slide">
                    <img src="images/italian-food.png" alt="Featured Recipe 2">
                    <div class="overlay">
                        <h3 class="card-title">Featured Recipe 2</h3>
                        <p class="card-description">A delightful recipe you will love!</p>
                    </div>
                </div>
            </div>

            <div class="controls">
                <label for="slide1" class="control"></label>
                <label for="slide2" class="control"></label>
                <label for="slide3" class="control"></label>
                <label for="slide4" class="control"></label>
            </div>
        </div>
    </div>


    <!-- Cookie Consent -->
    <!-- <div id="cookieConsent" class="cookie-consent">
        <p>We use cookies to enhance your experience on our website. By continuing, you agree to our <a href="#">cookie policy</a>.</p>
        <button onclick="acceptCookies()">Accept</button>
    </div> -->

<?php include 'components/footer.php'; ?>
