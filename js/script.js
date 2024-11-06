function fetchRecipes() {
  const cuisine = document.getElementById('cuisineFilter').value;
  const dietary = document.getElementById('dietaryFilter').value;
  const difficulty = document.getElementById('difficultyFilter').value;

  const xhr = new XMLHttpRequest();
  xhr.open('GET', `fetch_recipes.php?cuisine=${cuisine}&dietary=${dietary}&difficulty=${difficulty}`, true);
  xhr.onload = function() {
      if (xhr.status === 200) {
          document.getElementById('recipeContainer').innerHTML = xhr.responseText;
      }
  };
  xhr.send();
}

// Load all recipes on initial page load
window.onload = fetchRecipes;
