<?php
include 'db.php';
include 'components/header.php';

?>
   <div class="max-w-lg mx-auto p-5 bg-gray-100 rounded-lg shadow-md">
    <h1 class="text-center text-orange-600 mb-5">Contact Us</h1>
    <form id="contactForm" method="post" action="process_contact.php">
        <div class="mb-4">
            <label for="name" class="block font-semibold mb-2">Name</label>
            <input type="text" id="name" name="name" required class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:outline-none">
        </div>
        <div class="mb-4">
            <label for="email" class="block font-semibold mb-2">Email</label>
            <input type="email" id="email" name="email" required class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:outline-none">
        </div>
        <div class="mb-4">
            <label for="subject" class="block font-semibold mb-2">Subject</label>
            <input type="text" id="subject" name="subject" required class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:outline-none">
        </div>
        <div class="mb-4">
            <label for="message" class="block font-semibold mb-2">Message</label>
            <textarea id="message" name="message" rows="5" required class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:outline-none resize-y"></textarea>
        </div>
        <button type="submit" class="w-full py-2 bg-orange-600 text-white rounded-md hover:bg-orange-500 focus:outline-none">Send Message</button>
    </form>
</div>

<?php include 'components/footer.php'; ?>
