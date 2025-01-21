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
    <title>Cryptojacking - Cyber Risk Prioritization System</title>
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
        <h1 class="text-center">Cryptojacking</h1>
        <p class="text-center">
            Cryptojacking is a cyber attack where malicious actors hijack a victim's computing resources to mine cryptocurrency without their consent, causing resource drain and increased operational costs.
        </p>

        <h2>How Cryptojacking Works</h2>
        <div class="section">
            <p><strong>Infection:</strong> Attackers infect devices or websites with malicious code to mine cryptocurrency. This can happen through:</p>
            <ul>
                <li><strong>Phishing Emails:</strong> Emails trick users into clicking links or downloading infected attachments.</li>
                <li><strong>Malware Downloads:</strong> Software secretly includes cryptojacking scripts.</li>
                <li><strong>Compromised Websites:</strong> Visiting websites with mining scripts (drive-by mining) that run in the background.</li>
            </ul>
            <p><strong>Execution:</strong> Once active, the cryptojacking code runs silently, using the device’s CPU or GPU for mining.</p>
            <p><strong>Profit Generation:</strong> Mined cryptocurrency is sent to the attacker's wallet while the victim bears the cost of electricity and hardware wear.</p>
        </div>

        <h2>Signs of Cryptojacking</h2>
        <div class="section">
            <ul>
                <li><strong>Slow Performance:</strong> Devices may become unusually slow or unresponsive.</li>
                <li><strong>Overheating:</strong> Increased CPU/GPU usage can cause devices to overheat.</li>
                <li><strong>High Resource Usage:</strong> Task managers may show high CPU or memory usage by unfamiliar processes.</li>
                <li><strong>Reduced Battery Life:</strong> Mobile devices may experience faster battery drain.</li>
            </ul>
        </div>

        <h2>Common Methods of Cryptojacking</h2>
        <div class="section">
            <p><strong>Browser-Based Mining:</strong> Scripts embedded in websites execute mining operations through the user’s browser.</p>
            <p><strong>Malware-Based Mining:</strong> Malware installed on a device runs mining software without user awareness.</p>
        </div>

        <h2>How to Protect Against Cryptojacking</h2>
        <div class="section">
            <p><strong>Use Security Software:</strong> Install reputable antivirus and anti-malware programs that can detect and block cryptojacking scripts.</p>
            <p><strong>Keep Software Updated:</strong> Regularly update operating systems, browsers, and applications to patch vulnerabilities.</p>
            <p><strong>Browser Extensions:</strong> Use ad blockers or extensions like NoCoin or MinerBlock to prevent mining scripts.</p>
            <p><strong>Educate Users:</strong> Raise awareness about phishing and downloading software from untrusted sources.</p>
            <p><strong>Monitor System Performance:</strong> Investigate any unexplained slowdowns or high resource usage.</p>
            <p><strong>Network Security Measures:</strong> For organizations, implement network monitoring to detect unusual activity.</p>
        </div>

        <h2>Impact of Cryptojacking</h2>
        <div class="section">
            <p><strong>Increased Operational Costs:</strong> Higher electricity consumption and potential hardware damage.</p>
            <p><strong>Productivity Loss:</strong> Slowed systems can hinder productivity.</p>
            <p><strong>Security Risks:</strong> Indicates a breach that could be exploited for further malicious activities.</p>
        </div>

        <!-- Additional Information and Reference Link -->
        <p class="mt-4">
            Cryptojacking is a stealthy threat that drains resources for illicit cryptocurrency mining. For more information on similar threats, visit <a href="https://www.cisa.gov/ransomware" target="_blank" class="text-warning">CISA's Ransomware Guide</a>.
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
