<?php
include 'components/header.php';

?>
<section class="about-us w-4/5 max-w-screen-xl mx-auto py-8">
    <!-- Introduction Section -->
    <div class="intro-section text-center py-5 shadow-md">
        <div class="intro-text mb-8">
            <h1 class="text-4xl text-orange-600 mb-8">About Us</h1>
            <p class="text-lg text-gray-600 mt-3 leading-7">Welcome to FoodFusion, a culinary platform that celebrates the art of home cooking. Here, we inspire creativity, bringing together a community of passionate food enthusiasts who believe in the joy of shared meals and inventive recipes. Join us to explore, cook, and connect with flavors from around the world.</p>
        </div>
        <div class="intro-img mt-12 px-4">
            <img src="images/about2.jpg" alt="" class="w-full md:w-4/5 rounded-xl">
        </div>
    </div>

    <!-- Philosophy and Values Section -->
    <div class="philosophy-values flex flex-wrap gap-8 mt-8 px-4 text-gray-600">
        <div class="philosophy flex-1 p-5 bg-white rounded-lg shadow-md">
            <h2 class="text-2xl text-orange-600 mb-4">Our Culinary Philosophy</h2>
            <p class="leading-7">At FoodFusion, we are committed to sharing recipes that celebrate diverse culinary traditions, promote sustainable cooking practices, and encourage experimentation in the kitchen.</p>
        </div>
        <div class="values flex-1 p-5 bg-white rounded-lg shadow-md">
            <h2 class="text-2xl text-orange-600 mb-4">Our Values</h2>
            <ul class="list-disc pl-5">
                <li>Inclusivity: Celebrating cuisines from all cultures</li>
                <li>Sustainability: Promoting eco-friendly cooking</li>
                <li>Community: Building connections through shared food experiences</li>
            </ul>
        </div>
    </div>

    <!-- Team Section -->
    <div class="team-section text-center mt-12">
        <h2 class="text-3xl text-orange-600">Meet Our Team</h2>
        <div class="team-grid flex flex-wrap gap-8 justify-center mt-8">
            <!-- Team Member 1 -->
            <div class="team-member bg-white rounded-lg p-6 w-full md:w-60 text-center shadow-md">
                <img src="images/team1.jpg" alt="Team Member 1" class="w-full h-auto rounded-full mb-4">
                <h3 class="text-xl text-orange-600">Chef Alex Morgan</h3>
                <p class="text-sm text-gray-600">Head Chef and Recipe Developer</p>
                <p class="text-sm text-gray-600 mt-2">With over 15 years of experience in the culinary world, Alex brings his expertise in fusion cuisine and a passion for innovative cooking.</p>
            </div>
            
            <!-- Team Member 2 -->
            <div class="team-member bg-white rounded-lg p-6 w-full md:w-60 text-center shadow-md">
                <img src="images/team2.jpg" alt="Team Member 2" class="w-full h-auto rounded-full mb-4">
                <h3 class="text-xl text-orange-600">Sarah Kim</h3>
                <p class="text-sm text-gray-600">Content Manager</p>
                <p class="text-sm text-gray-600 mt-2">Sarah is responsible for managing FoodFusion’s content, ensuring high-quality, engaging recipes and resources for all food enthusiasts.</p>
            </div>
            
            <!-- Team Member 3 -->
            <div class="team-member bg-white rounded-lg p-6 w-full md:w-60 text-center shadow-md">
                <img src="images/team3.jpg" alt="Team Member 3" class="w-full h-auto rounded-full mb-4">
                <h3 class="text-xl text-orange-600">David Lopez</h3>
                <p class="text-sm text-gray-600">Community Manager</p>
                <p class="text-sm text-gray-600 mt-2">David fosters a vibrant and welcoming community for FoodFusion, encouraging members to share their culinary experiences and tips.</p>
            </div>
        </div>
    </div>
</section>

<?php include 'components/footer.php'; ?>

