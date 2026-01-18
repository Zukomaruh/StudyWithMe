<?php session_start(); 
      $email = '';
      if(isset($_COOKIE['remember_user'])){
        $email = $_COOKIE['remember_user'];
      }
?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login to Account</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

  <!-- Optional Custom Stylesheet -->
  <link href="assets/css/styles.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

  <!-- Header -->
  <?php include 'includes/navbar.php'?>

  <!-- Main Login Content -->
  <main class="container d-flex flex-column align-items-center justify-content-center flex-grow-1 py-5">
    <div class="w-100" style="max-width:400px;">
      <h1 class="text-center">Login to Account</h1>
      <p class="text-center mb-4">
        Don’t have an Account?
        <a href="createAccount.php" class="login-link">Register</a>
      </p>

      <form method="post" action="logic/logindata.php">
        <!-- Email -->
        <div class="mb-3">
          <label for="email" class="form-label text-uppercase small fw-semibold">FHTW-E-Mail</label>
          <input type="email" id="email" name="email" class="form-control" placeholder="enter your email..." value ="<?php echo htmlspecialchars($email) ?>"  required>
        </div>

        <!-- Password -->
        <div class="mb-3">
          <label for="password" class="form-label text-uppercase small fw-semibold">Password</label>
          <input type="password" id="password" name="password" class="form-control" placeholder="enter your password..." required>
        </div>

        <!-- Remember Me -->
        <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" id="rememberMe" name="rememberMe" <?php echo isset($_COOKIE['remember_user']) ? 'checked' : ''; ?>>
          <label class="form-check-label small" for="rememberMe">remember me</label>
        </div>

        <?php if(isset($_SESSION["error"])): ?>
        <div class="text-center mb-4">
          <p style='color:red'><?php echo $_SESSION["error"] ?></p>
        </div>
        <?php endif; ?>
        <!-- Submit Button -->
        <button type="submit" class="btn w-100">LOGIN</button>
      </form>
    </div>
  </main>

  <!-- Footer -->
  <?php include 'includes/footer.php'?>

  <?php unset($_SESSION["error"]) ?>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>