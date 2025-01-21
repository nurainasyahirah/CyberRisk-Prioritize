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
    <title>Social Engineering - Cyber Risk Prioritization System</title>
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
        <h1 class="text-center">Social Engineering</h1>
        <p class="text-center">
            Social engineering is a manipulation technique that exploits human psychology to trick people into revealing confidential information or performing actions that compromise security.
        </p>

        <h2>Key Characteristics of Social Engineering</h2>
        <div class="section">
            <p><strong>Psychological Manipulation:</strong> Attackers exploit trust, fear, urgency, curiosity, or empathy to persuade victims into giving up sensitive information or access.</p>
            <p><strong>Non-Technical:</strong> Social engineering relies on human interaction, making it difficult for traditional security measures to detect.</p>
            <p><strong>Personalization:</strong> Attackers often tailor their approach using information from social media or previous breaches.</p>
        </div>

        <h2>Common Social Engineering Techniques</h2>
        <div class="section">
            <p><strong>Phishing:</strong> Attackers impersonate legitimate organizations to obtain sensitive information, such as passwords or credit card details.</p>
            <p><strong>Pretexting:</strong> The attacker creates a fabricated scenario, pretending to be someone trustworthy to gather personal details.</p>
            <p><strong>Baiting:</strong> Entices victims by promising something attractive (e.g., free software) to lure them into revealing information or downloading malware.</p>
            <p><strong>Quid Pro Quo:</strong> Attackers offer a service in exchange for information, such as pretending to be tech support and requesting login details.</p>
            <p><strong>Tailgating (Piggybacking):</strong> This involves following an authorized person into a secure area by pretending to have forgotten their ID or exploiting politeness.</p>
        </div>

        <h2>How to Recognize Social Engineering Attacks</h2>
        <div class="section">
            <ul>
                <li><strong>Unsolicited Requests for Sensitive Information:</strong> Be cautious of unexpected requests for confidential data or access.</li>
                <li><strong>Urgency and Pressure:</strong> Social engineers often create a sense of urgency to prompt quick, unverified action.</li>
                <li><strong>Suspicious Offers:</strong> Be wary of offers that seem too good to be true, especially if they involve sharing personal or login information.</li>
            </ul>
        </div>

        <h2>Preventing Social Engineering Attacks</h2>
        <div class="section">
            <p><strong>Awareness and Training:</strong> Regular training helps employees recognize and respond to social engineering attempts.</p>
            <p><strong>Verification Protocols:</strong> Verify requests, especially those involving sensitive information or access, by contacting the requester through known channels.</p>
            <p><strong>Be Cautious with Personal Information:</strong> Limit the information shared online, as attackers often use social media for personalized attacks.</p>
            <p><strong>Implement Multi-Factor Authentication (MFA):</strong> This can prevent unauthorized access even if login credentials are compromised.</p>
            <p><strong>Use Physical Security Measures:</strong> Restrict access to secure areas and enforce badge or ID verification to prevent tailgating.</p>
        </div>

        <h2>Response to a Social Engineering Attack</h2>
        <div class="section">
            <p><strong>Report Suspicious Activity:</strong> If you suspect a social engineering attempt, report it to your security team immediately.</p>
            <p><strong>Review Access Logs:</strong> Regularly monitor access logs to detect unusual or unauthorized entries.</p>
            <p><strong>Educate Affected Users:</strong> Inform users who may have been targeted to help prevent future attacks.</p>
        </div>

        <!-- Additional Information and Reference Link -->
        <p class="mt-4">
            Social engineering attacks rely on human behavior rather than technical vulnerabilities. For further information on social engineering, please visit <a href="https://www.cisa.gov/social-engineering" target="_blank" class="text-warning">CISA's Social Engineering Guide</a>.
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
