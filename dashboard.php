<?php session_start();
require_once "logic/functions.php";
require_once "logic/database/dbaccess.php";
redirectIllegalSiteVisit();
closeExpiredStudySessions($db_obj);
if(!empty($_SESSION['logged_in'])){
  checkRunningSession($db_obj, $_SESSION['user_id']);
}else{
    header("Location: index.php");
    exit;
}
?>
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

        <?php
            //Alle aktiven Sessions mit User-Infos holen
            $sql = "
                SELECT 
                    s.session_id,
                    u.name AS user_name, 
                    u.course AS user_course, 
                    s.subject, 
                    s.start_time,
                    r.building, 
                    r.floor, 
                    r.room_number
                FROM study_sessions s
                JOIN users u ON s.user_id = u.user_id
                JOIN rooms r ON s.room_id = r.id
                WHERE s.end_time IS NULL
                ORDER BY u.course, s.start_time ASC
            ";

            $result = $db_obj->query($sql);

            //Sessions nach Studiengang gruppieren
            $activeSessions = [];

            while ($row = $result->fetch_assoc()) {
                $course = $row['user_course'];
                if (!isset($activeSessions[$course])) {
                    $activeSessions[$course] = [];
                }
                $activeSessions[$course][] = $row;
            }

            // 3. HTML ausgeben
            foreach ($activeSessions as $course => $sessions) {
                ?>
                <section class="course-section p-3 rounded">
                    <h5 class="fw-semibold mb-3"><?= htmlspecialchars($course) ?></h5>

                    <?php foreach ($sessions as $session): 
                        // Raumname zusammensetzen, führende 0 für Raumnummer < 10
                        $roomNumber = str_pad($session['room_number'], 2, "0", STR_PAD_LEFT);
                        $roomName = htmlspecialchars($session['building'] . $session['floor'] . "." . $roomNumber);

                        // Laufzeit berechnen
                        $start = new DateTime($session['start_time']);
                        $now = new DateTime();
                        $interval = $start->diff($now);
                        $elapsedTime = sprintf('%02d:%02d', $interval->h*60 + $interval->i, $interval->s);
                    ?>

                    <div class="user-entry d-flex align-items-center justify-content-between mb-2 p-2 rounded">

                        <div class="d-flex align-items-center">
                            <div>
                                    <?php
                                    // Default-Profilbild
                                    $profilePic = "assets/img/defaultpp.jpg";

                                    if (!empty($_SESSION['user_id'])) {
                                        $stmt = $db_obj->prepare("SELECT profile_pic FROM users WHERE user_id = ?");
                                        $stmt->bind_param("i", $_SESSION['user_id']);
                                        $stmt->execute();
                                        $stmt->bind_result($dbProfilePic);
                                        $stmt->fetch();
                                        $stmt->close();

                                        $dbProfilePic = substr($dbProfilePic, 3);

                                        if (!empty($dbProfilePic)) {
                                            $profilePic = $dbProfilePic;
                                        }
                                    }
                                ?>

                                <!-- Profile Picture -->
                                <div class="d-flex align-items-center gap-3">
                                    <img
                                        src="<?= htmlspecialchars($profilePic) ?>"
                                        alt="Profile Picture"
                                        class="rounded-circle img-fluid"
                                        style="width: 45px; height: 45px; object-fit: cover;"
                                    >
                                    <span class="fw-semibold">
                                        <?= htmlspecialchars($session['user_name']) ?>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <span class="subject-tag"><?= htmlspecialchars($session['subject']) ?></span>
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <div class="d-flex flex-column align-items-end">
                                <span class="fw-semibold"><?= $roomName ?></span>
                                <span class="text-muted"><?= $elapsedTime ?></span>
                            </div>

                            <?php if (!empty($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                                <form method="post" action="logic/admin_stop_session.php" class="ms-2">
                                    <input type="hidden" name="session_id" value="<?= $session['session_id'] ?>">
                                    <button type="submit" class="btn stopsession">
                                        Stop
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>

                    </div>
                    
                    <?php endforeach; ?>
                    
                </section>
                <?php
            }
            ?>
    </main>
    <?php include 'includes/footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>