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
    <title>Malvertising - Cyber Risk Prioritization System</title>
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
        <h1 class="text-center">Malvertising</h1>
        <p class="text-center">
            Malvertising (malicious advertising) involves injecting harmful code into legitimate ads, often on reputable websites, leading users to malware, phishing sites, or automatic malware downloads.
        </p>

        <h2>How Malvertising Works</h2>
        <div class="section">
            <p>Malvertising occurs when attackers purchase ad space and embed malicious code. This code can be activated upon display or interaction, leading to unwanted downloads or redirects.</p>
            <p><strong>Steps:</strong></p>
            <ul>
                <li><strong>Ad Networks:</strong> Attackers distribute infected ads through ad networks.</li>
                <li><strong>Infected Ads:</strong> Malicious code is embedded within ads, triggering when displayed or clicked.</li>
                <li><strong>Payload Execution:</strong> Redirects, drive-by downloads, or exploit kits activate upon user interaction.</li>
            </ul>
        </div>

        <h2>Types of Malvertising Attacks</h2>
        <div class="section">
            <ul>
                <li><strong>Drive-By Downloads:</strong> Malware is automatically downloaded without user consent.</li>
                <li><strong>Click-Redirects:</strong> Ads redirect users to phishing or malware-infested websites.</li>
                <li><strong>Auto-Redirections:</strong> Automatically redirects the webpage to malicious sites.</li>
                <li><strong>Tech Support Scams:</strong> Leads users to fake tech support sites prompting payments.</li>
            </ul>
        </div>

        <h2>Why Malvertising is Effective</h2>
        <div class="section">
            <p><strong>Trust in Reputable Sites:</strong> Users trust legitimate sites displaying these ads, making interaction more likely.</p>
            <p><strong>Wide Reach:</strong> Ad networks allow attackers to reach a broad audience on popular sites.</p>
            <p><strong>Minimal Interaction Needed:</strong> Some malvertising requires no clicks, using drive-by download techniques.</p>
        </div>

        <h2>Impact of Malvertising</h2>
        <div class="section">
            <p><strong>Data Theft:</strong> Potential for credential and information theft.</p>
            <p><strong>Financial Loss:</strong> Ransomware through malvertising can result in costly data recovery.</p>
            <p><strong>Device Compromise:</strong> Malicious code can grant attackers remote access.</p>
            <p><strong>Reputation Damage for Sites:</strong> Legitimate sites displaying malvertising can lose user trust.</p>
        </div>

        <h2>How to Recognize and Avoid Malvertising</h2>
        <div class="section">
            <ul>
                <li><strong>Unusual Redirects:</strong> Unexpected page redirects may indicate malvertising.</li>
                <li><strong>Aggressive Pop-Ups:</strong> Suspicious pop-ups and new windows can signal malicious ads.</li>
                <li><strong>Slow Browser Performance:</strong> Slowed or frozen browsers may result from malvertising scripts.</li>
            </ul>
        </div>

        <h2>How to Protect Against Malvertising</h2>
        <div class="section">
            <p><strong>Use Ad Blockers:</strong> Block malicious ads from displaying.</p>
            <p><strong>Keep Software Updated:</strong> Regularly update browsers and plugins to patch vulnerabilities.</p>
            <p><strong>Use Security Software:</strong> Anti-malware tools help detect and block malvertising threats.</p>
            <p><strong>Limit Browser Plugins:</strong> Disable or restrict plugins to reduce vulnerabilities.</p>
            <p><strong>Enable Pop-Up Blockers:</strong> Reduces risk of exposure to malicious ads.</p>
            <p><strong>User Awareness:</strong> Educating users on malvertising risks can reduce interaction with harmful ads.</p>
        </div>

        <!-- Additional Information and Reference Link -->
        <p class="mt-4">
            For further information on malvertising, please visit <a href="https://www.cisa.gov/uscert/ncas/tips/ST18-003" target="_blank" class="text-warning">CISA’s Guide on Malvertising</a>.
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
