<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
include 'navbar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insider Threats - Cyber Risk Prioritization System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('pixelcut-export (1).jpeg'); /* Replace with your image path */
            background-size: cover;
            background-attachment: fixed;
            color: #fff;
        }
        .container {
            background: rgba(0, 0, 0, 0.8);
            padding: 30px;
            border-radius: 10px;
        }
        h2 {
            color: #ffc107;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Insider Threats</h1>
        <p class="text-center">
            This section covers the types of threats that come from within an organization. Insider threats can be caused by employees, former employees, contractors, or business associates with access to the organization's resources.
        </p>

        <h2>Types of Insider Threats</h2>

        <!-- Malicious Insiders Section -->
        <div class="my-4 p-4 bg-dark text-light rounded">
            <h3>Malicious Insiders</h3>
            <p>
                These individuals intentionally harm the organization. They might steal data, sell confidential information, or sabotage systems, often for personal gain, revenge, or under external influence.
            </p>
        </div>

        <!-- Negligent Insiders Section -->
        <div class="my-4 p-4 bg-secondary text-light rounded">
            <h3>Negligent Insiders</h3>
            <p>
                Negligent insiders unintentionally create vulnerabilities through careless behavior, such as ignoring security protocols, falling for phishing scams, or mishandling sensitive data, which can open the door to security breaches.
            </p>
        </div>

        <!-- Infiltrators Section -->
        <div class="my-4 p-4 bg-dark text-light rounded">
            <h3>Infiltrators (Compromised Insiders)</h3>
            <p>
                Infiltrators are outsiders who gain access by compromising an insider's credentials. The compromised insider might be unaware that their account is being used for malicious purposes.
            </p>
        </div>

        <p>
            Insider threats are particularly challenging to manage because they involve people with legitimate access, making it harder to detect unusual behavior. Organizations address insider threats with measures like user behavior monitoring, data access restrictions, and regular security training.
        </p>

        <!-- Further Information Section -->
        <p class="mt-4">
            For further information regarding insider threats, please visit the official <a href="https://www.cisa.gov/topics/physical-security/insider-threat-mitigation/defining-insider-threats" target="_blank" class="text-warning">CISA Insider Threats page</a>.
        </p>

        <!-- Back Button -->
        <div class="text-center mt-4">
            <a href="education.php" class="btn btn-warning">Back to Educational Components</a>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
