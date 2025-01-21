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
    <title>IoT Vulnerabilities - Cyber Risk Prioritization System</title>
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
        <h1 class="text-center">IoT Vulnerabilities</h1>
        <p class="text-center">
            Internet of Things (IoT) devices are increasingly targeted for cyber-attacks due to weak security configurations, limited updates, and accessible locations. Understanding these vulnerabilities is essential to protect IoT environments effectively.
        </p>

        <h2>Key IoT Vulnerabilities</h2>
        <div class="section">
            <p><strong>Weak Authentication and Authorization:</strong> Lack of strong authentication mechanisms, such as multi-factor authentication (MFA), makes it easier for attackers to gain unauthorized access.</p>
            <p><strong>Unencrypted Data Transmission:</strong> IoT devices that do not encrypt data can expose sensitive information to interception.</p>
            <p><strong>Inadequate Patch Management:</strong> Many IoT devices lack regular updates, leaving them vulnerable to known security flaws.</p>
            <p><strong>Poor Physical Security:</strong> IoT devices in accessible locations are vulnerable to tampering or unauthorized access.</p>
            <p><strong>Insecure APIs:</strong> If APIs used by IoT devices are insecure, they can expose devices to attacks and data leaks.</p>
            <p><strong>Hardcoded Credentials:</strong> Devices with default usernames and passwords are easy targets for attackers.</p>
            <p><strong>Insufficient Security Configurations:</strong> Devices with weak or disabled security settings remain exposed if users don’t change these defaults.</p>
            <p><strong>Device Constraints:</strong> Limited processing power in IoT devices restricts their ability to implement strong security measures.</p>
            <p><strong>Network Vulnerabilities:</strong> Shared network connections may expose IoT devices if the network itself is insecure.</p>
        </div>

        <h2>Common IoT Attacks Exploiting Vulnerabilities</h2>
        <div class="section">
            <p><strong>DDoS (Distributed Denial of Service):</strong> Compromised IoT devices are used in botnets to overwhelm target servers with traffic.</p>
            <p><strong>Man-in-the-Middle (MitM):</strong> Attackers intercept and manipulate data transmitted between IoT devices and servers.</p>
            <p><strong>Device Hijacking:</strong> Attackers gain control of an IoT device to access data or use it for malicious purposes.</p>
            <p><strong>Firmware Manipulation:</strong> Altering IoT device firmware can lead to unauthorized control or data breaches.</p>
            <p><strong>Ransomware Attacks:</strong> Ransomware targeting IoT devices can lock them down and demand ransom for access restoration.</p>
        </div>

        <h2>How to Mitigate IoT Vulnerabilities</h2>
        <div class="section">
            <p><strong>Use Strong Authentication:</strong> Implement complex passwords and multi-factor authentication (MFA) for IoT devices.</p>
            <p><strong>Encrypt Data Transmission:</strong> Ensure all data sent between IoT devices and networks is encrypted to prevent interception.</p>
            <p><strong>Implement Regular Patching:</strong> Update firmware regularly and apply patches to address security flaws.</p>
            <p><strong>Change Default Credentials:</strong> Replace default usernames and passwords with strong, unique credentials.</p>
            <p><strong>Use Secure Networks:</strong> Connect IoT devices to private networks with firewalls and isolate them from critical systems.</p>
            <p><strong>Monitor for Suspicious Activity:</strong> Use intrusion detection systems (IDS) to detect unusual behavior from IoT devices.</p>
            <p><strong>Network Segmentation:</strong> Segment IoT devices on a separate network to limit the damage if a device is compromised.</p>
            <p><strong>Select Secure IoT Devices:</strong> Choose reputable devices with strong security practices and regular updates.</p>
        </div>

        <!-- Additional Information and Reference Link -->
        <p class="mt-4">
            IoT security is essential for protecting both personal data and critical infrastructure. For more information on IoT security best practices, please visit <a href="https://www.cisa.gov/iot-security" target="_blank" class="text-warning">CISA's IoT Security Guide</a>.
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
