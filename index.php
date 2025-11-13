<?php session_start(); 
  if(isset($_SESSION["logged_in"])){
    header("Location: campusmap.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="assets/css/styles.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

  <!-- Navbar -->
  <?php include 'includes/navbar.php'; ?>

  <!-- Hero Section -->
  <section class="container py-5">
    <div class="row align-items-center">
      <div class="col-md-6 text-center text-md-start">
        <h1>Study With Me</h1>
        <p class="lead mb-4">
          Connect. Collaborate. Study together — anywhere on campus.
        </p>
        <a href="createAccount.php" class="btn">Join Now</a>
        <a href="login.php" class="btn indexlogin">Log In</a>
      </div>

      <div class="col-md-6 text-center mt-4 mt-md-0">
            <img src="assets/img/FHTW_HeroSection.png" alt="FH Technikum Wien" class="img-fluid mx-auto d-block">
      </div>
    </div>
  </section>

  <!-- About Us -->
  <section class="container about-section py-5">
    <div class="row align-items-start">
      <div class="col-md-6">
        <h6 class="text-uppercase text-muted mb-2">Learn More</h6>
        <h3>About Us</h3>
        <p class="text-muted">
          StudyWithMe is a student-driven web application designed to make learning at the University of Applied Sciences Technikum Wien more social and connected. 
          By allowing students to check in to study rooms, share what they’re working on, and discover who’s studying nearby, we help turn individual studying 
          into a collaborative campus experience.
        </p>
      </div>
      <div class="col-md-6 text-center mt-4 mt-md-0">
          <img src="assets/img/RoomPage_HeroSection.png" alt="Room Page Demo" class="img-fluid mx-auto d-block">
      </div>
    </div>
  </section>

  <!-- Footer -->
  <?php include 'includes/footer.php'?>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>