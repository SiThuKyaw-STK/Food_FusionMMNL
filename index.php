<?php
include 'db_connect.php';
include 'components/header.php';


// Basic test query
$recipeQuery = "SELECT * FROM recipes LIMIT 1"; // Fetches one row to test
$recipeResult = $conn->query($recipeQuery);

?>

    <!-- Hero Section -->
    <section class="hero">
      <div class="hero-content">
          <h2>Welcome to <b>FoodFusion</b></h2>
          <p>Explore a world of flavors, recipes, and culinary creativity. Join us and be a part of our vibrant food community.</p>
          <button class="join-us-btn" onclick="showJoinUsPopup()">Join the community</button>
      </div>
  </section>

     <!-- Join Us Pop-Up Form -->
     <div id="joinUsPopup" class="popup-form">
         <div class="popup-content">
             <span class="close-btn" onclick="closeJoinUsPopup()">&times;</span>
             <h2>Join FoodFusion</h2>
             <form id="joinForm">
                 <label for="firstName">First Name</label>
                 <input type="text" id="firstName" name="firstName" required>
 
                 <label for="lastName">Last Name</label>
                 <input type="text" id="lastName" name="lastName" required>
 
                 <label for="email">Email</label>
                 <input type="email" id="email" name="email" required>
 
                 <label for="password">Password</label>
                 <input type="password" id="password" name="password" required>

                 <label for="password">Confirm Password</label>
                 <input type="password" id="password" name="password" required>
 
                 <button type="submit" class="submit-btn">Join Now</button>
                 <p id="join-text">
                    <span>Already have an account?</span>
                    <a href="">Login</a>
                 </p>
             </form>
         </div>
     </div>
 

     <!-- News Feed Section -->
    <section class="news-feed">
      <h2>Recent Recipes and Culinary Trends</h2>
      <div class="recipe-list" id="recipeList">
      </div>
  </section>


    <!-- about us section-->
  <div class="about-section">
    <h2>About Us</h2>
    <div class="about-flex-container">
        <!-- Image Section -->
        <div class="about-image">
            <img src="images/about.jpg"  />
        </div>
        
        <!-- Text Content Section -->
        <div class="about-text">
            <p>At FoodFusion, we believe in the power of home cooking to bring people together and inspire culinary creativity. Our mission is to provide a community where food enthusiasts can share recipes, learn new techniques, and celebrate the joy of cooking from all around the world.</p>
            <button id="see-more-btn"><a href="about.php">See More</a></button>
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
    <div id="cookieConsent" class="cookie-consent">
        <p>We use cookies to enhance your experience on our website. By continuing, you agree to our <a href="#">cookie policy</a>.</p>
        <button onclick="acceptCookies()">Accept</button>
    </div>

<?php include 'components/footer.php'; ?>
