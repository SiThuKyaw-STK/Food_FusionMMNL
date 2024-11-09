<?php
// Start output buffering to capture dynamic content
include 'db.php';
include 'components/header.php';


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$isUserLoggedIn = $_SESSION['user'];
$userId = $isUserLoggedIn['id'];

if (!$userId) {
    echo "<script>
        location.href = 'please-login-first.php';
    </script>";
    exit; // Stop further execution if redirecting
}

// Fetch categories
$sql = "SELECT id, name FROM category";
$categories = $conn->query($sql);

$categoryOptions = '';
if ($categories->num_rows > 0) {
    while ($row = $categories->fetch_assoc()) {
        $categoryOptions .= "<option value='{$row['id']}'>{$row['name']}</option>";
    }
} else {
    $categoryOptions = "<option disabled>No categories available</option>";
}

?>

<!-- Community Page Content Here -->
<div class="mx-auto w-full max-w-7xl">
    <div>
        <div class="bg-white p-8 rounded-lg shadow-2xl">
            <h2 class="text-2xl font-bold text-center mb-6">Create a New Recipe</h2>
            <form id="recipeForm" enctype="multipart/form-data" class="space-y-4">
                <div class="">
                    <div class="grid gap-8">
                        <!-- Recipe Name -->
                        <div>
                            <label for="recipe_name" class="block text-sm font-medium text-gray-700">Recipe Name</label>
                            <input type="text" id="recipe_name" name="recipe_name" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                        </div>

                        <!-- Image Upload -->
                        <div>
                            <label for="images" class="block text-sm font-medium text-gray-700">Recipe Image</label>
                            <input type="file" id="images" name="images[]" accept="image/*" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md" multiple>
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea id="description" name="description" rows="3" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md"></textarea>
                        </div>

                        <!-- Level -->
                        <div>
                            <label for="level" class="block text-sm font-medium text-gray-700">Difficulty Level</label>
                            <select id="level" name="level" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                                <option value="1">Easy</option>
                                <option value="2">Medium</option>
                                <option value="3">Hard</option>
                            </select>
                        </div>

                        <!-- Category -->
                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                            <select id="category" name="category[]" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md" multiple>
                                <?= $categoryOptions ?>
                            </select>
                        </div>
                    </div>

                    <!-- Recipe Content -->
                   <div class="mt-8 grid gap-8">
                        <div id="ingredients" class="ingredients">
                            <label class="block text-sm font-medium text-gray-700">Ingredients</label>
                            <div id="ingredients_editor">
                                <p>Hello World!</p>
                                <p>Some initial <strong>bold</strong> text</p>
                                <p><br /></p>
                            </div>
                        </div>

                        <div id="directions" class="directions">
                            <label class="block text-sm font-medium text-gray-700">Direction</label>
                            <div id="directions_editor">
                                <p>Hello World!</p>
                                <p>Some initial <strong>bold</strong> text</p>
                                <p><br /></p>
                            </div>
                        </div>
                   </div>

                </div>
                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="w-full bg-blue-600 text-white font-semibold py-2 rounded-md hover:bg-blue-700">Submit Recipe</button>
                </div>
            </form>
            <div id="message" class="text-center mt-4"></div>
        </div>
    </div>
</div>

<script>
    const toolbarOptions = [
    ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
    ['blockquote', 'code-block'],

    // [{ 'header': 1 }, { 'header': 2 }],               // custom button values
    [{ 'list': 'ordered'}, { 'list': 'bullet' }, { 'list': 'check' }],
    // [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
    // [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
    // [{ 'direction': 'rtl' }],                         // text direction

    [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown

    [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
    // [{ 'font': [] }],
    // [{ 'align': [] }],

    // ['clean']                                         // remove formatting button
    ];

    const quillIngerdients = new Quill('#ingredients_editor', {
        modules: {
            toolbar: toolbarOptions
        },
        theme: 'snow'
    });

    const quillDirection = new Quill('#directions_editor', {
        modules: {
            toolbar: toolbarOptions
        },
        theme: 'snow'
    });


    $('#recipeForm').on('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission

        // Create FormData object to handle file and text data
        const formData = new FormData(this);

        // Get ingredients and directions content from Quill editors
        const ingredientsContent = quillIngerdients.root.innerHTML;
        const directionsContent = quillDirection.root.innerHTML;

        // Append Quill content to FormData
        formData.append('ingredients', ingredientsContent);
        formData.append('directions', directionsContent);

        $.ajax({
            url: 'create_recipe.php', // Your PHP script URL
            type: 'POST',
            data: formData,
            processData: false, // Required for FormData
            contentType: false, // Required for FormData
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    $('#message').html(`
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Success!</strong>
                            <span class="block sm:inline">${response.success}</span>
                            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <title>Close</title>
                                    <path d="M14.348 5.652a1 1 0 010 1.414L11.414 10l2.934 2.934a1 1 0 01-1.414 1.414L10 11.414l-2.934 2.934a1 1 0 01-1.414-1.414L8.586 10 5.652 7.066a1 1 0 011.414-1.414L10 8.586l2.934-2.934a1 1 0 011.414 0z"/>
                                </svg>
                            </span>
                        </div>
                    `);
                    $('#recipeForm')[0].reset(); // Clear the form
                    quillIngerdients.root.innerHTML = ''; // Clear the Quill editors
                    quillDirection.root.innerHTML = '';
                } else if (response.error) {
                    $('#message').html(`<p class="text-red-500">${response.error}</p>`);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#message').html(`<p class="text-red-500">An error occurred: ${textStatus}</p>`);
            }
        });
    });

    $(document).on('click', '[role="alert"] .h-6.w-6', function () {
        $(this).closest('[role="alert"]').remove();
    });

</script>
<?php

// Include the main layout, passing in the dynamic content
include 'components/footer.php';
?>
