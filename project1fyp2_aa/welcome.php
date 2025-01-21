<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cyber Risk Prioritization System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        /* Enhanced body styling */
        body {
            background-image: url('pixelcut-export (1).jpeg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: white;
            position: relative;
            z-index: 1;
            font-family: 'Poppins', sans-serif; /* Adding modern font */
        }

        /* Dark overlay for the entire page */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7); /* Dark overlay */
            z-index: -1; /* Place it behind the content */
        }

        /* Enhanced welcome section */
        .welcome-section {
            padding: 80px 20px; /* Reduced top padding */
            text-align: left;
            color: white;
            position: relative;
            animation: fadeIn 1s ease-in;
            margin-top: -50px; /* Move content up */
        }

        .welcome-section h1 {
            font-size: 3.8rem; /* Slightly larger font */
            font-weight: 800;
            line-height: 1.1; /* Tighter line height */
            margin-bottom: 1.2rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .welcome-section p {
            font-size: 1.25rem;
            margin-top: 10px;
            color: #e0e0e0; /* Slightly lighter text for readability */
        }

        /* Smaller subtitle styling */
        .welcome-section .subtitle {
            font-size: 1rem;
            margin-top: 10px;
            color: #cccccc; /* Even lighter for subtitle */
        }

        /* Set max-width for the welcome text to limit width */
        .welcome-section .welcome-text {
            max-width: 800px; /* Increased max-width */
            margin-top: 20px; /* Add some space from navbar */
        }

        /* Enhanced button styling */
        .begin-journey-btn {
            display: inline-block;
            padding: 18px 45px;
            background: linear-gradient(45deg, #800000, #A00000); /* Gradient background */
            color: white;
            font-size: 1.2rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: bold;
            margin-top: 30px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(128, 0, 0, 0.3); /* Add shadow */
        }

        .begin-journey-btn:hover {
            background: linear-gradient(45deg, #A00000, #800000);
            transform: translateY(-2px); /* Slight lift effect */
            box-shadow: 0 6px 20px rgba(128, 0, 0, 0.4);
        }

        /* Enhanced section styling */
        .horizontal-section {
            padding: 120px 20px;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .horizontal-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: -1;
        }

        /* Right-aligning content for the What We Do section */
        #what-we-do p {
            text-align: right;
        }

        .horizontal-section h2 {
            font-size: 2rem;
            margin-bottom: 20px;
            text-align: right; /* Align the heading to the right */
        }

        .horizontal-section p {
            font-size: 1.2rem;
            color: #e0e0e0; /* Lighter text to ensure readability */
        }

        /* Left-aligning content for the About Us section */
        #about {
            padding: 150px 20px;
            text-align: left;
            margin: 0; /* Remove default margins */
        }

        #about h1 {
            margin-left: 20px; /* Add a small margin to the left for spacing */
        }

        #about p {
            margin-left: 20px; /* Add a small margin to the left for spacing */
            max-width: 80%; /* Ensure the paragraph doesn't stretch too far */
        }

        /* Enhanced navbar */
        .navbar {
            padding: 25px 0; /* Slightly increased navbar padding */
            transition: all 0.3s ease;
            background: linear-gradient(180deg, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.7) 50%, rgba(0,0,0,0) 100%);
            margin-bottom: 30px; /* Add some space below navbar */
        }

        .navbar.scrolled {
            background: rgba(0, 0, 0, 0.9);
            padding: 15px 0;
        }

        .navbar .nav-link {
            color: white; /* White text for navbar links */
            font-size: 1.2rem; /* Slightly larger font size */
            margin-right: 15px; /* Add spacing between navbar items */
        }

        .navbar .nav-link:hover {
            color: lightgray; /* Light gray color on hover */
        }

        /* Add a thin white line under the navbar */
        .navbar::after {
            content: '';
            display: block;
            width: 100%;
            height: 1px; /* Height of the thin line */
            background-color: white; /* White color for the line */
            position: absolute;
            bottom: 0;
            left: 0;
        }

        /* Footer styling with black background */
        footer {
            background-color: #000000; /* Black footer background */
            text-align: center;
            padding: 20px;
            color: white;
        }

        /* Add animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">CyberRisk Prioritize</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#what-we-do">What We Do</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Welcome Section (First Horizontal Section) -->
    <section class="welcome-section">
        <div class="welcome-text">
            <h1>Empowering Smarter Decisions,<br>Securing a Safer Future</h1>
            <p class="subtitle">Welcome to the Cyber Risk Prioritization System.<br>Helping students learn risk management and prioritize cyber threats effectively.</p>
            <a href="login.php" class="begin-journey-btn">Begin Journey</a> <!-- Oval shaped button linking to login page -->
        </div>
    </section>

    <!-- What We Do Section (Second Horizontal Section) -->
    <section id="what-we-do" class="horizontal-section">
        <div class="container">
            <h2>What We Do</h2>
            <p>At the Cyber Risk Prioritization System, we provide a platform for students <br>to enhance their decision-making abilities in cybersecurity.<br> Our system allows users to create risk assessments,<br> prioritize threats, and learn from real-world scenarios.</p>
        </div>
    </section>

    <!-- About Section (Third Horizontal Section) -->
    <section id="about" class="horizontal-section">
        <div class="container">
            <h1>About Us</h1>
            <p>This platform is developed to assist cybersecurity students <br>in practicing risk management techniques. <br>By simulating real-world environments, <br>students can gain hands-on experience in evaluating <br>and prioritizing risks in a controlled setting.</p>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Cyber Risk Prioritization System. All Rights Reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                document.querySelector('.navbar').classList.add('scrolled');
            } else {
                document.querySelector('.navbar').classList.remove('scrolled');
            }
        });
    </script>
</body>
</html>
