<?php
session_start();
include 'db_connection.php'; // Include the database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Get the current user's name (assuming stored in session)
$user_name = $_SESSION['user_name'] ?? 'User'; // Default to 'User' if the name is not set
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cyber Risk Prioritization System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
            color: #e0e0e0;
        }

        body {
            background-image: url('pixelcut-export (1).jpeg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: -1;
        }

        .d-flex {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .flex-grow-1 {
            flex-grow: 1;
        }

        footer {
            background: #000;
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }

        h1, h2, p {
            color: #ffffff;
            z-index: 1;
        }

        .nav-buttons {
            text-align: center;
            margin-bottom: 20px;
        }

        .section {
            margin-bottom: 50px;
            padding: 25px;
            background-color: rgba(0, 0, 0, 0.6);
            border-radius: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .section:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.4);
        }

        .nav-buttons .btn {
            margin: 8px;
            padding: 12px 24px;
            border-radius: 25px;
            transition: all 0.3s ease;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .nav-buttons .btn:hover {
            background-color: #fff;
            color: #000;
            transform: translateY(-2px);
        }

        .welcome-message {
            background: linear-gradient(145deg, rgba(0,0,0,0.8), rgba(0,0,0,0.9));
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            margin-top: 40px;
            text-align: center;
            padding: 30px;
            border-radius: 15px;
        }

        .welcome-message h1 {
            margin-bottom: 20px;
        }

        .welcome-message .lead {
            max-width: 800px;
            margin: 0 auto;
        }

        /* Add progress indicators */
        .progress-indicator {
            height: 4px;
            width: 50px;
            background: #007bff;
            margin: 15px 0;
        }

        /* Add icons to sections */
        .section-icon {
            font-size: 3rem;
            margin-bottom: 20px;
            color: #dc3545;
            transition: transform 0.3s ease;
        }

        .section:hover .section-icon {
            transform: scale(1.2);
            color: #c82333;
        }

        .back-to-top {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: rgba(220, 53, 69, 0.8); /* Red with some transparency */
            color: white;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .back-to-top:hover {
            background-color: #dc3545;
            transform: translateY(-3px);
        }

        .section {
            position: relative; /* Add this to position the button relative to section */
        }
    </style>
    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="d-flex flex-column min-vh-100">
        <!-- Navbar -->
        <?php include 'navbar.php'; ?>

        <!-- Welcome Message -->
        <div class="container welcome-message">
            <h1>Welcome, <?= htmlspecialchars($user_name) ?>!</h1>
            <p class="lead">
                We're glad to have you at the <strong>Cyber Risk Prioritization System</strong>. 
                This platform helps you assess, analyze, and prioritize risks effectively. 
            </p>
            <p>
                Use the navigation options below to explore, create new assessments, and build a resilient cybersecurity strategy.
            </p>
        </div>

        <!-- Navigation Buttons -->
        <div class="container nav-buttons mt-4">
            <a href="#riskAssessment" class="btn btn-outline-light">Risk Assessment</a>
            <a href="#riskPlanning" class="btn btn-outline-light">Risk Planning</a>
            <a href="#riskTreatment" class="btn btn-outline-light">Risk Treatment</a>
            <a href="#riskMonitoring" class="btn btn-outline-light">Risk Monitoring</a>
            <a href="#riskCommunication" class="btn btn-outline-light">Risk Communication</a>
            <a href="#incidentResponse" class="btn btn-outline-light">Incident Response</a>
            <a href="#standardsCompliance" class="btn btn-outline-light">Standards & Compliance</a>
            <a href="#continuousImprovement" class="btn btn-outline-light">Continuous Improvement</a>
        </div>

        <!-- Main content -->
        <div class="container flex-grow-1">
            <section id="riskAssessment" class="section">
                <button class="back-to-top" onclick="scrollToTop()">
                    <i class="fas fa-arrow-up"></i>
                </button>
                <i class="fas fa-shield-alt section-icon"></i>
                <div class="progress-indicator"></div>
                <h2>Risk Assessment</h2>
                <p><strong>Risk Identification:</strong> Identifying potential threats such as phishing, DDoS attacks, insider threats, and more.</p>
                <p><strong>Risk Analysis:</strong> Assessing the likelihood and impact of risks on the business.</p>
                <p><strong>Risk Prioritization:</strong> Ranking risks based on their exposure.</p>
            </section>

            <section id="riskPlanning" class="section">
                <button class="back-to-top" onclick="scrollToTop()">
                    <i class="fas fa-arrow-up"></i>
                </button>
                <i class="fas fa-tasks section-icon"></i>
                <div class="progress-indicator"></div>
                <h2>Risk Planning</h2>
                <p>Developing action plans for high-priority risks and including contingency plans for each threat.</p>
            </section>

            <section id="riskTreatment" class="section">
                <button class="back-to-top" onclick="scrollToTop()">
                    <i class="fas fa-arrow-up"></i>
                </button>
                <i class="fas fa-band-aid section-icon"></i>
                <div class="progress-indicator"></div>
                <h2>Risk Treatment</h2>
                <p><strong>Risk Avoidance:</strong> Implementing measures to prevent risks.</p>
                <p><strong>Risk Transfer:</strong> Shifting financial impact through insurance or outsourcing.</p>
                <p><strong>Risk Reduction:</strong> Reducing the probability or impact of risks.</p>
                <p><strong>Risk Acceptance:</strong> Acknowledging unavoidable risks.</p>
            </section>

            <section id="riskMonitoring" class="section">
                <button class="back-to-top" onclick="scrollToTop()">
                    <i class="fas fa-arrow-up"></i>
                </button>
                <i class="fas fa-chart-line section-icon"></i>
                <div class="progress-indicator"></div>
                <h2>Risk Monitoring</h2>
                <p>Establishing a continuous monitoring framework to track identified risks and reviewing control effectiveness.</p>
            </section>

            <section id="riskCommunication" class="section">
                <button class="back-to-top" onclick="scrollToTop()">
                    <i class="fas fa-arrow-up"></i>
                </button>
                <i class="fas fa-comments section-icon"></i>
                <div class="progress-indicator"></div>
                <h2>Risk Communication</h2>
                <p>Communicating risks and mitigation strategies to stakeholders, using visual tools like heat maps for clarity.</p>
            </section>

            <section id="incidentResponse" class="section">
                <button class="back-to-top" onclick="scrollToTop()">
                    <i class="fas fa-arrow-up"></i>
                </button>
                <i class="fas fa-exclamation-triangle section-icon"></i>
                <div class="progress-indicator"></div>
                <h2>Incident Response</h2>
                <p>Creating structured protocols for handling incidents and performing post-incident reviews to improve policies.</p>
            </section>

            <section id="standardsCompliance" class="section">
                <button class="back-to-top" onclick="scrollToTop()">
                    <i class="fas fa-arrow-up"></i>
                </button>
                <i class="fas fa-check-circle section-icon"></i>
                <div class="progress-indicator"></div>
                <h2>Standards & Compliance</h2>
                <p>Selecting appropriate frameworks like NIST, ISO 27001, and ensuring legal compliance.</p>
            </section>

            <section id="continuousImprovement" class="section">
                <button class="back-to-top" onclick="scrollToTop()">
                    <i class="fas fa-arrow-up"></i>
                </button>
                <i class="fas fa-sync-alt section-icon"></i>
                <div class="progress-indicator"></div>
                <h2>Continuous Improvement</h2>
                <p>Regularly reviewing policies and processes and incorporating lessons learned to improve resilience.</p>
            </section>
        </div>

        <!-- Footer -->
        <footer>
            <div class="container">
                &copy; 2024 CyberRisk Prioritize. All Rights Reserved.
            </div>
        </footer>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <script>
    // Add smooth scrolling to navigation buttons
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    // Add animation on scroll
    window.addEventListener('scroll', function() {
        document.querySelectorAll('.section').forEach(section => {
            const rect = section.getBoundingClientRect();
            if (rect.top < window.innerHeight - 100) {
                section.style.opacity = '1';
                section.style.transform = 'translateY(0)';
            }
        });
    });

    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }
    </script>
</body>
</html>
