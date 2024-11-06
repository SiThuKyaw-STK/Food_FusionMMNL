<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Food Fusion</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/main.js" defer></script>
</head>
<body>
  <!-- Header Section -->
  <header class="header">
        <div class="container">
            <div class="logo">
                <h1>FoodFusion</h1>
            </div>
            <nav class="navbar">
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="recipe-collection.php">Recipe Collection</a></li>
                    <li><a href="#community">Community Cookbook</a></li>
                    <li><a href="#resources">Resources</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
                </ul>
            </nav>
            <div class="join-us">
                <button onclick="showJoinUsPopup()">Join Us</button>
            </div>
        </div>
    </header>

    <div class="contact-container">
        <h1>Contact Us</h1>
        <form id="contactForm" method="post" action="process_contact.php">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" id="subject" name="subject" required>
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message" name="message" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn">Send Message</button>
        </form>
    </div>
</body>
</html>
