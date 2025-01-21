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
    <title>Phishing Attacks - Cyber Risk Prioritization System</title>
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
        <h1 class="text-center">Phishing Attacks</h1>
        <p class="text-center">
            Phishing attacks are a type of cyber attack where attackers impersonate legitimate organizations or individuals to deceive people into revealing sensitive information, such as usernames, passwords, and credit card details.
        </p>

        <h2>Key Characteristics of Phishing Attacks</h2>

        <!-- Deceptive Emails or Messages Section -->
        <div class="section">
            <h3>Deceptive Emails or Messages</h3>
            <p>
                Attackers often send emails, text messages, or social media messages that appear to be from trusted sources. These messages contain urgent language to prompt quick action.
            </p>
        </div>

        <!-- Fake Websites Section -->
        <div class="section">
            <h3>Fake Websites</h3>
            <p>
                Phishing messages often include links to fake websites that look nearly identical to legitimate ones, tricking users into entering their credentials or other personal information.
            </p>
        </div>

        <!-- Attachment-Based Phishing Section -->
        <div class="section">
            <h3>Attachment-Based Phishing</h3>
            <p>
                Sometimes, phishing emails contain malicious attachments that, once opened, can install malware on the user's device or exploit vulnerabilities to steal information.
            </p>
        </div>

        <!-- Spear Phishing Section -->
        <div class="section">
            <h3>Spear Phishing</h3>
            <p>
                A targeted form of phishing where attackers customize messages for specific individuals, often by gathering information about the target from social media or other sources. Spear phishing is harder to detect.
            </p>
        </div>

        <!-- Whaling Section -->
        <div class="section">
            <h3>Whaling</h3>
            <p>
                A type of phishing attack that specifically targets high-level executives or important personnel within an organization, aiming to gain access to sensitive company information or finances.
            </p>
        </div>

        <h2>How to Recognize Phishing Attacks</h2>

        <div class="section">
            <p><strong>Check for Spelling and Grammar Errors:</strong> Many phishing emails contain noticeable errors.</p>
            <p><strong>Verify URLs:</strong> Hover over links to see if the URL matches the legitimate site.</p>
            <p><strong>Be Cautious of Urgent Language:</strong> Messages that create urgency or fear (e.g., “Your account will be closed unless you act now”) are often phishing attempts.</p>
            <p><strong>Check the Sender’s Email Address:</strong> The email address might have slight alterations to appear legitimate (e.g., using a zero instead of an "O").</p>
        </div>

        <h2>Preventing Phishing Attacks</h2>

        <div class="section">
            <p><strong>Use Multi-Factor Authentication (MFA):</strong> Adds an extra layer of security by requiring additional verification.</p>
            <p><strong>Be Cautious with Links and Attachments:</strong> Avoid clicking on links or downloading attachments from unknown sources.</p>
            <p><strong>Regular Security Training:</strong> Many organizations conduct phishing simulations and training to help users recognize and avoid phishing scams.</p>
            <p><strong>Install Security Software:</strong> Anti-phishing and antivirus software can help detect and block phishing attempts.</p>
        </div>

        <!-- Additional Information and Reference Link -->
        <p class="mt-4">
            Phishing is one of the most common and effective cyber attack methods due to its simplicity and reliance on human error. For further information on phishing attacks, please visit <a href="https://www.cisa.gov/topics/cyber-threats/phishing" target="_blank" class="text-warning">CISA's Phishing page</a>.
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
