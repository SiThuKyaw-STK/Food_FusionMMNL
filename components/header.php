<?php
// Check if a session is already active before starting a new one
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$currentPage = basename($_SERVER['PHP_SELF']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodFusion</title>
    <link rel="stylesheet" href="./css/style.css">

    <!-- Tailwind css -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Quill -->
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

    <!-- Add Splide CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/css/splide.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/css/themes/splide-sea-green.min.css" />

    <!-- Add Splide JS -->
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>

    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


</head>
<body>
    <!-- Header Section -->
    </head>
<body>
    <!-- Header Section -->
    <header class="bg-orange-600 text-white py-4 shadow-lg">
        <div class="container mx-auto flex items-center justify-between px-4 max-w-screen-2xl">
            <div class="logo">
                <h1 class="text-2xl font-bold text-[#fdf5f1]">FoodFusion</h1>
            </div>


            <!-- Navbar Links (hidden on mobile, displayed on large screens) -->
            <nav class="navbar hidden lg:flex space-x-5">
                <ul class="flex space-x-5">
                    <li><a href="index.php" class=" <?= $currentPage == 'index.php' ? 'bg-yellow-400 text-[#b8331b]' : '' ?> hover:bg-yellow-400 hover:text-[#b8331b] rounded px-3 py-2 transition">Home</a></li>
                    <li><a href="about.php" class=" <?= $currentPage == 'about.php' ? 'bg-yellow-400 text-[#b8331b]' : '' ?> hover:bg-yellow-400 hover:text-[#b8331b] rounded px-3 py-2 transition">About</a></li>
                    <li><a href="recipe-collection.php" class=" <?= $currentPage == 'recipe-collection.php' ? 'bg-yellow-400 text-[#b8331b]' : '' ?> hover:bg-yellow-400 hover:text-[#b8331b] rounded px-3 py-2 transition">Recipes</a></li>
                    <li><a href="community-cookbook.php" class=" <?= $currentPage == 'community-cookbook.php' ? 'bg-yellow-400 text-[#b8331b]' : '' ?> hover:bg-yellow-400 hover:text-[#b8331b] rounded px-3 py-2 transition">Community</a></li>
                    <li><a href="culinary-resources.php" class=" <?= $currentPage == 'culinary-resources.php' ? 'bg-yellow-400 text-[#b8331b]' : '' ?> hover:bg-yellow-400 hover:text-[#b8331b] rounded px-3 py-2 transition">Culinary</a></li>
                    <li><a href="educational-resources.php" class=" <?= $currentPage == 'educational-resources.php' ? 'bg-yellow-400 text-[#b8331b]' : '' ?> hover:bg-yellow-400 hover:text-[#b8331b] rounded px-3 py-2 transition">Educational</a></li>
                    <li><a href="contact.php" class=" <?= $currentPage == 'contact.php' ? 'bg-yellow-400 text-[#b8331b]' : '' ?> hover:bg-yellow-400 hover:text-[#b8331b] rounded px-3 py-2 transition">Contact</a></li>
                </ul>
            </nav>

            <!-- Login Button (always visible) -->
            <div class="navbar-btn">
                <div class="flex flex-col md:flex-row justify-center items-center">
                    <?php if (isset($_SESSION['user'])): ?>
                        <span class="text-lg">Welcome, <?= htmlspecialchars($_SESSION['user']['user_fname']); ?>!</span>
                        <span class="mx-2 hidden md:block">|</span>
                        <a id="logoutBtn" class="bg-yellow-400 text-[#b8331b] px-4 py-2 rounded text-base font-semibold transition hover:bg-[#b8331b] hover:text-white" href="logout.php">LogOut</a>
                    <?php else: ?>
                        <a href="loginform.php" id="login-btn" class="bg-yellow-400 text-[#b8331b] px-4 py-2 rounded text-base font-semibold transition hover:bg-[#b8331b] hover:text-white">
                            Login
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>

    <!-- Mobile Menu Icon -->
    <div class="lg:hidden p-3 shadow-3xl">
        <button id="menu-toggle" class="text-white focus:outline-none focus:ring-2 focus:ring-white">
            <i class="fa-solid fa-bars text-black text-4xl"></i>
        </button>
    </div>

    <!-- Mobile Dropdown Menu -->
    <nav id="mobile-menu" class="lg:hidden hidden px-4 py-2">
        <ul class="space-y-2">
            <li><a href="index.php" class="block text-black hover:bg-yellow-400 hover:text-[#b8331b] rounded px-3 py-2 transition">Home</a></li>
            <li><a href="about.php" class="block text-black hover:bg-yellow-400 hover:text-[#b8331b] rounded px-3 py-2 transition">About Us</a></li>
            <li><a href="recipe-collection.php" class="block text-black hover:bg-yellow-400 hover:text-[#b8331b] rounded px-3 py-2 transition">Recipe Collection</a></li>
            <li><a href="community-cookbook.php" class="block text-black hover:bg-yellow-400 hover:text-[#b8331b] rounded px-3 py-2 transition">Community Cookbook</a></li>
            <li><a href="culinary-resources.php" class="block text-black hover:bg-yellow-400 hover:text-[#b8331b] rounded px-3 py-2 transition">Culinary</a></li>
            <li><a href="educational-resources.php" class="block text-black hover:bg-yellow-400 hover:text-[#b8331b] rounded px-3 py-2 transition">Educational</a></li>
            <li><a href="contact.php" class="block text-black hover:bg-yellow-400 hover:text-[#b8331b] rounded px-3 py-2 transition">Contact Us</a></li>
        </ul>
    </nav>

<script>
     $("#menu-toggle").click(function() {
    // Toggle the visibility of the mobile menu
    $("#mobile-menu").toggleClass("hidden");
});
</script>

