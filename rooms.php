<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'includes/head.php'?>
    <title>Floor plan</title>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php include 'includes/navbar.php'?>
    <!--Get current Building-->
    <?php
        $currentBuilding = isset($_GET['building']) ? $_GET['building'] : null;
        echo $currentBuilding;
    ?>

    <?php include 'includes/footer.php'?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>