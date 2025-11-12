<?php session_start(); ?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Campus Map</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

  <!-- Optional Custom Stylesheet -->
   <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body class="d-flex flex-column min-vh-100">
  <!-- Navbar -->
  <?php include 'includes/navbar.php'?>

  <!-- Main -->
  <main class="container d-flex flex-column align-items-center justify-content-center flex-grow-1 py-5">
    <h1 class="mb-4 text-center">Choose a Building</h1>

    <div class="text-center w-100">
      <img
        src="assets/img/FHTW_Building_grafic_edited.png"
        alt="FHTW Building Graphic"
        class="img-fluid mx-auto d-block"
        style="max-width: 100%; height: auto;"
      />
    </div>

    <form class="d-flex flex-wrap justify-content-center gap-3 mt-4">
      <a href="rooms.php?building=B" class="btn btn-outline-success px-4 campusmapbtn">B-Building</a>
      <a href="rooms.php?building=A" class="btn btn-outline-success px-4 campusmapbtn">A-Building</a>
      <a href="rooms.php?building=F" class="btn btn-outline-success px-4 campusmapbtn">F-Building</a>
    </form>
  </main>

  <!-- Footer -->
    <?php include 'includes/footer.php'?>
  
  <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  </body>
</html>