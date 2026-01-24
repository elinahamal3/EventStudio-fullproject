<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login | Event Studio</title>
  <link rel="stylesheet" href="style.css" />
</head>

<body class="signup-body">
  <div class="signup-container">
    <h2>Login</h2>

    <form action="backend/login.php
    <?php echo isset($_GET['redirect']) ? '?redirect=' . $_GET['redirect'] : ''; ?>"
     method="POST">
      <input type="email" name="email" placeholder="Email Address" required />
      <input type="password" name="password" placeholder="Password" required />

      <button type="submit" class="btn">Login</button>

      <p class="login-link">
        Don’t have an account?
        <a href="signup.php">Create one</a>
      </p>
    </form>
  </div>
</body>
</html>
