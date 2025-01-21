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
    <title>Drive-By Downloads - Cyber Risk Prioritization System</title>
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
        <h1 class="text-center">Drive-By Downloads</h1>
        <p class="text-center">
            Drive-By Downloads automatically download malicious software onto a user’s device without consent. This often happens when a user visits a compromised or malicious site.
        </p>

        <h2>How Drive-By Downloads Work</h2>
        <div class="section">
            <ul>
                <li><strong>Compromised Websites:</strong> Attackers inject malicious code into reputable websites or create their own malicious sites.</li>
                <li><strong>Exploiting Vulnerabilities:</strong> The malicious code scans for outdated software on the user’s device.</li>
                <li><strong>Automatic Download:</strong> Malware is downloaded and often executed without the user’s knowledge.</li>
                <li><strong>Malware Execution:</strong> The malware then performs actions like data theft, keylogging, or remote access.</li>
            </ul>
        </div>

        <h2>Common Payloads Delivered by Drive-By Downloads</h2>
        <div class="section">
            <ul>
                <li><strong>Ransomware:</strong> Encrypts files and demands a ransom for decryption.</li>
                <li><strong>Spyware:</strong> Collects personal information, including login credentials and browsing habits.</li>
                <li><strong>Trojan Horses:</strong> Allows attackers to gain remote access to the system.</li>
                <li><strong>Cryptojacking Software:</strong> Uses the device’s resources to mine cryptocurrency.</li>
                <li><strong>Botnet Malware:</strong> Converts the device into part of a botnet for large-scale attacks.</li>
            </ul>
        </div>

        <h2>Why Drive-By Downloads are Dangerous</h2>
        <div class="section">
            <p><strong>No User Interaction Required:</strong> The download and installation occur automatically.</p>
            <p><strong>Stealth:</strong> Users often have no signs of infection, making it hard to detect.</p>
            <p><strong>Exploit Kits:</strong> Attackers use exploit kits to target common vulnerabilities, making the attack effective and scalable.</p>
        </div>

        <h2>Common Sources of Drive-By Downloads</h2>
        <div class="section">
            <ul>
                <li><strong>Compromised Websites:</strong> Trusted sites that attackers have injected with malicious code.</li>
                <li><strong>Malicious Ads (Malvertising):</strong> Ads with hidden code that redirects users to exploit kits.</li>
                <li><strong>Phishing Emails:</strong> Links redirecting users to malicious sites.</li>
                <li><strong>Fake Software Updates:</strong> Pop-ups claiming an update is needed but delivering malware.</li>
            </ul>
        </div>

        <h2>How to Protect Against Drive-By Downloads</h2>
        <div class="section">
            <ul>
                <li><strong>Keep Software Updated:</strong> Regularly update your OS, browsers, and plugins.</li>
                <li><strong>Use an Ad Blocker:</strong> Reduces exposure to malvertising.</li>
                <li><strong>Employ Antivirus Software:</strong> Use real-time scanning to detect and block threats.</li>
                <li><strong>Disable Unnecessary Plugins:</strong> Limiting plugins like Flash and Java reduces risks.</li>
                <li><strong>Avoid Suspicious Links and Emails:</strong> Be cautious with unfamiliar links and attachments.</li>
                <li><strong>Enable Web Filtering:</strong> Organizations can block access to known malicious sites.</li>
            </ul>
        </div>

        <h2>How to Recognize a Potential Drive-By Download Infection</h2>
        <div class="section">
            <p><strong>Unexplained Device Slowdowns:</strong> Malware can use system resources, making devices slower.</p>
            <p><strong>Unwanted Pop-Ups or Redirects:</strong> Frequent pop-ups or redirects can signal infection.</p>
            <p><strong>Unusual Network Activity:</strong> High network usage when idle may indicate malware activity.</p>
        </div>

        <h2>Example of a Drive-By Download Attack</h2>
        <div class="section">
            <p>A user visits a legitimate website that unknowingly hosts a malicious advertisement. The ad redirects the browser to a malicious site with an exploit kit, which finds an outdated plugin and silently installs spyware on the user’s computer.</p>
        </div>

        <!-- Additional Information and Reference Link -->
        <p class="mt-4">
            For further information on Drive-By Downloads, visit <a href="https://www.cisa.gov/uscert/ncas/tips/ST18-004" target="_blank" class="text-warning">CISA’s Guide on Drive-By Downloads</a>.
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
