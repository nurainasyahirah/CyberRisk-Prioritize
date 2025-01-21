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
    <title>Malicious Threats - Cyber Risk Prioritization System</title>
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
        <h1 class="text-center">Malicious Threats</h1>
        <p class="text-center">
            This section deals with external threats that are typically deliberate attempts to breach the security perimeter of an organization. Malicious threats include various attack vectors, such as malware, phishing, and social engineering.
        </p>

        <h2>Common Types of Malicious Threats</h2>

        <!-- Malware Section -->
        <div class="section">
            <h3>Malware</h3>
            <p>
                Malicious software, such as viruses, worms, ransomware, and spyware, that infects systems to damage or steal data, hold information hostage, or disrupt operations.
            </p>
        </div>

        <!-- Phishing Attacks Section -->
        <div class="section">
            <h3>Phishing Attacks</h3>
            <p>
                Attempts to trick individuals into providing sensitive information (like passwords or credit card details) through deceptive emails, messages, or websites that appear legitimate.
            </p>
        </div>

        <!-- Insider Threats Section -->
        <div class="section">
            <h3>Insider Threats</h3>
            <p>
                Malicious insiders are individuals within an organization (e.g., employees or contractors) who abuse their access to data or systems to harm the organization, such as by leaking confidential information.
            </p>
        </div>

        <!-- Social Engineering Section -->
        <div class="section">
            <h3>Social Engineering</h3>
            <p>
                Techniques that manipulate individuals into divulging confidential information by exploiting psychological triggers, often using urgency, fear, or curiosity.
            </p>
        </div>

        <!-- Distributed Denial of Service (DDoS) Section -->
        <div class="section">
            <h3>Distributed Denial of Service (DDoS)</h3>
            <p>
                Attacks that overwhelm a network or service with excessive traffic to make it unavailable to users, disrupting business operations.
            </p>
        </div>

        <!-- Advanced Persistent Threats (APTs) Section -->
        <div class="section">
            <h3>Advanced Persistent Threats (APTs)</h3>
            <p>
                Long-term, highly targeted attacks often conducted by sophisticated adversaries aiming to infiltrate and remain undetected within a network for prolonged periods, gathering sensitive information or causing damage over time.
            </p>
        </div>

        <!-- Additional Information and Reference Link -->
        <p class="mt-4">
            Malicious threats are especially challenging because attackers often continuously evolve their methods to bypass security measures. For further information on malicious threats, please visit <a href="https://www.cisa.gov/topics/cyber-threats" target="_blank" class="text-warning">CISA's Cyber Threats page</a>.
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
