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
    <title>SQL Injections - Cyber Risk Prioritization System</title>
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
        <h1 class="text-center">SQL Injections</h1>
        <p class="text-center">
            SQL Injection (SQLi) is an attack technique that allows attackers to insert malicious SQL code into queries, potentially granting unauthorized access to data, modifying database contents, or even deleting information.
        </p>

        <h2>How SQL Injection Works</h2>
        <div class="section">
            <p>When an application does not sanitize user inputs (like form fields, URLs, or cookies), attackers can inject SQL code. This code is then executed by the database as if it were a legitimate query.</p>
            <pre><code>SELECT * FROM users WHERE username = 'user' AND password = 'password';</code></pre>
            <p>Malicious input can change the query to bypass authentication:</p>
            <pre><code>SELECT * FROM users WHERE username = '' OR '1'='1' AND password = '';</code></pre>
            <p>This allows unauthorized access since <code>1=1</code> is always true.</p>
        </div>

        <h2>Types of SQL Injections</h2>
        <div class="section">
            <ul>
                <li><strong>In-band SQLi (Classic SQLi):</strong> Attacker uses the same communication channel for injecting code and retrieving data.</li>
                <li><strong>Blind SQLi:</strong> Attacker infers data by observing application behavior without seeing database errors.</li>
                <li><strong>Out-of-band SQLi:</strong> Attacker uses a separate channel, such as DNS requests, to extract data.</li>
            </ul>
        </div>

        <h2>Impact of SQL Injections</h2>
        <div class="section">
            <p><strong>Data Theft:</strong> Access to sensitive data, including personal or financial information.</p>
            <p><strong>Data Manipulation:</strong> Attacker can modify or delete records, causing potential data loss.</p>
            <p><strong>Unauthorized Access:</strong> Can lead to privilege escalation and administrative control.</p>
            <p><strong>Reputation Damage:</strong> Exposing customer data can harm trust and violate compliance regulations.</p>
        </div>

        <h2>How to Detect SQL Injection</h2>
        <div class="section">
            <ul>
                <li><strong>Error Messages:</strong> Unexpected SQL errors in the application may reveal SQLi attempts.</li>
                <li><strong>Unexpected Behaviors:</strong> Unusual results or bypassing login forms can signal SQL injection.</li>
                <li><strong>Log Analysis:</strong> Check for unusual or suspicious inputs in logs.</li>
                <li><strong>Automated Tools:</strong> Tools like SQLMap can scan for SQLi vulnerabilities.</li>
            </ul>
        </div>

        <h2>How to Prevent SQL Injection</h2>
        <div class="section">
            <p><strong>Use Prepared Statements:</strong> Parameterized queries prevent SQL code injection.</p>
            <pre><code>$stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
$stmt->execute([':username' => $username, ':password' => $password]);</code></pre>
            <p><strong>Input Validation and Sanitization:</strong> Validate and sanitize all user inputs.</p>
            <p><strong>Use Stored Procedures:</strong> Limits dynamic SQL and reduces injection risks.</p>
            <p><strong>Limit Database Permissions:</strong> Restrict database accounts to the minimum privileges needed.</p>
            <p><strong>Implement Web Application Firewalls (WAFs):</strong> Detect and block SQLi attempts.</p>
            <p><strong>Regular Code Reviews and Testing:</strong> Frequent security audits and penetration testing help identify vulnerabilities.</p>
        </div>

        <!-- Additional Information and Reference Link -->
        <p class="mt-4">
            SQL Injection is a common and dangerous vulnerability. For further information, please visit <a href="https://owasp.org/www-project-top-ten/2017/A1_2017-Injection" target="_blank" class="text-warning">OWASP’s Guide on Injection Attacks</a>.
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
