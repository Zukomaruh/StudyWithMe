<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Impressum - StudyWithMe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/styles.css" rel="stylesheet">
    <style>
        /* Zusätzliches Styling für die Impressum-Inhalte */
        .impressum-content {
            background-color: #f9faf7;
            border: 2px solid #769b12;
            border-radius: 16px;
            padding: 2rem;
            margin-top: 2rem;
            margin-bottom: 2rem;
        }
        .legal-section h2 {
            color: #769b12;
            border-bottom: 2px solid #e7eed9;
            padding-bottom: 5px;
            margin-top: 1.5rem;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <?php include 'includes/navbar.php';?>

    <main class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8 impressum-content shadow-sm">
                <h1 class="text-room mb-4">Impressum</h1>
                <p class="lead">Informationen gemäß § 5 ECG, § 14 UGB und § 25 MedienG.</p>

                <div class="legal-section">
                    <h2>Unternehmensdaten</h2>
                    <p><strong>StudyWithME GmbH</strong></p>
                    <p>Mariahilfer Straße 100<br>1070 Wien, Österreich</p>

                    <h2>Vertretung (Geschäftsführung)</h2>
                    <p>Julian Rainer<br>Konrad Grossinger</p>

                    <h2>Kontakt</h2>
                    <p>E-Mail: <a href="mailto:placeholder@leberkas.at" style="color: #769b12; font-weight: bold;">placeholder@leberkas.at</a></p>
                    <p>Telefon: +43 1 1234567</p>

                    <h2>Register & Aufsicht</h2>
                    <p><strong>Firmenbuchnummer:</strong> FN 123456 x</p>
                    <p><strong>Firmenbuchgericht:</strong> Handelsgericht Wien</p>
                    <p><strong>UID-Nummer:</strong> ATU12345678</p>
                    <p><strong>Zuständige Behörde:</strong> Magistratisches Bezirksamt des VII. Bezirkes</p>
                    <p><strong>Kammer:</strong> Wirtschaftskammer Wien</p>

                    <h2>Unternehmensgegenstand</h2>
                    <p>Entwicklung und Betrieb einer Online-Plattform zur Vernetzung von Studierenden und Förderung gemeinsamer Lernaktivitäten.</p>

                    <h2>Streitbeilegung</h2>
                    <p>Verbraucher haben die Möglichkeit, Beschwerden an die Online-Streitbeileuungsplattform der EU zu richten: 
                    <a href="https://ec.europa.eu/consumers/odr" target="_blank" class="footer-link" style="color: #00649c;">https://ec.europa.eu/consumers/odr</a>.</p>
                </div>
            </div>
        </div>
    </main>

    <?php include 'includes/footer.php';?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>