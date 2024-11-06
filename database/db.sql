-- Table: user
CREATE TABLE user (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_fname VARCHAR(100) NOT NULL,
    user_lname VARCHAR(100) NOT NULL,
    user_password VARCHAR(255) NOT NULL,
    user_email VARCHAR(255) NOT NULL UNIQUE,
    user_phone VARCHAR(15),
    failed_attempts INT DEFAULT 0,
	lockout_until TIMESTAMP NULL DEFAULT NULL
);

-- Table: recipes
CREATE TABLE recipes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    recipe_name VARCHAR(255) NOT NULL,
    recipe_description TEXT,
    level INT,
    view_count BIGINT DEFAULT 0,
    created_at TIMESTAMP NOT NULL
);

-- Table: category
CREATE TABLE category (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL
);

-- Table: recipes_category
CREATE TABLE recipes_category (
    id INT PRIMARY KEY AUTO_INCREMENT,
    recipe_id INT NOT NULL,
    category_id INT NOT NULL
);

-- Table: recipes_content
CREATE TABLE recipes_content (
    id INT PRIMARY KEY AUTO_INCREMENT,
    recipe_id INT NOT NULL,
    type TINYINT(1) NOT NULL,  -- 1 for Ingredients, 2 for Directions
    content LONGTEXT NOT NULL
);

-- Table: recipes_media
CREATE TABLE recipes_media (
    id INT PRIMARY KEY AUTO_INCREMENT,
    recipe_id INT NOT NULL,
    type TINYINT(1) NOT NULL,  -- 1 for Cover, 0 for Default
    content LONGTEXT NOT NULL
);


INSERT INTO user (user_fname, user_lname, user_password, user_email, user_phone, failed_attempts, lockout_until)
VALUES
('John', 'Doe', 'password123', 'john.doe@example.com', '123-456-7890', 0, NULL),
('Jane', 'Smith', 'securePass456', 'jane.smith@example.com', '098-765-4321', 0, NULL),
('Alice', 'Johnson', 'myPass789', 'alice.johnson@example.com', '555-123-4567', 0, NULL);

-- Insert sample data into recipes table
INSERT INTO recipes (id, user_id, recipe_name, recipe_description, level, view_count, created_at)
VALUES 
(1, 1, 'Spaghetti Bolognese', 'Classic Italian pasta dish with rich meat sauce.', 2, 15, '2024-11-06 19:01:55'),
(2, 1, 'Chicken Curry', 'Spicy chicken curry with a blend of herbs and spices.', 3, 25, '2024-11-06 19:01:50'),
(3, 2, 'Vegetable Stir-fry', 'Healthy stir-fried vegetables with soy sauce.', 1, 10, '2024-11-06 19:01:45'),
(4, 3, 'Beef Tacos', 'Mexican-style beef tacos with fresh toppings.', 2, 35, '2024-11-06 19:01:40'),
(5, 2, 'Chocolate Cake', 'Decadent chocolate cake with rich frosting.', 4, 40, '2024-11-06 19:01:35'),
(6, 1, 'Chicken Alfredo', 'Creamy pasta with grilled chicken in a rich Alfredo sauce.', 2, 20, '2024-11-06 19:01:30'),
(7, 2, 'Caesar Salad', 'Classic Caesar salad with crisp romaine, Parmesan, and croutons.', 1, 18, '2024-11-06 19:01:25'),
(8, 3, 'Grilled Salmon', 'Juicy grilled salmon fillets with a lemon and herb seasoning.', 3, 22, '2024-11-06 19:01:20'),
(9, 4, 'Veggie Burger', 'Healthy homemade veggie burger patties made with black beans and vegetables.', 2, 30, '2024-11-06 19:01:15'),
(10, 5, 'Apple Pie', 'Classic homemade apple pie with a flaky crust and spiced apple filling.', 4, 50, '2024-11-06 19:01:10');

-- Insert categories into the category table
INSERT INTO category (name)
VALUES
('Italian'),
('Indian'),
('Asian'),
('Mexican'),
('Dessert'),
('Mediterranean'),
('French'),
('Japanese'),
('Mediterranean'),
('Middle Eastern');

INSERT INTO recipes_category (id, recipe_id, category_id)
VALUES 
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 5, 5),
(6, 6, 1),
(7, 7, 1),
(8, 8, 6),
(9, 9, 3),
(10, 10, 5);

INSERT INTO recipes_content (id, recipe_id, type, content) VALUES
(1, 1, 1, '1 lb ground beef\n1/2 c. onion, diced\n3 cloves garlic, minced\n1 can tomato sauce\n1 can diced tomatoes\n1 tsp. dried basil\n1 tsp. dried oregano\nSalt and pepper to taste\n1 lb spaghetti'),
(2, 1, 2, '1  In a large skillet, brown the ground beef over medium-high heat. Drain excess fat.\n\n2  Add onion and garlic, cooking until softened, about 3 minutes.\n\n3  Stir in tomato sauce, diced tomatoes, basil, oregano, salt, and pepper. Simmer on low for 15-20 minutes.\n\n4  Cook spaghetti according to package instructions. Serve sauce over spaghetti.'),

