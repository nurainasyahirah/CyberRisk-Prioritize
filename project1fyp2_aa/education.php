<?php
session_start();
include 'db_connection.php'; // Include the database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

include 'navbar.php'; // Include the navbar
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Educational Component - Cyber Risk Prioritization System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('pixelcut-export (1).jpeg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Remove overlay and adjust main container */
        .container {
            max-width: 1400px;
            margin: 30px auto;
            padding: 20px;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(10px);
            border-radius: 30px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            flex: 1;
            margin-bottom: 100px;
        }

        /* Adjust spacing that was previously handled by overlay */
        .main-content {
            padding: 30px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            font-size: 42px;
            font-weight: 700;
            color: white;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .text-center.text-white {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 40px;
            color: rgba(255, 255, 255, 0.95);
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        /* Adjusted button container */
        .button-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 15px;
            padding: 20px;
            max-height: calc(100vh - 250px);
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: #ffffff #800000;
        }

        /* Enhanced scrollbar */
        .button-container::-webkit-scrollbar {
            width: 6px;
        }

        .button-container::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 3px;
        }

        .button-container::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 3px;
        }

        /* Enhanced button styling */
        .small-button {
            padding: 20px;
            font-size: 16px;
            font-weight: 500;
            text-align: center;
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid #dc3545;
            border-radius: 15px;
            color: white;
            transition: all 0.3s ease;
            backdrop-filter: blur(5px);
            box-shadow: 0 0 15px rgba(220, 53, 69, 0.1);
        }

        .small-button:hover {
            background: rgba(255, 255, 255, 0.95);
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2),
                        0 0 20px rgba(220, 53, 69, 0.2);
            border-color: #dc3545;
            color: #dc3545;
        }

        /* Update emoji color on hover */
        .small-button:hover::before {
            filter: none;
        }

        /* Keep existing icon styles */
        .small-button::before {
            content: '🔒';
            display: block;
            font-size: 24px;
            margin-bottom: 10px;
        }

        /* Different icons for different types of threats */
        .small-button[onclick*="insider_threats"]::before { content: '👥'; }
        .small-button[onclick*="malicious_threats"]::before { content: '⚠️'; }
        .small-button[onclick*="phishing"]::before { content: '🎣'; }
        .small-button[onclick*="ransomware"]::before { content: '🔒'; }
        .small-button[onclick*="ddos"]::before { content: '🌐'; }
        .small-button[onclick*="social_engineering"]::before { content: '🎭'; }
        .small-button[onclick*="zero_day"]::before { content: '💻'; }
        .small-button[onclick*="cloud"]::before { content: '☁️'; }
        .small-button[onclick*="iot"]::before { content: '📱'; }
        .small-button[onclick*="crypto"]::before { content: '💰'; }
        .small-button[onclick*="supply_chain"]::before { content: '🔗'; }
        .small-button[onclick*="deepfake"]::before { content: '🎬'; }
        .small-button[onclick*="man_in_the_middle"]::before { content: '🕵️'; }
        .small-button[onclick*="advanced_persistent"]::before { content: '🎯'; }
        .small-button[onclick*="ai_based"]::before { content: '🤖'; }
        .small-button[onclick*="fileless"]::before { content: '👻'; }
        .small-button[onclick*="sql"]::before { content: '📊'; }
        .small-button[onclick*="malvertising"]::before { content: '📢'; }
        .small-button[onclick*="drive_by"]::before { content: '⚡'; }
        .small-button[onclick*="password"]::before { content: '🔑'; }

        /* Add animation for button appearance */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .small-button {
            animation: fadeInUp 0.5s ease forwards;
            animation-delay: calc(var(--order) * 0.1s);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            h1 {
                font-size: 32px;
            }

            .button-container {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }
        }

        @media (max-width: 480px) {
            .button-container {
                grid-template-columns: 1fr;
            }
        }

        /* View Details button - Black */
        .btn-primary {
            background: linear-gradient(135deg, #000000, #333333);
            border: none;
            color: white;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: #000000;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        /* Edit button - Grey */
        .btn-warning {
            background: linear-gradient(135deg, #6c757d, #495057);
            border: none;
            color: white;
            transition: all 0.3s ease;
        }

        .btn-warning:hover {
            background: #6c757d;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(108, 117, 125, 0.3);
        }

        /* Delete button - Red */
        .btn-danger {
            background: linear-gradient(135deg, #dc3545, #c82333);
            border: none;
            color: white;
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            background: #dc3545;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
        }

        /* Common button styles */
        .btn {
            padding: 8px 16px;
            border-radius: 5px;
            font-weight: 500;
            font-size: 14px;
            margin: 0 5px;
        }

        .btn-group {
            display: flex;
            gap: 5px;
        }

        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 15px;
            text-align: center;
            color: white;
            z-index: 1000;
            background: transparent;
        }

        footer p {
            margin: 0;
            font-size: 14px;
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <div class="overlay">
        <div class="container mt-5">
            <h1 class="text-center text-white">Educational Component</h1>
            <p class="text-center text-white">
                Welcome to the Educational Component section. Here you can explore detailed information on various 
                cybersecurity threats to enhance your knowledge and skills.
            </p>

            <!-- Buttons for different educational sections -->
            <div class="button-container">
                <button class="btn small-button" onclick="location.href='insider_threats.php'">Insider Threats</button>
                <button class="btn small-button" onclick="location.href='malicious_threats.php'">Malicious Threats</button>
                <button class="btn small-button" onclick="location.href='phishing_attacks.php'">Phishing Attacks</button>
                <button class="btn small-button" onclick="location.href='ransomware.php'">Ransomware</button>
                <button class="btn small-button" onclick="location.href='ddos_attacks.php'">DDoS Attacks</button>
                <button class="btn small-button" onclick="location.href='social_engineering.php'">Social Engineering</button>
                <button class="btn small-button" onclick="location.href='zero_day_exploits.php'">Zero-Day Exploits</button>
                <button class="btn small-button" onclick="location.href='cloud_security_threats.php'">Cloud Security Threats</button>
                <button class="btn small-button" onclick="location.href='iot_vulnerabilities.php'">IoT Vulnerabilities</button>
                <button class="btn small-button" onclick="location.href='cryptojacking.php'">Cryptojacking</button>
                <button class="btn small-button" onclick="location.href='supply_chain_attacks.php'">Supply Chain Attacks</button>
                <button class="btn small-button" onclick="location.href='deepfakes.php'">Deepfake Attacks</button>
                <button class="btn small-button" onclick="location.href='man_in_the_middle.php'">MITM Attacks</button>
                <button class="btn small-button" onclick="location.href='advanced_persistent_threats.php'">APT</button>
                <button class="btn small-button" onclick="location.href='ai_based_attacks.php'">AI-Based Attacks</button>
                <button class="btn small-button" onclick="location.href='fileless_malware.php'">Fileless Malware</button>
                <button class="btn small-button" onclick="location.href='sql_injections.php'">SQL Injections</button>
                <button class="btn small-button" onclick="location.href='malvertising.php'">Malvertising</button>
                <button class="btn small-button" onclick="location.href='drive_by_downloads.php'">Drive-By Downloads</button>
                <button class="btn small-button" onclick="location.href='password_attacks.php'">Password Attacks</button>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 CyberRisk Prioritize. All Rights Reserved.</p>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
