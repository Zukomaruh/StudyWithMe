  <!--requests current page-->
  <?php
    $currentPage = $_SERVER['REQUEST_URI'];
  ?>

  <!--nav bar-->
    <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold" href="index.php">StudyWithMe</a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNav"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <?php if (basename($currentPage) === 'index.php') echo '
          <li class="nav-item">
            <a class="nav-link" href="createAccount.php">Join Now</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Log In</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="campusmap.php">Campus-Map</a>
          </li>
        '; ?>
        <?php if (basename($currentPage) === 'campusmap.php') echo '
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="campusmap.php">Campus-Map</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Logout</a>
          </li>
        '; ?>
        </ul>
      </div>
    </div>
  </nav>