(3, 2, 1, '1 lb chicken breast, cut into cubes\n1 tbsp curry powder\n1 can coconut milk\n1/2 c. onion, diced\n2 cloves garlic, minced\n1 tbsp olive oil\nSalt and pepper to taste'),
(4, 2, 2, '1  Heat olive oil in a large pan over medium heat. Add onion and garlic, cooking until fragrant.\n\n2  Add chicken cubes and cook until browned.\n\n3  Stir in curry powder and coconut milk, season with salt and pepper. Bring to a simmer and cook until chicken is fully cooked, about 15 minutes.\n\n4  Serve hot with rice.'),

(5, 3, 1, '1 c. broccoli florets\n1 c. bell pepper, sliced\n1/2 c. carrots, sliced\n1/4 c. soy sauce\n1 tbsp sesame oil\n1 clove garlic, minced\n1/2 tsp ginger, minced'),
(6, 3, 2, '1  Heat sesame oil in a large pan over medium-high heat. Add garlic and ginger, cooking for 1 minute.\n\n2  Add broccoli, bell pepper, and carrots, stir-frying for 5-7 minutes until tender-crisp.\n\n3  Pour in soy sauce and stir to coat. Cook for an additional 2 minutes.\n\n4  Serve as a side dish or over rice.'),

(7, 4, 1, '1 lb ground beef\n1/2 c. onion, diced\n2 cloves garlic, minced\n1 tsp cumin\n1/2 tsp chili powder\nTaco shells\nLettuce, tomatoes, cheese, and sour cream for topping'),
(8, 4, 2, '1  Brown the ground beef with onion and garlic in a skillet over medium heat.\n\n2  Stir in cumin, chili powder, salt, and pepper. Cook for 5 minutes.\n\n3  Warm taco shells in the oven or microwave. Spoon beef mixture into shells and top with desired toppings.'),

(9, 5, 1, '1 and 1/2 c. flour\n1 c. sugar\n1/2 c. cocoa powder\n1 tsp baking soda\n1/2 tsp salt\n1 c. milk\n1/2 c. vegetable oil\n1 tsp vanilla extract\n1 tbsp vinegar'),
(10, 5, 2, '1  Preheat oven to 350°F. Grease an 8-inch round cake pan.\n\n2  In a large bowl, mix together flour, sugar, cocoa powder, baking soda, and salt.\n\n3  Add milk, vegetable oil, vanilla extract, and vinegar. Stir until smooth.\n\n4  Pour batter into prepared pan and bake for 30-35 minutes, or until a toothpick inserted into the center comes out clean.'),

(11, 6, 1, '1 lb fettuccine pasta\n2 tbsp butter\n2 cloves garlic, minced\n2 cups heavy cream\n1 cup Parmesan cheese, grated\n1 lb chicken breast, cooked and sliced\nSalt and pepper to taste'),
(12, 6, 2, '1  Cook fettuccine pasta according to package instructions. Drain and set aside.\n\n2  In a large pan, melt butter over medium heat. Add garlic and cook until fragrant.\n\n3  Pour in the heavy cream and bring to a simmer. Stir in Parmesan cheese and cook until the sauce thickens, about 5 minutes.\n\n4  Add cooked chicken and pasta to the pan, tossing to combine. Season with salt and pepper. Serve immediately.'),

(13, 7, 1, '1 head Romaine lettuce, chopped\n1/2 cup Caesar dressing\n1/4 cup Parmesan cheese, grated\n1 cup croutons'),
(14, 7, 2, '1  In a large bowl, toss together chopped Romaine lettuce, Caesar dressing, and Parmesan cheese.\n\n2  Add croutons and toss again.\n\n3  Serve immediately.'),

(15, 8, 1, '4 salmon fillets\n2 tbsp olive oil\n1 tbsp lemon juice\n1 tsp garlic powder\nSalt and pepper to taste'),
(16, 8, 2, '1  Preheat the grill to medium-high heat.\n\n2  Brush salmon fillets with olive oil and season with lemon juice, garlic powder, salt, and pepper.\n\n3  Grill the salmon for 4-5 minutes per side, or until fully cooked.\n\n4  Serve with your choice of sides.'),

(17, 9, 1, '1 can black beans, drained and mashed\n1/2 cup breadcrumbs\n1/4 cup grated carrot\n1/4 cup chopped onion\n1 tsp garlic powder\n1 tbsp olive oil\nBurger buns'),
(18, 9, 2, '1  In a bowl, combine mashed black beans, breadcrumbs, grated carrot, chopped onion, and garlic powder.\n\n2  Form the mixture into patties.\n\n3  Heat olive oil in a pan over medium heat and cook the patties for 4-5 minutes per side, until golden brown.\n\n4  Serve on burger buns with your favorite toppings.'),

(19, 10, 1, '4 cups apples, peeled and sliced\n1/2 cup sugar\n1 tbsp lemon juice\n1/2 tsp cinnamon\n1 tbsp butter\n1 package pie crust'),
(20, 10, 2, '1  Preheat oven to 375°F.\n\n2  In a large bowl, toss together apples, sugar, lemon juice, and cinnamon.\n\n3  Roll out pie crust and place in a pie dish. Fill with apple mixture and dot with butter.\n\n4  Top with the second pie crust, sealing the edges. Cut slits in the top crust.\n\n5  Bake for 45-50 minutes, until crust is golden brown.');
