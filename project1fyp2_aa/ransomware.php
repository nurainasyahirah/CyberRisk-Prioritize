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
    <title>Ransomware - Cyber Risk Prioritization System</title>
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
        <h1 class="text-center">Ransomware</h1>
        <p class="text-center">
            Ransomware is a type of malicious software (malware) designed to block access to a computer system or encrypt the files on it until a ransom is paid. Attackers use ransomware to extort money from individuals, organizations, and government agencies.
        </p>

        <h2>Key Characteristics of Ransomware</h2>

        <!-- File Encryption Section -->
        <div class="section">
            <h3>File Encryption</h3>
            <p>
                Ransomware often works by encrypting files on the infected system, making them unreadable. Victims cannot access these files unless they have the decryption key, which the attacker promises to provide after payment.
            </p>
        </div>

        <!-- System Lockdown Section -->
        <div class="section">
            <h3>System Lockdown</h3>
            <p>
                Some ransomware variants lock the entire system or essential applications, making it impossible to access the device. Victims are shown a ransom note on the screen with instructions on how to pay and recover access.
            </p>
        </div>

        <!-- Ransom Demands Section -->
        <div class="section">
            <h3>Ransom Demands</h3>
            <p>
                Ransomware displays a ransom demand after infecting a system, often with threats to delete or publish sensitive data if the ransom isn’t paid by a deadline. Payment is usually requested in cryptocurrency to keep the attacker anonymous.
            </p>
        </div>

        <h2>Common Types of Ransomware</h2>

        <!-- Crypto Ransomware Section -->
        <div class="section">
            <h3>Crypto Ransomware</h3>
            <p>
                Encrypts files on the device so that users cannot access them without a decryption key.
            </p>
        </div>

        <!-- Locker Ransomware Section -->
        <div class="section">
            <h3>Locker Ransomware</h3>
            <p>
                Locks users out of their systems or certain functions but does not encrypt files. The attacker may prevent access to critical applications, making the system unusable until the ransom is paid.
            </p>
        </div>

        <!-- Double Extortion Ransomware Section -->
        <div class="section">
            <h3>Double Extortion Ransomware</h3>
            <p>
                Not only encrypts data but also steals it. Attackers threaten to publish the stolen data if the ransom is not paid, adding pressure on the victim.
            </p>
        </div>

        <h2>How Ransomware Spreads</h2>

        <!-- Phishing Emails Section -->
        <div class="section">
            <h3>Phishing Emails</h3>
            <p>
                Attackers often send emails with malicious attachments or links that, when opened, install ransomware on the system.
            </p>
        </div>

        <!-- Exploit Kits Section -->
        <div class="section">
            <h3>Exploit Kits</h3>
            <p>
                Tools used by attackers to scan for and exploit vulnerabilities in outdated software, gaining access to the system to install ransomware.
            </p>
        </div>

        <!-- Drive-By Downloads Section -->
        <div class="section">
            <h3>Drive-By Downloads</h3>
            <p>
                Ransomware can be downloaded simply by visiting a compromised website that secretly installs the malware on the user’s device.
            </p>
        </div>

        <h2>How to Protect Against Ransomware</h2>

        <!-- Protection Tips Section -->
        <div class="section">
            <p><strong>Regular Backups:</strong> Regularly back up your files to a secure, offline location. If ransomware encrypts your data, backups allow you to restore files without paying the ransom.</p>
            <p><strong>Use Updated Security Software:</strong> Antivirus and anti-malware programs can detect and block many types of ransomware before they do damage.</p>
            <p><strong>Avoid Clicking Suspicious Links or Attachments:</strong> Be cautious with unsolicited emails, especially those with attachments or links, as these are common ransomware delivery methods.</p>
            <p><strong>Keep Software Up-to-Date:</strong> Install updates and patches regularly to protect against vulnerabilities that ransomware may exploit.</p>
        </div>

        <h2>What to Do in a Ransomware Attack</h2>

        <!-- Ransomware Attack Response Section -->
        <div class="section">
            <p><strong>Disconnect from the Network:</strong> Isolate the infected device from other systems to prevent the ransomware from spreading.</p>
            <p><strong>Do Not Pay the Ransom:</strong> There is no guarantee that paying the ransom will restore access to your files, and it encourages further attacks.</p>
            <p><strong>Seek Professional Help:</strong> Report the incident to cybersecurity professionals or relevant authorities who may help in data recovery and analyzing the attack.</p>
        </div>

        <!-- Additional Information and Reference Link -->
        <p class="mt-4">
            Ransomware attacks have grown in frequency and sophistication, targeting various sectors. For further information on ransomware, please visit <a href="https://www.cisa.gov/ransomware" target="_blank" class="text-warning">CISA's Ransomware page</a>.
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
