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
    <title>Advanced Persistent Threats (APTs) - Cyber Risk Prioritization System</title>
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
        <h1 class="text-center">Advanced Persistent Threats (APTs)</h1>
        <p class="text-center">
            APTs are sophisticated, long-term cyberattacks that maintain access to a network to steal sensitive information, monitor activities, or cause damage over time. These attacks are methodical and challenging to detect.
        </p>

        <h2>Key Characteristics of APTs</h2>
        <div class="section">
            <p><strong>Advanced Techniques:</strong> Attackers use social engineering, zero-day exploits, and custom malware to bypass defenses.</p>
            <p><strong>Persistence:</strong> Attackers stay within the network undetected for long periods, often months or years.</p>
            <p><strong>Specific Targeting:</strong> APTs typically target high-value organizations such as government agencies or financial institutions.</p>
            <p><strong>Well-Resourced Attackers:</strong> Often associated with nation-states, these attackers have the resources and patience for long-term attacks.</p>
        </div>

        <h2>How APTs Work</h2>
        <div class="section">
            <p><strong>Initial Access:</strong> Gaining entry through phishing emails, software vulnerabilities, or physical access.</p>
            <p><strong>Establishing a Foothold:</strong> Deploying backdoors or rootkits for continued access and concealment.</p>
            <p><strong>Escalation and Lateral Movement:</strong> Attackers escalate privileges and move across the network.</p>
            <p><strong>Data Collection:</strong> Locating and gathering valuable data, which is exfiltrated slowly to avoid detection.</p>
            <p><strong>Maintaining Persistence:</strong> Attackers stay hidden using encrypted channels and disguised network traffic.</p>
            <p><strong>Exfiltration and Cleanup:</strong> Collected data is slowly exfiltrated, and attackers may remove traces of their presence.</p>
        </div>

        <h2>Common Techniques Used in APTs</h2>
        <div class="section">
            <ul>
                <li><strong>Spear Phishing:</strong> Highly targeted phishing to trick specific individuals into revealing credentials or downloading malware.</li>
                <li><strong>Zero-Day Exploits:</strong> Exploiting unknown vulnerabilities in software.</li>
                <li><strong>Custom Malware:</strong> Tailored malware for specific targets and objectives.</li>
                <li><strong>Lateral Movement:</strong> Using techniques like “Pass the Hash” to access valuable systems across the network.</li>
            </ul>
        </div>

        <h2>Notable Examples of APTs</h2>
        <div class="section">
            <p><strong>Stuxnet (2010):</strong> A worm targeting Iranian nuclear facilities, disrupting centrifuge operations. Believed to be state-sponsored.</p>
            <p><strong>APT1 (2013):</strong> A group linked to China, targeting intellectual property and sensitive data from U.S. industries.</p>
            <p><strong>APT28/Fancy Bear:</strong> A Russian group involved in several high-profile attacks, including the 2016 Democratic National Committee email leak.</p>
        </div>

        <h2>Impact of APTs</h2>
        <div class="section">
            <p><strong>Data Theft:</strong> Loss of intellectual property, trade secrets, and classified information.</p>
            <p><strong>Financial Loss:</strong> Costs from stolen data, recovery efforts, and regulatory fines.</p>
            <p><strong>Reputation Damage:</strong> Compromised organizations face potential damage to customer and partner trust.</p>
            <p><strong>Operational Disruption:</strong> Targeting critical infrastructure or sensitive operations, especially in government or defense sectors.</p>
        </div>

        <h2>How to Protect Against APTs</h2>
        <div class="section">
            <p><strong>Implement Strong Authentication:</strong> Use MFA and secure password policies.</p>
            <p><strong>Network Segmentation:</strong> Segregate sensitive networks to limit lateral movement.</p>
            <p><strong>Regular Patch Management:</strong> Promptly apply updates to mitigate zero-day risks.</p>
            <p><strong>Threat Intelligence and Monitoring:</strong> Use tools to detect anomalies or suspicious activity.</p>
            <p><strong>Employee Training:</strong> Educate on phishing awareness and social engineering.</p>
            <p><strong>Incident Response Plan:</strong> Develop and test a response plan for swift reaction in case of a breach.</p>
        </div>

        <!-- Additional Information and Reference Link -->
        <p class="mt-4">
            APTs are challenging to detect and mitigate due to their stealth and persistence. For further information on similar threats, please visit <a href="https://www.cisa.gov/man-middle-attack" target="_blank" class="text-warning">CISA's Man-in-the-Middle Attack Guide</a>.
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
