<?php session_start();
require_once "logic/functions.php";
require_once "logic/database/dbaccess.php";
redirectIllegalSiteVisit();
closeExpiredStudySessions($db_obj);
if(!empty($_SESSION['logged_in'])){
  checkRunningSession($db_obj, $_SESSION['user_id']);
  $user_data = getUSerData($db_obj, $_SESSION['user_id']);
}else{
    header("Location: index.php");
    exit;
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
        <img
            src="<?= htmlspecialchars(getUserProfilePic($db_obj)) ?>"
            alt="Profile Picture"
            class="rounded-circle mb-3 img-fluid"
            style="max-width: 150px;"
        >
    </div>

        <!-- Profile Form -->
        <form method="post" action="logic/profiledatachanges.php" enctype="multipart/form-data" class="text-start">
            
            <!--Profile Picture-->
            <div class="mb-3">
            <label for="profilePicture" class="form-label fw-semibold">Change Profile Picture</label>
            <input type="file" id="profilePicture" name="profilePicture"
             accept="image/jpeg, image/png, image/jpg"
             class="form-control">
            </div>
            <?php if(isset($_SESSION["error"])): ?>
            <div class="text-center mb-4">
            <p style='color:red'><?php echo $_SESSION["error"] ?></p>
            </div>
            <?php endif; ?>
            <?php unset($_SESSION["error"]) ?>            
            <!-- Name -->
            <div class="mb-3">
            <label for="name" class="form-label text-uppercase small fw-semibold">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($user_data['name']); ?>">
            </div>

            <!-- Email -->
            <div class="mb-3">
            <label for="email" class="form-label text-uppercase small fw-semibold">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user_data['email']); ?>" readonly>
            <small class="text-muted">Your email cannot be changed.</small>
            </div>

            <!-- Course -->
            <div class="mb-4">
            <label for="course" class="form-label text-uppercase small fw-semibold">Course of Study</label>
            <select id="course" name="course" class="form-select">
                <option value="" <?= ($user_data['course'] === '') ? 'selected' : '' ?>>Select</option>
                <option value="Biomedical Engineering" <?= ($user_data['course'] === 'Biomedical Engineering') ? 'selected' : '' ?>>Biomedical Engineering</option>
                <option value="Elektronik Embedded & Cyber Physical Systems" <?= ($user_data['course'] === 'Elektronik Embedded & Cyber Physical Systems') ? 'selected' : '' ?>>Elektronik Embedded & Cyber Physical Systems</option>
                <option value="Elektronik Power Electronics & Nachhaltige Energietechnik" <?= ($user_data['course'] === 'Elektronik Power Electronics & Nachhaltige Energietechnik') ? 'selected' : '' ?>>Elektronik Power Electronics & Nachhaltige Energietechnik</option>
                <option value="Elektronik Wirtschaft & Entrepreneurship" <?= ($user_data['course'] === 'Elektronik Wirtschaft & Entrepreneurship') ? 'selected' : '' ?>>Elektronik Wirtschaft & Entrepreneurship</option>
                <option value="Elektronik IoT & Smart Infrastructure" <?= ($user_data['course'] === 'Elektronik IoT & Smart Infrastructure') ? 'selected' : '' ?>>Elektronik IoT & Smart Infrastructure</option>
                <option value="Erneuerbare Energien" <?= ($user_data['course'] === 'Erneuerbare Energien') ? 'selected' : '' ?>>Erneuerbare Energien</option>
                <option value="Human Factors and Sports Engineering" <?= ($user_data['course'] === 'Human Factors and Sports Engineering') ? 'selected' : '' ?>>Human Factors and Sports Engineering</option>
                <option value="Informatik" <?= ($user_data['course'] === 'Informatik') ? 'selected' : '' ?>>Informatik</option>
                <option value="Informations- und Kommunikationssysteme" <?= ($user_data['course'] === 'Informations- und Kommunikationssysteme') ? 'selected' : '' ?>>Informations- und Kommunikationssysteme</option>
                <option value="Internationales Wirtschaftsingenieurwesen" <?= ($user_data['course'] === 'Internationales Wirtschaftsingenieurwesen') ? 'selected' : '' ?>>Internationales Wirtschaftsingenieurwesen</option>
                <option value="Maschinenbau" <?= ($user_data['course'] === 'Maschinenbau') ? 'selected' : '' ?>>Maschinenbau</option>
                <option value="Mechatronik und Robotik" <?= ($user_data['course'] === 'Mechatronik und Robotik') ? 'selected' : '' ?>>Mechatronik und Robotik</option>
                <option value="Nachhaltige Umwelt- und Bioprozesstechnik" <?= ($user_data['course'] === 'Nachhaltige Umwelt- und Bioprozesstechnik') ? 'selected' : '' ?>>Nachhaltige Umwelt- und Bioprozesstechnik</option>
                <option value="Wasserstofftechnik" <?= ($user_data['course'] === 'Wasserstofftechnik') ? 'selected' : '' ?>>Wasserstofftechnik</option>
                <option value="Wirtschaftsinformatik" <?= ($user_data['course'] === 'Wirtschaftsinformatik') ? 'selected' : '' ?>>Wirtschaftsinformatik</option>
            </select>
            </div>

            <!-- Save Button -->
            <div class="d-grid">
            <button type="submit" name="submit" class="btn fw-semibold">Save Changes</button>
            </div>
        </form>
        </div>
    </div>
    </main>
    <?php include 'includes/footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>