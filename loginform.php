<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="login-container">
    <div class="login-form">
      <h2>Welcome Back</h2>
      <p>Please log in to continue</p>
      <form id="loginForm" action="login.php" method="POST">
        <div class="input-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" required placeholder="Enter your email">
          <span class="input-error" id="emailError"></span>
        </div>
        <div class="input-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" required placeholder="Enter your password">
          <span class="input-error" id="passwordError"></span>
        </div>
        <button type="submit" class="login-button">Login</button>
        <p class="forgot-password"><a href="#">Forgot Password?</a> <a href="#">Register</a></p>
      </form>
    </div>
  </div>

  <!--  JavaScript validation -->
  <script>
    document.getElementById('loginForm').addEventListener('submit', function(event) {
      const email = document.getElementById('email');
      const password = document.getElementById('password');
      const emailError = document.getElementById('emailError');
      const passwordError = document.getElementById('passwordError');
      let valid = true;

      //  email validation
      if (!email.value.includes('@') || email.value.length < 5) {
        emailError.textContent = "Please enter a valid email.";
        valid = false;
      } else {
        emailError.textContent = '';
      }

      //  password validation
      if (password.value.length < 6) {
        passwordError.textContent = "Password must be at least 6 characters.";
        valid = false;
      } else {
        passwordError.textContent = '';
      }

      if (!valid) {
        event.preventDefault();
      }
    });
  </script>
</body>
</html>
