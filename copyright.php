<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Copyright - StudyWithMe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/styles.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

    <?php include 'includes/navbar.php'; ?>

    <main class="container my-5">
        <h1 class="text-room">Copyright & Urheberrecht</h1>
        
        <h2 class="mt-4">Alle Rechte vorbehalten</h2>
        <div class="user-entry p-3">
            <p class="mb-0"><strong>© <?php echo date("Y"); ?> StudyWithMe</strong></p>
            <p>Sämtliche Inhalte dieser Webseite sind Konrad Grossinger und Julian Rainer vorbehalten.</p>
        </div>
        <p class="mt-3">
            Die durch die Seitenbetreiber erstellten Inhalte und Werke auf diesen Seiten unterliegen dem österreichischen Urheberrecht. 
            Die Vervielfältigung, Bearbeitung, Verbreitung und jede Art der Verwertung außerhalb der Grenzen des Urheberrechtes 
            bedürfen der schriftlichen Zustimmung von Konrad Muster oder Julian Beispiel.
        </p>

        <h2 class="mt-4">Bildnachweis</h2>
        <div class="user-entry p-3 border-start border-4 border-primary">
            <p><strong>Grafik Campus-Map:</strong></p>
            <p>Das für die Campus-Map verwendete grafische Material unterliegt dem Urheberrecht der:</p>
            <p class="fw-bold">Fachhochschule Technikum Wien</p>
            <p>Höchstädtplatz 6, 1200 Wien</p>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>