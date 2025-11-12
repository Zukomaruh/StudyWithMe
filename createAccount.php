<?php session_start(); ?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Create new Account</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

  <!-- Optional Custom Stylesheet -->
   <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body class="d-flex flex-column min-vh-100">

  <!-- Navbar -->
 <?php include 'includes/navbar.php'?>

  <!-- Main Content -->
  <main class="container d-flex flex-column align-items-center justify-content-center flex-grow-1 py-5">
    <h1>Create new Account</h1>
    <p>
      Already got an Account? 
      <a href="login.php" class="login-link">Login</a>
    </p>

    <form method="post" action="logic/registrationdata.php">
      <!-- Name -->
      <div>
        <label for="name" class="form-label text-uppercase small fw-semibold">Name</label>
        <input type="text" id="name" name="name" class="form-control" placeholder="enter your name..." required>
      </div>

      <!-- Email -->
      <div class="mb-3">
        <label for="email" class="form-label text-uppercase small fw-semibold">FHTW-E-Mail</label>
        <input type="email" id="email" name="email" class="form-control" placeholder="enter your email..." required>
      </div>

      <!-- Password -->
      <div class="mb-3">
        <label for="password" class="form-label text-uppercase small fw-semibold">Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="enter a secure password..." required>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label text-uppercase small fw-semibold">Confirm Password</label>
        <input type="password" id="password" name="passwordConfirm" class="form-control" placeholder="re-enter password..." required>
      </div>

      <!-- Course -->
      <div class="mb-3">
        <label for="course" class="form-label text-uppercase small fw-semibold">Course of Study</label>
        <select id="course" name="course" class="form-select" required>
          <option value="">Select</option>
          <option value="informatics">Informatics</option>
          <option value="engineering">Engineering</option>
          <option value="media">Media Technology</option>
        </select>
      </div>

      <!-- Privacy Checkbox -->
      <div class="form-check mb-4">
        <input type="checkbox" id="privacy" name="privacy" class="form-check-input" required>
        <label for="privacy" class="form-check-label">
          I agree to the <a href="privacystatement.php" class="privacy-link">Privacy Statement</a>
        </label>
      </div>

      <?php if(isset($_SESSION["error"])): ?>
        <div class="text-center mb-4">
          <p style='color:red'><?php echo $_SESSION["error"] ?></p>
        </div>
      <?php endif; ?>

      <!-- Submit Button -->
      <button type="submit" class="btn w-100">REGISTER</button>
    </form>
  </main>

  <!-- Footer -->
  <?php include 'includes/footer.php'?>

  <?php unset($_SESSION["error"]) ?>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>