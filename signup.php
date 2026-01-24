<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Signup | Event Studio</title>
  <link rel="stylesheet" href="style.css" />
</head>

<body class="signup-body">
  <div class="signup-container">
    <h2>Create Account</h2>

    <form action="backend/signup.php 
    <?php echo isset($_GET['redirect']) ? '?redirect=' . $_GET['redirect'] : ''; ?>"
    method="POST">
      <input type="text" name="name" placeholder="Full Name" required />
      <input type="email" name="email" placeholder="Email Address" required />
      <input type="password" name="password" placeholder="Password" required />

      <button type="submit" class="btn">Sign Up</button>

      <p class="login-link">
        Already have an account?
        <a href="login.php<?php echo isset($_GET['redirect']) ? '?redirect=' . $_GET['redirect'] : ''; ?>">Login</a>

      </p>
    </form>
  </div>
</body>
</html>
