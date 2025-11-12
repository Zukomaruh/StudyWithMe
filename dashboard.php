<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'includes/head.php' ?>
    <title>Dashboard</title>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php include 'includes/navbar.php' ?>
    <main class="container py-5">
        <h1 class="fw-bold mb-4 d-flex align-items-center">
            Active Users
            <span class="status-dot ms-2"></span>
        </h1>

        <!-- Example Course Section -->
        <section class="course-section p-3 rounded">
            <h5 class="fw-semibold mb-3">Business and Computer Science</h5>

            <!-- User List -->
            <div class="user-entry d-flex align-items-center justify-content-between mb-2 p-2 rounded">
                <div class="d-flex align-items-center">
                    <img src="assets/img/defaultpp.jpg" alt="Profile Picture" class="profile-pic me-2">
                    <span class="fw-semibold">Konrad Grossinger</span>
                </div>
                <div class="text-center">
                    <span class="subject-tag">REQEN</span>
                </div>
                <div>
                    <span class="fw-semibold">F4.24</span>
                </div>
            </div>
        </section>
    </main>
    <?php include 'includes/footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>