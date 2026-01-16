<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'includes/head.php'?>
    <title>Floor plan</title>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php include 'includes/navbar.php'; ?> 

<?// $sessionActive = !empty($_SESSION['study_session_active']); ?>  
  <?php
  //hier soll möglich gemacht werden, building und floor über get UND post zu setzen
   // Gebäude
    if (isset($_POST['building'])) {
        $currentBuilding = strtoupper($_POST['building']);
    } elseif (isset($_GET['building'])) {
        $currentBuilding = strtoupper($_GET['building']);
    } else {
        $currentBuilding = 'F';
    }

    // Floor (POST hat Vorrang!)
    if (isset($_POST['floor'])) {
        $selectedFloor = (int) $_POST['floor'];
    } elseif (isset($_GET['floor'])) {
        $selectedFloor = (int) $_GET['floor'];
    } else {
        $selectedFloor = 0;
    }

    // Sonderregel Gebäude B (startet nicht bei 0)
    if ($currentBuilding === 'B' && $selectedFloor == 0) {
        $selectedFloor = 2;
    }
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
      <div class="p-3 bg-light border h-100"> <!--leeres widget-->
        <?php $selectedRoomId = $_GET['room_id'] ?? null; ?>
        <!-- hier kommt später dann rein, was über den Button ausgewählt wurde -->

        <h3 style="<?= empty($selectedRoomId) ? '' : 'display:none;' ?>">Room Information</h3>
        <p style="<?= empty($selectedRoomId) ? '' : 'display:none;' ?>">please pick a room...</p>

        <div class="container py-4">
          
            <h3 class="fw-bold text-center mb-3" style="display:none">Room Details</h3>

            <div class="text-center mb-3">
              <p class="mb-0 small text-muted">ROOM</p>
              <!-- die raumid in namen umwandeln über ausgelagerte function-->
                <?php
                  require_once "logic/functions.php"; // Datei mit getRoomNameById()
                  $roomName = getRoomNameById($db_obj, $selectedRoomId);
                ?>
              <h2 class="fw-bold text-room"><?php echo htmlspecialchars($roomName); ?></h2>
              <div class="room-bar mx-auto"></div>
            </div>

            <!-- Active Users in Room -->
            <div class="room-userlist p-3 mb-4 rounded">

              <div class="room-user d-flex justify-content-between align-items-center mb-2 p-2 rounded">
                <div class="d-flex align-items-center">
                  <img src="assets/img/defaultpp.jpg" alt="Profile" class="profile-pic me-2">
                  <span class="fw-semibold">Max Mustermann</span>
                </div>
                <div class="d-flex align-items-center">
                  <span class="time me-2">37:24</span>
                  <span class="subject-tag">REQEN</span>
                </div>
              </div>

              <div class="room-user d-flex justify-content-between align-items-center mb-2 p-2 rounded">
                <div class="d-flex align-items-center">
                  <img src="assets/img/defaultpp.jpg" alt="Profile" class="profile-pic me-2">
                  <span class="fw-semibold">Toni Justus</span>
                </div>
                <div class="d-flex align-items-center">
                  <span class="time me-2">25:23</span>
                  <span class="subject-tag">AWS</span>
                </div>
              </div>

              <div class="room-user d-flex justify-content-between align-items-center p-2 rounded">
                <div class="d-flex align-items-center">
                  <img src="assets/img/defaultpp.jpg" alt="Profile" class="profile-pic me-2">
                  <span class="fw-semibold">Alice Bob</span>
                </div>
                <div class="d-flex align-items-center">
                  <span class="time me-2">24:54</span>
                  <span class="subject-tag">AWS</span>
                </div>
              </div>

            </div>

            <form action="<?= empty($_SESSION['study_session_active'])? 'logic/start_study_session.php': 'logic/stop_study_session.php' ?>" method="post">
              <!-- Subject Input -->
              <div class="mb-3">
                  <label for="subject" class="form-label fw-semibold">Subject</label>
                  <input
                      type="text"
                      id="subject"
                      name="subject"
                      class="form-control rounded-pill"
                      placeholder="Input..."
                      <?= empty($_SESSION['logged_in']) || empty($selectedRoomId) || !empty($_SESSION['study_session_active']) ? 'disabled' : '' ?>
                  >
              </div>

              <!-- Study Session Controls -->
              <div class="studysessionstart p-3 mb-3 rounded d-flex justify-content-between align-items-center border">

                  <input type="hidden" name="room_id" value="<?= $selectedRoomId ?>">
                  <input type="hidden" name="building" value="<?= $currentBuilding ?>">
                  <input type="hidden" name="floor" value="<?= $selectedFloor ?>">

                  <span class="fw-semibold">Study-Session</span>

                  <div class="d-flex align-items-center gap-3">
                      <span class="text-muted">60:00</span>

                      <button
                          type="submit"
                          name="start_session"
                          class="btn <?= $sessionActive ? 'd-none' : '' ?>"
                          <?= empty($_SESSION['logged_in']) || empty($selectedRoomId) ? 'disabled' : '' ?>
                          <?= !empty($_SESSION['study_session_active']) ? 'hidden' : ''?>
                      >
                          Start
                      </button>
                      <button
                          type="submit"
                          class="btn stopsession"
                          <?= empty($_SESSION['logged_in']) ? 'disabled' : '' ?>
                          <?= empty($_SESSION['study_session_active']) ? 'hidden' : ''?>
                      >
                          Stop
                      </button>
                  </div>

              </div>

          </form>
          
          
        </div>
      </div><!-- leeres widget ende-->
    </div> 
    <div class="col-12 col-md-6">
      <div class="p-3 bg-light border h-100">
        <div class="d-flex flex-column align-items-center">
        <h5 class="mb-3">Pick a floor</h5>
        <div class="d-flex floorbtnbar text-white rounded-pill p-1">
        <!--Muss noch angepasst werden mit php dass je nach Building andere Floors gezeigt werden sonst hauts hin-->
            <form method="post">
                <?php if($currentBuilding === 'F') : ?>
                  <button type="submit" name="floor" value="0" class="btn actvbtn rounded-pill mx-1">UG</button>
                  <button type="submit" name="floor" value="1" class="btn actvbtn rounded-pill mx-1">1</button>
                  <button type="submit" name="floor" value="2" class="btn actvbtn rounded-pill mx-1">2</button>
                  <button type="submit" name="floor" value="3" class="btn actvbtn rounded-pill mx-1" disabled>3</button>
                  <button type="submit" name="floor" value="4" class="btn actvbtn rounded-pill mx-1">4</button>
                  <button type="submit" name="floor" value="5" class="btn actvbtn rounded-pill mx-1" disabled>5</button>
                  <button type="submit" name="floor" value="6" class="btn actvbtn rounded-pill mx-1" disabled>6</button>
                <?php elseif($currentBuilding === 'A') : ?>
                  <button type="submit" name="floor" value="0" class="btn actvbtn rounded-pill mx-1">UG</button>
                  <button type="submit" name="floor" value="1" class="btn actvbtn rounded-pill mx-1">1</button>
                  <button type="submit" name="floor" value="2" class="btn actvbtn rounded-pill mx-1">2</button>
                  <button type="submit" name="floor" value="3" class="btn actvbtn rounded-pill mx-1">3</button>
                  <button type="submit" name="floor" value="4" class="btn actvbtn rounded-pill mx-1">4</button>
                  <button type="submit" name="floor" value="5" class="btn actvbtn rounded-pill mx-1">5</button>
                  <button type="submit" name="floor" value="6" class="btn actvbtn rounded-pill mx-1">6</button>
                <?php else : ?>
                  <button type="submit" name="floor" value="0" class="btn actvbtn rounded-pill mx-1" disabled>UG</button>
                  <button type="submit" name="floor" value="1" class="btn actvbtn rounded-pill mx-1" disabled>1</button>
                  <button type="submit" name="floor" value="2" class="btn actvbtn rounded-pill mx-1">2</button>
                  <button type="submit" name="floor" value="3" class="btn actvbtn rounded-pill mx-1" disabled>3</button>
                  <button type="submit" name="floor" value="4" class="btn actvbtn rounded-pill mx-1">4</button>
                  <button type="submit" name="floor" value="5" class="btn actvbtn rounded-pill mx-1" disabled>5</button>
                  <button type="submit" name="floor" value="6" class="btn actvbtn rounded-pill mx-1" disabled>6</button>
                <?php endif;?>
          </form>
            <?php // echo $selectedFloor; ?>
        </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-6">
      <div class="p-3 bg-light border h-100">
        <h5>choose room</h5>
        <div class="d-flex roombar text-white rounded-pill p-1">
              <div class="text-center">
                    <div class="d-flex roombar text-white rounded-pill p-1 flex-wrap">
                       <?php
                        require_once "logic/database/dbaccess.php";

                        $sql = "
                          SELECT id, room_number
                          FROM rooms
                          WHERE building = ?
                          AND floor = ?
                        ";

                        $stmt = $db_obj->prepare($sql);
                        $stmt->bind_param("si", $currentBuilding, $selectedFloor);
                        $stmt->execute();
                        $result = $stmt->get_result();
                       ?>
                       <div class="d-flex roombar text-white rounded-pill p-1 flex-wrap">
                        <?php while ($room = $result->fetch_assoc()): ?>
                          <form method="get" class="me-2 mb-2">

                            <input type="hidden" name="building" value="<?= $currentBuilding ?>">
                            <input type="hidden" name="floor" value="<?= $selectedFloor ?>">

                            <button
                              type="submit"
                              name="room_id"
                              value="<?= $room['id'] ?>"
                              class="bg-tag"
                            >
                              <?= $currentBuilding . $selectedFloor . '.' . str_pad($room['room_number'], 2, '0', STR_PAD_LEFT) ?>
                            </button>
                          </form>
                        <?php endwhile; ?>
                      </div>
                    </div>
              </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include 'includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>