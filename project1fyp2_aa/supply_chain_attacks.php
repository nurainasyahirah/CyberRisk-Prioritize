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
    <title>Supply Chain Attacks - Cyber Risk Prioritization System</title>
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
        <h1 class="text-center">Supply Chain Attacks</h1>
        <p class="text-center">
            A supply chain attack targets vulnerabilities in third-party vendors, suppliers, or service providers, allowing attackers to indirectly access the primary target's systems or data.
        </p>

        <h2>Key Characteristics of Supply Chain Attacks</h2>
        <div class="section">
            <p><strong>Indirect Targeting:</strong> Attackers compromise a supplier with access to the target organization, bypassing direct defenses.</p>
            <p><strong>Trust Exploitation:</strong> These attacks exploit trust between the organization and its vendors, making them hard to detect.</p>
            <p><strong>Wide Reach:</strong> Compromised suppliers can affect multiple organizations, spreading the impact broadly.</p>
        </div>

        <h2>How Supply Chain Attacks Work</h2>
        <div class="section">
            <p><strong>Identifying a Vulnerable Supplier:</strong> Attackers find a trusted third party, like a software or hardware provider, with weak defenses.</p>
            <p><strong>Compromising the Supplier’s System:</strong> Attackers infiltrate the supplier’s systems, inserting malicious code or altering updates.</p>
            <p><strong>Propagation to the Target Organization:</strong> The compromised supplier sends infected software updates or hardware to the target organization.</p>
            <p><strong>Exploiting Access:</strong> Attackers use the foothold to steal data, install malware, or access sensitive network areas.</p>
        </div>

        <h2>Types of Supply Chain Attacks</h2>
        <div class="section">
            <p><strong>Software Supply Chain Attacks:</strong> Inserting malicious code into legitimate software updates.</p>
            <p><strong>Hardware Supply Chain Attacks:</strong> Compromising hardware like chips or peripherals to access systems.</p>
            <p><strong>Third-Party Service Provider Attacks:</strong> Compromising a service provider to reach the target organization.</p>
            <p><strong>Outsourced Development Attacks:</strong> Injecting malicious code during the development phase by outsourced teams.</p>
        </div>

        <h2>Notable Supply Chain Attack Examples</h2>
        <div class="section">
            <p><strong>SolarWinds Attack (2020):</strong> Attackers compromised SolarWinds by injecting malicious code into software updates, affecting government agencies and Fortune 500 companies.</p>
            <p><strong>Target Breach (2013):</strong> Attackers accessed Target's network via a third-party HVAC vendor, leading to a significant data breach.</p>
        </div>

        <h2>Impact of Supply Chain Attacks</h2>
        <div class="section">
            <p><strong>Data Breaches:</strong> Attackers gain access to sensitive information, leading to data theft or intellectual property loss.</p>
            <p><strong>Operational Disruptions:</strong> Compromised systems may cause downtime and disrupt business operations.</p>
            <p><strong>Reputational Damage:</strong> Supply chain attacks can erode trust between companies and partners.</p>
            <p><strong>Financial Losses:</strong> Organizations may incur regulatory fines, legal costs, and remediation expenses.</p>
        </div>

        <h2>How to Protect Against Supply Chain Attacks</h2>
        <div class="section">
            <p><strong>Vet and Monitor Vendors:</strong> Conduct thorough assessments of suppliers and vendors to ensure cybersecurity standards are met.</p>
            <p><strong>Use Multi-Layered Security:</strong> Implement firewalls, intrusion detection, and multi-factor authentication to limit damage from a supplier breach.</p>
            <p><strong>Secure Software Development:</strong> Ensure vendors follow secure development practices, such as code signing and vulnerability testing.</p>
            <p><strong>Network Segmentation:</strong> Isolate systems that interact with third-party vendors from critical areas to contain potential threats.</p>
            <p><strong>Regular Patch Management:</strong> Promptly apply security patches to reduce software supply chain risks.</p>
            <p><strong>Zero Trust Architecture:</strong> Employ a model that verifies and monitors access for all devices and users, including third parties.</p>
        </div>

        <!-- Additional Information and Reference Link -->
        <p class="mt-4">
            Supply chain attacks exploit the interconnected nature of business, impacting organizations through their trusted suppliers. For more information on similar threats, visit <a href="https://www.cisa.gov/ransomware" target="_blank" class="text-warning">CISA's Ransomware Guide</a>.
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
