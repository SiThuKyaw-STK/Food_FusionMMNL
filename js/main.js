// Function to show the Join Us Pop-Up
function showJoinUsPopup() {
  document.getElementById("joinUsPopup").style.display = "flex";
}

// Function to close the Join Us Pop-Up
function closeJoinUsPopup() {
  document.getElementById("joinUsPopup").style.display = "none";
}

// Close popup if user clicks outside the form
window.onclick = function(event) {
  const popup = document.getElementById("joinUsPopup");
  if (event.target === popup) {
      popup.style.display = "none";
  }
}



// Display cookie consent if not already accepted
window.onload = function() {
  if (!localStorage.getItem('cookieAccepted')) {
      document.getElementById('cookieConsent').style.display = 'block';
  }
};

// Accept cookie function
function acceptCookies() {
  localStorage.setItem('cookieAccepted', 'true');
  document.getElementById('cookieConsent').style.display = 'none';
}

document.getElementById("filter-form").addEventListener("submit", function(event) {
  event.preventDefault(); // Prevent the form from submitting normally
  const cuisine = document.getElementById("cuisine").value;
  const dietaryPreference = document.getElementById("dietaryPreference").value;
  const cookDifficulty = document.getElementById("cookDifficulty").value;
  const page = 1; // Start from the first page for new filters

  // Make AJAX request
  fetch("fetch_recipes.php", {
      method: "POST",
      headers: {
          "Content-Type": "application/x-www-form-urlencoded"
      },
      body: new URLSearchParams({
          cuisine: cuisine,
          dietaryPreference: dietaryPreference,
          cookDifficulty: cookDifficulty,
          page: page
      })
  })
  .then(response => {
      if (!response.ok) {
          throw new Error("Network response was not ok");
      }
      return response.json(); // Expecting a JSON response
  })
  .then(data => {
      document.getElementById("recipes-container").innerHTML = data.recipesHTML;
      document.getElementById("pagination").innerHTML = data.paginationHTML;
  })
  .catch(error => {
      console.error("There was a problem with the fetch operation:", error);
  });
});




