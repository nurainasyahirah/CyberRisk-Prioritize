<?php
session_start();
include 'db_connection.php'; // Include the database connection

// Step 1: Check if the email is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['step']) && $_POST['step'] == 'email') {
    $email = $_POST['email'];
    
    // Prepare SQL to fetch user by email
    $stmt = $conn->prepare("SELECT id, security_q1, security_q2 FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id_reset'] = $user['id'];
        $_SESSION['security_q1'] = $user['security_q1'];
        $_SESSION['security_q2'] = $user['security_q2'];
        $step = 'questions';
    } else {
        $error = "Email not found.";
    }

    $stmt->close();
}

// Step 2: Check if security questions are answered
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['step']) && $_POST['step'] == 'questions') {
    $answer1 = $_POST['answer1'];
    $answer2 = $_POST['answer2'];
    $user_id = $_SESSION['user_id_reset'];

    // Prepare SQL to check answers
    $stmt = $conn->prepare("SELECT id FROM users WHERE id = ? AND answer_q1 = ? AND answer_q2 = ?");
    $stmt->bind_param("iss", $user_id, $answer1, $answer2);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $step = 'reset_password';
    } else {
        $error = "Incorrect answers to security questions.";
    }

    $stmt->close();
}

// Step 3: Reset the password
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['step']) && $_POST['step'] == 'reset_password') {
    $new_password = password_hash($_POST['new_password'], PASSWORD_BCRYPT);
    $user_id = $_SESSION['user_id_reset'];

    // Update the password in the database
    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
    $stmt->bind_param("si", $new_password, $user_id);

    if ($stmt->execute()) {
        // Clear session variables
        unset($_SESSION['user_id_reset'], $_SESSION['security_q1'], $_SESSION['security_q2']);
        
        // Redirect to the login page
        header("Location: login.php");
        exit;
    } else {
        $error = "Failed to reset password. Please try again.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - CyberRisk Prioritize</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* General Layout */
        body {
            display: flex;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-image: url('pixelcut-export (1).jpeg');
            background-size: cover;
            background-position: center;
            position: relative;
        }

        /* Black overlay on background */
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: -1;
        }

        /* Transparent Header */
        .transparent-header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.1);
            padding: 10px 30px;
            z-index: 1;
            color: black;
        }

        .transparent-header .logo-title {
            font-weight: bold;
            font-size: 24px;
            color: white;
        }

        /* Left side form section with black background */
        .form-section {
            width: 50%;
            padding: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding-top: 100px;
            background-color: #000;
        }

        /* Forgot Password box styling */
        .forgot-password-box {
            width: 100%;
            max-width: 400px;
            padding: 40px;
            background-color: #D1D1D1;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        /* Form title styling */
        .form-title {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #000000;
            text-align: center;
        }

        /* Button styling */
        .btn-primary {
            background-color: #d32f2f;
            border-color: #d32f2f;
        }

        .btn-primary:hover {
            background-color: #b71c1c;
            border-color: #b71c1c;
        }

        footer {
            background-color: transparent;
            color: black;
            text-align: center;
            padding: 10px;
            position: fixed;
            width: 100%;
            bottom: 0;
        }

        /* Right side background image section */
        .image-section {
            width: 50%;
            background-image: url('pixelcut-export (1).jpeg');
            background-size: cover;
            background-position: center;
            position: relative;
        }

        /* Input fields with maroon border styling */
        .form-control {
            border: 2px solid #800000; /* Maroon border */
            color: black;
            background-color: white;
        }

        .form-control:focus {
            border-color: #b71c1c; /* Darker maroon when focused */
            box-shadow: none;
        }
    </style>
</head>
<body>
    <!-- Overlay for background image -->
    <div class="overlay"></div>

    <!-- Transparent Header with "CyberRisk Prioritize" -->
    <header class="transparent-header">
        <div class="logo-title">CyberRisk Prioritize</div>
    </header>

    <!-- Left Side Form Section with black background -->
    <div class="form-section">
        <!-- Forgot Password Box -->
        <div class="forgot-password-box">
            <h2 class="form-title">Forgot Password</h2>

            <?php if (!empty($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
            <?php if (!empty($message)) { echo "<div class='alert alert-success'>$message</div>"; } ?>

            <?php if (!isset($step) || $step == 'email'): ?>
                <form method="post">
                    <input type="hidden" name="step" value="email">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Continue</button>
                </form>
            
            <?php elseif ($step == 'questions'): ?>
                <form method="post">
                    <input type="hidden" name="step" value="questions">
                    <div class="mb-3">
                        <label class="form-label"><?= $_SESSION['security_q1'] ?>:</label>
                        <input type="text" class="form-control" name="answer1" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><?= $_SESSION['security_q2'] ?>:</label>
                        <input type="text" class="form-control" name="answer2" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Submit Answers</button>
                </form>

            <?php elseif ($step == 'reset_password'): ?>
                <form method="post">
                    <input type="hidden" name="step" value="reset_password">
                    <div class="mb-3">
                        <label for="new_password" class="form-label">New Password:</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Reset Password</button>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <!-- Right Side Background Image Section -->
    <div class="image-section"></div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 CyberRisk Prioritize. All Rights Reserved.</p>
    </footer>
</body>
</html>
