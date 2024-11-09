<?php
include 'components/header.php';

?>
<h1 id="culinary-header" class="text-center mt-6 mb-5 text-orange-600 py-2 px-4">
    Culinary Resources
</h1>
<section class="culinary-resources flex flex-wrap gap-5 p-5 max-w-7xl mx-auto">
    <div class="culinary-cards grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 p-4">
        <div class="culinary-card bg-white border border-gray-300 rounded-lg p-4 text-center">
            <img src="images/ChilesenNogada.jpg" alt="Recipe Image" class="w-full rounded-lg">
            <h3 class="mt-3 text-lg text-gray-800">Chocolate Chip Cookies</h3>
            <p class="text-sm text-gray-600">A classic recipe for chewy, delicious chocolate chip cookies.A classic recipe for chewy, delicious chocolate chip cookies.A classic recipe for chewy, delicious chocolate chip cookies.</p>
            <a href="recipe1.pdf" download class="inline-block mt-3 py-2 px-4 bg-red-500 text-white rounded hover:bg-red-600">Download</a>
        </div>
        <div class="culinary-card bg-white border border-gray-300 rounded-lg p-4 text-center">
            <img src="images/GreekSalad.jpg" alt="Recipe Image" class="w-full rounded-lg">
            <h3 class="mt-3 text-lg text-gray-800">Spaghetti Carbonara</h3>
            <p class="text-sm text-gray-600">Learn to make authentic Italian spaghetti carbonara.</p>
            <a href="recipe2.pdf" download class="inline-block mt-3 py-2 px-4 bg-red-500 text-white rounded hover:bg-red-600">Download</a>
        </div>
        <div class="culinary-card bg-white border border-gray-300 rounded-lg p-4 text-center">
            <img src="images/hummus.jpg" alt="Recipe Image" class="w-full rounded-lg">
            <h3 class="mt-3 text-lg text-gray-800">Spaghetti Carbonara</h3>
            <p class="text-sm text-gray-600">Learn to make authentic Italian spaghetti carbonara.</p>
            <a href="recipe2.pdf" download class="inline-block mt-3 py-2 px-4 bg-red-500 text-white rounded hover:bg-red-600">Download</a>
        </div>
        <div class="culinary-card bg-white border border-gray-300 rounded-lg p-4 text-center">
            <img src="images/LambRoganJosh.jpg" alt="Recipe Image" class="w-full rounded-lg">
            <h3 class="mt-3 text-lg text-gray-800">Spaghetti Carbonara</h3>
            <p class="text-sm text-gray-600">Learn to make authentic Italian spaghetti carbonara.</p>
            <a href="recipe2.pdf" download class="inline-block mt-3 py-2 px-4 bg-red-500 text-white rounded hover:bg-red-600">Download</a>
        </div>
    </div>

    <div class="culinary-tutorials flex-1 p-4">
        <h2 class="text-2xl text-gray-800 mb-4">Cooking Tutorials</h2>
        <div class="culinary-video mb-5">
            <video class="w-full rounded-lg" width="560" height="315" controls>
                <source src="video/vd1.mp4" type="video/mp4">
            </video>
            <h4 class="mt-2 text-sm text-gray-800">How to Dice an Onion</h4>
        </div>
        <div class="culinary-video mb-5">
            <video class="w-full rounded-lg" width="560" height="315" controls>
                <source src="video/vd3.mp4" type="video/mp4">
            </video>
            <h4 class="mt-2 text-sm text-gray-800">How to Dice an Onion</h4>
        </div>
        <div class="culinary-video mb-5">
            <iframe class="w-full rounded-lg" width="560" height="315" src="https://www.youtube.com/embed/0exWBGoe-3A?si=aSjbwFVscD5_lzoX" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            <h4 class="mt-2 text-sm text-gray-800">How to Dice an Onion</h4>
        </div>
    </div>
</section>

<?php include 'components/footer.php'; ?>

