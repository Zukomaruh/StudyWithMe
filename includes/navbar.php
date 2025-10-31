  <!--requests current page-->
  <?php
    $currentPage = $_SERVER['REQUEST_URI'];
  ?>

  <!--nav bar-->

    <nav class="navbar navbar-expand-lg navbar-dark sticky-top shadow-sm">
    <div class="container-fluid">

  <!--Logo-Homebutton-->
  
      <a class="navbar-brand fw-bold d-flex align-items-center" href="index.php">
        <img
        src="assets/img/StudyWithMe_Logo.png"
        alt="StudyWithMe Logo"
        height="50"
        class="d-inline-block align-top px-3"
      />
      <span>StudyWithMe</span>
      </a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNav"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

<!--Zeigt Buttons je nach Seite an-->

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
        <?php if (basename($currentPage) === 'index.php' || basename($currentPage) === 'privacystatement.php') : ?>
          <li class="nav-item">
            <a class="nav-link" href="createAccount.php">Register</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Log In</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="campusmap.php">Campus-Map</a>
          </li>
        <?php else:?>
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
        <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>