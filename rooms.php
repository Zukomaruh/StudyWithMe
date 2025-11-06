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

// funktioniert nur wenn wir Raumselection als Formular machen (zB Dropdown oä):
$selectedFloor = $_POST['floor'] ?? 0; 
?>
<div class="container-fluid text-center py-4">
  <div class="row g-4">
    <!-- Jede col nimmt auf kleinen Displays 12 Spalten (volle Breite), 
         und ab mittleren Displays 6 Spalten (also 2 nebeneinander) -->
    <div class="col-12 col-md-6">
      <div class="p-3 bg-light border h-100">
        <img
        src="assets/img/FloorPlans/<?php echo $currentBuilding.$selectedFloor; ?>.png"
        alt="Floor Plan"
        class="img-fluid mx-auto d-block"
        style="max-width: 100%; height: auto;"
      />
      </div>
    </div>
    <div class="col-12 col-md-6">
      <div class="p-3 bg-light border h-100">
        <h3>Room Information</h3>
        <?php if (empty($selectedRoom)) : ?>
          <p>please pick a room...</p>
        <?php endif; ?>
      </div>
    </div>
    <div class="col-12 col-md-6">
      <div class="p-3 bg-light border h-100"><div class="d-flex flex-column align-items-center">
        <h5 class="mb-3">Pick a floor</h5>
        <div class="d-flex bg-success text-white rounded-pill p-1">
        <!--Muss noch angepasst werden mit php dass je nach Building andere Floors gezeigt werden sonst hauts hin-->
            <form method="post">
                <button type="submit" name="floor" value="0" class="btn btn-success rounded-pill mx-1">UG</button>
                <button type="submit" name="floor" value="1" class="btn btn-success rounded-pill mx-1">1</button>
                <button type="submit" name="floor" value="2" class="btn btn-success rounded-pill mx-1">2</button>
                <button type="submit" name="floor" value="3" class="btn btn-success rounded-pill mx-1">3</button>
                <button type="submit" name="floor" value="4" class="btn btn-success rounded-pill mx-1">4</button>
                <button type="submit" name="floor" value="5" class="btn btn-success rounded-pill mx-1">5</button>
                <button type="submit" name="floor" value="6" class="btn btn-success rounded-pill mx-1">6</button>
            </form>
            <?php // echo $selectedFloor; ?>
        </div>
    </div></div>
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