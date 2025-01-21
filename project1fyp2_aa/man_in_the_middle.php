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
    <title>Man-in-the-Middle Attacks - Cyber Risk Prioritization System</title>
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
        <h1 class="text-center">Man-in-the-Middle Attacks</h1>
        <p class="text-center">
            A Man-in-the-Middle (MitM) attack is when an attacker secretly intercepts and manipulates communication between two unsuspecting parties, leading to data theft, identity theft, or misinformation.
        </p>

        <h2>How Man-in-the-Middle Attacks Work</h2>
        <div class="section">
            <p><strong>Interception:</strong> The attacker intercepts communications through various methods:</p>
            <ul>
                <li><strong>Wi-Fi Eavesdropping:</strong> Fake Wi-Fi networks capture users’ data.</li>
                <li><strong>Packet Sniffing:</strong> Attackers capture unencrypted data packets.</li>
                <li><strong>IP Spoofing:</strong> Attackers impersonate a trusted IP address to intercept communications.</li>
            </ul>
            <p><strong>Decryption:</strong> Techniques like HTTPS spoofing or SSL stripping may be used to downgrade encryption.</p>
            <p><strong>Relay and Manipulation:</strong> The attacker can relay messages between the two parties while reading or altering the content.</p>
        </div>

        <h2>Common Types of Man-in-the-Middle Attacks</h2>
        <div class="section">
            <p><strong>Wi-Fi Eavesdropping:</strong> Attackers create fake Wi-Fi access points to capture data from unsuspecting users.</p>
            <p><strong>HTTPS Spoofing or SSL Stripping:</strong> Attackers intercept HTTPS requests, downgrading them to HTTP.</p>
            <p><strong>Email Hijacking:</strong> Attackers gain access to email accounts, manipulating communications.</p>
            <p><strong>Session Hijacking:</strong> Attackers steal session tokens for unauthorized website or app access.</p>
            <p><strong>DNS Spoofing:</strong> Attackers redirect users to fake websites by manipulating DNS queries.</p>
        </div>

        <h2>Indicators of a Man-in-the-Middle Attack</h2>
        <div class="section">
            <ul>
                <li><strong>Unusual Security Warnings:</strong> SSL/TLS certificate warnings or “Not Secure” alerts.</li>
                <li><strong>Suspicious Network Names:</strong> Unfamiliar Wi-Fi network names, especially in public areas.</li>
                <li><strong>Slow Network Performance:</strong> Slower connections as data is intercepted and relayed.</li>
            </ul>
        </div>

        <h2>How to Prevent Man-in-the-Middle Attacks</h2>
        <div class="section">
            <p><strong>Use Encryption:</strong> Always use HTTPS websites and services for secure transactions.</p>
            <p><strong>Enable VPN:</strong> A VPN encrypts data on unsecured networks.</p>
            <p><strong>Avoid Public Wi-Fi for Sensitive Transactions:</strong> Use a VPN if public Wi-Fi is unavoidable.</p>
            <p><strong>Implement Strong Authentication:</strong> Multi-factor authentication adds a layer of security.</p>
            <p><strong>Keep Software Updated:</strong> Regular updates patch vulnerabilities.</p>
            <p><strong>Verify Website Certificates:</strong> Ensure SSL/TLS certificates are valid before entering sensitive data.</p>
        </div>

        <h2>Example of a Man-in-the-Middle Attack</h2>
        <div class="section">
            <p><strong>Public Wi-Fi Attack:</strong> A user connects to a public Wi-Fi hotspot set up by an attacker in a coffee shop. The attacker captures all data transmitted, including login credentials and personal information.</p>
        </div>

        <!-- Additional Information and Reference Link -->
        <p class="mt-4">
            MitM attacks are often hard to detect and can lead to significant data breaches. For more information on these types of attacks, please visit <a href="https://www.cisa.gov/man-middle-attack" target="_blank" class="text-warning">CISA's Man-in-the-Middle Attack Guide</a>.
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
