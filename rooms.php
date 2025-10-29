<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'includes/head.php'?>
    <title>Floor plan</title>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php include 'includes/navbar.php'; ?> 
<?php
// Gebäude aus URL-Parameter lesen (Standard: F)
$currentBuilding = isset($_GET['building']) ? strtoupper($_GET['building']) : 'F';
?>
<div class="container-fluid text-center py-4">
  <div class="row g-4">
    <!-- Jede col nimmt auf kleinen Displays 12 Spalten (volle Breite), 
         und ab mittleren Displays 6 Spalten (also 2 nebeneinander) -->
    <div class="col-12 col-md-6">
      <div class="p-3 bg-light border h-100">Image Raumplan</div>
    </div>
    <div class="col-12 col-md-6">
      <div class="p-3 bg-light border h-100">Room Information</div>
    </div>
    <div class="col-12 col-md-6">
      <div class="p-3 bg-light border h-100">Choose Floor</div>
    </div>
    <div class="col-12 col-md-6">
      <div class="p-3 bg-light border h-100">Choose Room</div>
    </div>
  </div>
</div>
<?php include 'includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>