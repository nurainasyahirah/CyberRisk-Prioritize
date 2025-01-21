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
    <title>Password Attacks - Cyber Risk Prioritization System</title>
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
        .section {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 15px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Password Attacks</h1>
        <p class="text-center">
            Password attacks aim to crack or bypass password-based security mechanisms, granting attackers unauthorized access to systems or sensitive data.
        </p>

        <h2>Types of Password Attacks</h2>
        <div class="section">
            <ul>
                <li><strong>Brute-Force Attack:</strong> Automated tools attempt all possible password combinations.</li>
                <li><strong>Dictionary Attack:</strong> Attackers use a list of common passwords or dictionary words.</li>
                <li><strong>Credential Stuffing:</strong> Stolen username-password pairs are tried on multiple sites.</li>
                <li><strong>Phishing:</strong> Attackers impersonate trusted entities to trick users into revealing passwords.</li>
                <li><strong>Keylogging:</strong> Malware records keystrokes to capture passwords.</li>
                <li><strong>Man-in-the-Middle (MitM) Attack:</strong> Interception of data between the user and system to capture passwords.</li>
                <li><strong>Rainbow Table Attack:</strong> Precomputed hash tables are used to crack password hashes.</li>
                <li><strong>Social Engineering:</strong> Attackers use psychological tactics to obtain passwords.</li>
            </ul>
        </div>

        <h2>Why Password Attacks are Dangerous</h2>
        <div class="section">
            <p><strong>Direct Access to Sensitive Data:</strong> Compromised passwords allow access to private data and systems.</p>
            <p><strong>System Hijacking:</strong> Attackers can take control of accounts, potentially stealing data.</p>
            <p><strong>Identity Theft:</strong> Stolen credentials enable attackers to impersonate victims, risking fraud.</p>
            <p><strong>Widespread Impact:</strong> Reused passwords increase vulnerability across multiple accounts.</p>
        </div>

        <h2>How to Protect Against Password Attacks</h2>
        <div class="section">
            <ul>
                <li><strong>Use Strong, Unique Passwords:</strong> Avoid common words and use a mix of characters.</li>
                <li><strong>Enable Multi-Factor Authentication (MFA):</strong> Adds an extra layer of security beyond passwords.</li>
                <li><strong>Avoid Reusing Passwords:</strong> Reused passwords increase vulnerability if one account is breached.</li>
                <li><strong>Use Password Managers:</strong> Generate and store complex passwords securely.</li>
                <li><strong>Monitor for Phishing Attempts:</strong> Be cautious with emails and messages requesting personal information.</li>
                <li><strong>Limit Login Attempts:</strong> Lock accounts after a certain number of failed attempts.</li>
                <li><strong>Regularly Update and Change Passwords:</strong> Reduces risk if credentials are exposed.</li>
                <li><strong>Educate on Social Engineering Risks:</strong> Awareness can prevent inadvertent password disclosure.</li>
            </ul>
        </div>

        <h2>Example of a Password Attack</h2>
        <div class="section">
            <p>An attacker uses a dictionary attack on an online banking platform, testing a list of commonly used passwords for each username. If successful, they gain access to sensitive accounts, potentially causing financial harm.</p>
        </div>

        <!-- Additional Information and Reference Link -->
        <p class="mt-4">
            For further information on password attacks, visit <a href="https://www.cisa.gov/uscert/ncas/tips/ST04-002" target="_blank" class="text-warning">CISA’s Guide on Password Attacks</a>.
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
