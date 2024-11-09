<?php
include 'db.php';
include 'components/header.php';

?>

<div class="login-container bg-white rounded-xl shadow-2xl overflow-hidden max-w-sm w-full p-8 animate-fadeIn mx-auto border-2">
  <div class="login-form">
    <h2 class="text-center text-gray-800 mb-2 text-2xl">Welcome Back</h2>
    <p class="text-center text-gray-600 mb-6">Please log in to continue</p>
    <form id="login_form" action="login.php" method="POST">
      <div class="input-group mb-4">
        <label for="email" class="block text-sm text-gray-500 mb-1">Email</label>
        <input type="email" id="email" name="email" required placeholder="Enter your email" class="w-full p-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:outline-none" />
        <span class="input-error text-red-500 text-xs mt-1 block h-4" id="emailError"></span>
      </div>
      <div class="input-group mb-4">
        <label for="password" class="block text-sm text-gray-500 mb-1">Password</label>
        <input type="password" id="password" name="password" required placeholder="Enter your password" class="w-full p-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:outline-none" />
        <span class="input-error text-red-500 text-xs mt-1 block h-4" id="passwordError"></span>
      </div>
      <button type="submit" class="w-full bg-gradient-to-r from-indigo-500 to-purple-500 text-white font-bold py-3 rounded-lg cursor-pointer transition duration-300 mt-2 hover:bg-gradient-to-r hover:from-indigo-400 hover:to-purple-400">
        Login
      </button>
      <p class="forgot-password text-center mt-3 text-sm">
        <a href="#" class="text-indigo-500 hover:underline">Forgot Password?</a> 
        <a href="#" class="ml-2 text-indigo-500 hover:underline">Register</a>
      </p>
    </form>
  </div>
</div>

<?php include 'components/footer.php'; ?>

