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
    <title>DDoS Attacks - Cyber Risk Prioritization System</title>
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
        <h1 class="text-center">DDoS Attacks</h1>
        <p class="text-center">
            A Distributed Denial of Service (DDoS) attack is a malicious attempt to disrupt the normal traffic of a targeted server, service, or network by overwhelming it with a flood of internet traffic from multiple sources.
        </p>

        <h2>How a DDoS Attack Works</h2>
        <div class="section">
            <p>
                In a DDoS attack, a large number of compromised devices, often part of a "botnet," are used to send vast amounts of traffic to the target, overwhelming its infrastructure. This can cause the server or network to slow down or crash, denying legitimate users access to the service.
            </p>
        </div>

        <h2>Key Characteristics of DDoS Attacks</h2>
        <div class="section">
            <p><strong>Multiple Sources:</strong> DDoS attacks are distributed, meaning they come from many different IP addresses, often globally. Attackers use botnets to make these attacks difficult to trace.</p>
            <p><strong>Overwhelming Traffic:</strong> The main goal is to flood the target with so much traffic that it cannot handle legitimate requests, straining resources.</p>
            <p><strong>Duration and Persistence:</strong> DDoS attacks can last from minutes to days and may be continuous or intermittent, depending on the attackers’ goals.</p>
        </div>

        <h2>Common Types of DDoS Attacks</h2>
        <div class="section">
            <p><strong>Volume-Based Attacks:</strong> These flood the bandwidth of the target network, like UDP floods and ICMP floods.</p>
            <p><strong>Protocol Attacks:</strong> These exploit weaknesses in network protocols, such as SYN floods, where attackers send numerous connection requests but never complete the handshake, consuming server resources.</p>
            <p><strong>Application Layer Attacks:</strong> These target specific applications, like HTTP floods, where high numbers of requests are sent to exhaust server resources.</p>
        </div>

        <h2>How to Identify a DDoS Attack</h2>
        <div class="section">
            <ul>
                <li>Unusually slow network performance.</li>
                <li>Inability to access a website or service.</li>
                <li>A large number of requests from multiple IP addresses in a short period.</li>
                <li>Sudden spikes in network traffic.</li>
            </ul>
        </div>

        <h2>How to Prevent and Mitigate DDoS Attacks</h2>
        <div class="section">
            <p><strong>Use a Content Delivery Network (CDN):</strong> CDNs distribute content across multiple servers, making it harder for attackers to overwhelm a single target.</p>
            <p><strong>Deploy DDoS Protection Services:</strong> Many cybersecurity providers offer services to detect and mitigate DDoS attacks.</p>
            <p><strong>Rate Limiting:</strong> Limiting the number of requests a server accepts from a single IP address can reduce the impact of an attack.</p>
            <p><strong>Firewalls and Intrusion Detection Systems:</strong> These tools can detect unusual traffic patterns and block malicious requests.</p>
            <p><strong>Increase Bandwidth:</strong> Scaling up bandwidth can help absorb the initial traffic surge, though it may not fully stop a large-scale attack.</p>
        </div>

        <h2>Response to a DDoS Attack</h2>
        <div class="section">
            <p><strong>Identify the Attack Early:</strong> Monitoring network traffic helps detect an attack as it begins.</p>
            <p><strong>Activate DDoS Protection Services:</strong> If using a DDoS protection service, engage it immediately.</p>
            <p><strong>Redirect Traffic:</strong> Redirecting traffic or temporarily blocking certain regions may reduce the attack's impact.</p>
            <p><strong>Notify the ISP:</strong> ISPs often have measures to mitigate DDoS attacks and can assist in response.</p>
        </div>

        <!-- Additional Information and Reference Link -->
        <p class="mt-4">
            DDoS attacks are a major threat, leading to downtime, revenue loss, and brand damage. For further information, please visit <a href="https://www.cloudflare.com/learning/ddos/what-is-a-ddos-attack/" target="_blank" class="text-warning">Cloudflare's DDoS Guide</a>.
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
