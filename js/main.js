$(document).ready(function() {
  $("#join_us").click(function(){
    $("#joinUsPopup").show();
  })


  $("#close_btn").click(function(){
    $("#joinUsPopup").hide()
  })

  

  // register form
  $("#register_form").on("submit", function(e) {
    e.preventDefault();

    var formData = $(this).serialize();

    $.ajax({
        type: "POST",
        url: "./register.php",
        data: formData,
        success: function(response) {
            // Assuming response is a JSON object with a 'status' key
            var result = JSON.parse(response);
            console.log(result.success);
                        
            
            if (result.success === true) {
                window.location.href = "./loginform.php"
            } else {
                console.log("some error");
            }
        },
        error: function() {
            alert("There was an error with the registration. Please try again.");
        }
    });
  });

  // login form
  $("#login_form").on("submit", function(e) {
    e.preventDefault();

    var formData = $(this).serialize();
    console.log("test");
    

    $.ajax({
        type: "POST",
        url: "login.php",
        data: formData,
        success: function(response) {
            // Assuming response is a JSON object with a 'status' key
            var result = JSON.parse(response);                

            if (result.success === true) {
                $("#login_modal").addClass("hidden");
                alert("Login successful! Redirecting to your community...");
                window.location.href = "community-cookbook.php";
            } else {
                alert(result.message);
            }
        },
        error: function() {
            alert("There was an error logging in. Please try again.");
        }
    });
  });
});
