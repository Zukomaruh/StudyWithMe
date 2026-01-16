<?php session_start();
require_once "logic/functions.php";
require_once "logic/database/dbaccess.php";
closeExpiredStudySessions($db_obj);
if(!empty($_SESSION['logged_in'])){
  checkRunningSession($db_obj, $_SESSION['user_id']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'includes/head.php' ?>
    <title>Profile</title>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php include 'includes/navbar.php' ?>
    <main class="container py-5 flex-grow-1">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
        <h1 class="fw-bold mb-4">Your Profile</h1>

        <!-- Profile Picture -->
        <div class="mb-4">
            <img src="assets/img/defaultpp.jpg" alt="Profile Picture" class="rounded-circle mb-3 img-fluid" style="max-width: 150px;">
            <div>
            <label for="profilePicture" class="form-label fw-semibold">Change Profile Picture</label>
            <input type="file" id="profilePicture" name="profilePicture" class="form-control">
            </div>
        </div>

        <!-- Profile Form -->
        <form method="post" action="#" enctype="multipart/form-data" class="text-start">
            <!-- Name -->
            <div class="mb-3">
            <label for="name" class="form-label text-uppercase small fw-semibold">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="Julian Rainer">
            </div>

            <!-- Email -->
            <div class="mb-3">
            <label for="email" class="form-label text-uppercase small fw-semibold">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="wi24b045@technikum-wien.at" readonly>
            <small class="text-muted">Your email cannot be changed.</small>
            </div>

            <!-- Course -->
            <div class="mb-4">
            <label for="course" class="form-label text-uppercase small fw-semibold">Course of Study</label>
            <select id="course" name="course" class="form-select">
                <option value="">Select</option>
                <option value="informatics" selected>Informatics</option>
                <option value="engineering">Engineering</option>
                <option value="media">Media Technology</option>
            </select>
            </div>

            <!-- Save Button -->
            <div class="d-grid">
            <button type="submit" class="btn fw-semibold">Save Changes</button>
            </div>
        </form>
        </div>
    </div>
    </main>
    <?php include 'includes/footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>