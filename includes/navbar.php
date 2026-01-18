  <!--requests current page-->
  <?php
    if(session_status() === PHP_SESSION_NONE){
      session_start();
    }
    $currentPage = basename($_SERVER['REQUEST_URI']);
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
        <?php if (basename($currentPage) === 'index.php' 
        or basename($currentPage) === 'privacystatement.php'
        or basename($currentPage) === 'copyright.php'
        or basename($currentPage) === 'impressum.php') : ?>
          <li class="nav-item">
            <a class="nav-link" href="createAccount.php">Register</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Log In</a>
          </li>
        <?php elseif(basename($currentPage) === 'createAccount.php'
        or basename($currentPage) === 'login.php') : ?>
          <li class="nav-item">
            <a class="nav-link" href="index.php">Back</a>
          </li>
        <?php else:?>
          <li class="nav-item">
            <a class="nav-link 
            <?php if($currentPage === 'profile.php'){echo 'active';}
            if(!empty($_SESSION['guest'])) echo ' disabled';?>" 
            href="profile.php">Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link 
            <?php if($currentPage === 'campusmap.php'){echo 'active';}?>" 
            href="campusmap.php">Campus-Map</a>
          </li>
          <li class="nav-item">
            <a class="nav-link 
            <?php if($currentPage === 'dashboard.php'){echo 'active';}
            if(!empty($_SESSION['guest'])) echo ' disabled';?>" 
            href="dashboard.php">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logic/logout.php"><?= !empty($_SESSION['guest']) ? 'Back' : 'Logout' ?></a>
          </li>
        <?php endif; ?>
          <!-- Displays session info, only for debbuging: -->
          <?php //echo "<pre>" . print_r($_SESSION, true) . "</pre>";
                //echo "only for debbuging"
          ?>
        </ul>
      </div>
    </div>
  </nav>