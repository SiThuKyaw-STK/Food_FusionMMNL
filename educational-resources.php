<?php
include 'components/header.php';

?>
<h1 id="edu-header" class="text-center mt-6 mb-5 text-orange-600 py-2 px-4">
    Educational Resources
</h1>
<section class="educational_resources max-w-7xl mx-auto p-5">
    <div class="renewable-energy p-5 bg-white rounded-lg mb-6">
        <h2 class="text-xl text-orange-600 mb-3">Renewable Energy Content</h2>
        <p class="text-gray-600">Explore informative resources, infographics, and videos about renewable energy sources.</p>

        <div class="infographics grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 mt-5">
            <div class="infographic-card bg-white border border-gray-300 rounded-lg p-4 text-center">
                <img src="images/solarplant.jpg" alt="Solar Energy Infographic" class="w-full rounded-lg">
                <h4 class="mt-3 text-orange-600 text-lg">Solar Energy</h4>
                <a href="solar-infographic.jpg" download class="inline-block mt-3 py-2 px-4 bg-orange-600 text-white rounded hover:bg-orange-700">Download</a>
            </div>
            <div class="infographic-card bg-white border border-gray-300 rounded-lg p-4 text-center">
                <img src="images/windenergy.jpg" alt="Wind Energy Infographic" class="w-full rounded-lg">
                <h4 class="mt-3 text-orange-600 text-lg">Wind Energy</h4>
                <a href="wind-infographic.jpg" download class="inline-block mt-3 py-2 px-4 bg-orange-600 text-white rounded hover:bg-orange-700">Download</a>
            </div>
            <div class="infographic-card bg-white border border-gray-300 rounded-lg p-4 text-center">
                <img src="images/windenergy.jpg" alt="Wind Energy Infographic" class="w-full rounded-lg">
                <h4 class="mt-3 text-orange-600 text-lg">Wind Energy</h4>
                <a href="wind-infographic.jpg" download class="inline-block mt-3 py-2 px-4 bg-orange-600 text-white rounded hover:bg-orange-700">Download</a>
            </div>
        </div>

        <div class="educational_videos mt-6">
            <h3 class="text-xl text-orange-600 mb-4">Videos</h3>
            <div class="edu_video mb-5">
                <video class="w-full rounded-lg" width="560" height="315" controls>
                    <source src="video/vd11.mp4" type="video/mp4">
                </video>
                <h4 class="mt-2 text-sm text-gray-800">Understanding Solar Power</h4>
            </div>
            <div class="edu_video mb-5">
                <video class="w-full rounded-lg" width="560" height="315" controls>
                    <source src="video/vd11.mp4" type="video/mp4">
                </video>
                <h4 class="mt-2 text-sm text-gray-800">Understanding Solar Power</h4>
            </div>
        </div>
    </div>

    <div class="edu_downloads p-5 bg-white rounded-lg">
        <h2 class="text-xl text-orange-600 mb-3">Downloadable Files</h2>
        <p class="text-gray-600">Download PDF guides and more about renewable energy.</p>
        <ul class="download-list mt-4">
            <li class="mb-3">
                <a href="renewable-guide.pdf" download class="text-orange-600 text-lg font-bold hover:underline">Renewable Energy Guide (PDF)</a>
            </li>
            <li class="mb-3">
                <a href="solar-energy.pdf" download class="text-orange-600 text-lg font-bold hover:underline">Introduction to Solar Energy (PDF)</a>
            </li>
            <li>
                <a href="wind-energy.pdf" download class="text-orange-600 text-lg font-bold hover:underline">Wind Energy Overview (PDF)</a>
            </li>
        </ul>
    </div>
</section>

<?php include 'components/footer.php'; ?>

