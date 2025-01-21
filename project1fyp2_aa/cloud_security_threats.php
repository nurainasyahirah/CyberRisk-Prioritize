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
    <title>Cloud Security Threats - Cyber Risk Prioritization System</title>
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
        <h1 class="text-center">Cloud Security Threats</h1>
        <p class="text-center">
            Cloud security threats are risks that target cloud computing environments, threatening data protection, access control, and privacy. Understanding these threats is essential for maintaining security in cloud-based systems.
        </p>

        <h2>Key Cloud Security Threats</h2>
        <div class="section">
            <p><strong>Data Breaches:</strong> Unauthorized access to sensitive data due to misconfigurations, poor access control, or vulnerabilities. This can lead to financial loss, legal issues, and damage to reputation.</p>
            <p><strong>Account Hijacking:</strong> Attackers gain control of user accounts using stolen credentials, allowing them to manipulate or steal information within a cloud environment.</p>
            <p><strong>Insider Threats:</strong> Employees, contractors, or vendors with legitimate access may intentionally or unintentionally cause security breaches, which are challenging to detect.</p>
            <p><strong>Insecure APIs:</strong> Vulnerabilities in APIs can expose cloud environments to attacks, leading to data leaks or unauthorized access.</p>
            <p><strong>Misconfiguration:</strong> Improper configurations (e.g., public access to storage buckets) expose sensitive data to unauthorized users and are a common cause of cloud data breaches.</p>
            <p><strong>Denial of Service (DoS) Attacks:</strong> Overloading cloud services with traffic, making them inaccessible to legitimate users and potentially incurring extra costs.</p>
            <p><strong>Data Loss:</strong> Data in the cloud can be lost due to accidental deletion, hardware failure, or lack of backups.</p>
            <p><strong>Insufficient Identity and Access Management (IAM):</strong> Weak IAM policies can lead to unauthorized access and increased risk of data compromise.</p>
            <p><strong>Compliance Violations:</strong> Failure to meet regulatory requirements (e.g., GDPR, HIPAA) can lead to legal and financial consequences.</p>
        </div>

        <h2>How to Mitigate Cloud Security Threats</h2>
        <div class="section">
            <p><strong>Use Strong Access Controls:</strong> Implement MFA, role-based access control (RBAC), and strong password policies to prevent unauthorized access.</p>
            <p><strong>Encrypt Data:</strong> Encrypt data in transit and at rest to protect it from unauthorized access even in case of a breach.</p>
            <p><strong>Regular Security Audits and Compliance Checks:</strong> Conduct regular audits to identify vulnerabilities and ensure cloud configurations are secure.</p>
            <p><strong>Monitor for Suspicious Activity:</strong> Use intrusion detection and monitoring tools to identify unusual behavior in your cloud environment.</p>
            <p><strong>Implement Secure API Practices:</strong> Secure API keys, limit access permissions, and use strong authentication to protect APIs.</p>
            <p><strong>Backup and Disaster Recovery:</strong> Establish backup routines and disaster recovery plans to ensure data availability in case of data loss.</p>
            <p><strong>Train Employees on Cloud Security:</strong> Educate employees on cloud security best practices, especially for threats like phishing and social engineering.</p>
            <p><strong>Engage with Trusted Cloud Providers:</strong> Choose cloud providers with strong security credentials and compliance certifications.</p>
        </div>

        <h2>Common Cloud Security Models</h2>
        <div class="section">
            <p><strong>Shared Responsibility Model:</strong> Cloud providers and users share security responsibility. Providers secure the infrastructure, while users secure their data and applications.</p>
            <p><strong>Zero Trust Model:</strong> Assumes no entity, internal or external, can be trusted by default. All access is continuously verified and monitored, making it suitable for cloud environments.</p>
        </div>

        <!-- Additional Information and Reference Link -->
        <p class="mt-4">
            Cloud security is essential for protecting sensitive data and ensuring operational continuity. For more information on cloud security, please visit <a href="https://www.cisa.gov/cloud-security-basics" target="_blank" class="text-warning">CISA's Cloud Security Guide</a>.
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
