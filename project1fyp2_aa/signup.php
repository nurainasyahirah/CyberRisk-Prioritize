<?php
session_start();
include 'db_connection.php'; // Include the database connection

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $matric_number = $_POST['matric_number'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $security_q1 = $_POST['security_q1'];
    $security_q2 = $_POST['security_q2'];
    $answer_q1 = $_POST['answer_q1'];
    $answer_q2 = $_POST['answer_q2'];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO users (name, matric_number, email, password, security_q1, security_q2, answer_q1, answer_q2) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $name, $matric_number, $email, $hashed_password, $security_q1, $security_q2, $answer_q1, $answer_q2);

    // Execute and check if successful
    if ($stmt->execute()) {
        echo "<script>
                alert('Registration successful! Redirecting to login page.');
                window.location.href = 'login.php';
              </script>";
        exit;
    } else {
        echo "<div class='alert alert-danger' role='alert'>Error: " . $stmt->error . "</div>";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - CyberRisk Prioritize</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        /* General Layout */
        body, html {
            margin: 0;
            padding: 0;
            height: 100vh;
            width: 100vw;
            font-family: Arial, sans-serif;
            display: flex;
        }

        /* Left side background image */
        .image-section {
            width: 50%;
            background-image: url('pixelcut-export (1).jpeg');
            background-size: cover;
            background-position: center;
            height: 100vh;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        /* Right side with black background */
        .form-section {
            width: 50%;
            background-color: #000000;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            height: 100vh;
            overflow-y: auto;
        }

        .signup-box, .security-questions-box {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            background-color: #800000;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            color: white;
        }

        /* Input fields and border styles */
        .form-control {
            border: 2px solid #ffffff;
            color: black;
            background-color: white;
        }

        .form-control:focus {
            border-color: #ffffff;
            box-shadow: none;
        }

        .input-group-text {
            background-color: #ffffff;
            border-color: #ffffff;
            color: black;
        }

        .form-title {
            font-size: 24px;
            font-weight: bold;
            color: white;
            text-align: center;
            margin-bottom: 10px;
        }

        .btn-primary {
            background-color: #ffffff;
            border-color: #ffffff;
            color: #800000;
        }

        .btn-primary:hover {
            background-color: #d1d1d1;
            border-color: #d1d1d1;
            color: black;
        }

        footer {
            background-color: transparent;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            width: 50%;
            bottom: 0;
            right: 0;
        }
    </style>
</head>
<body>

<!-- Left Side Background Image Section with Security Questions Box -->
<div class="image-section">
    <div class="security-questions-box">
        <h2 class="form-title">Security Questions</h2>
        <form action="signup.php" method="post">
            <div class="mb-3">
                <label for="security_q1" class="form-label">Security Question 1:</label>
                <select class="form-control" id="security_q1" name="security_q1" required>
                    <option value="">Select a question</option>
                    <option value="What was the name of your first pet?">What was the name of your first pet?</option>
                    <option value="What is the name of the city where you were born?">What is the name of the city where you were born?</option>
                    <option value="What was your favorite teacher's name in school?">What was your favorite teacher's name in school?</option>
                </select>
                <input type="text" class="form-control mt-2" id="answer_q1" name="answer_q1" placeholder="Answer" required>
            </div>
            <div class="mb-3">
                <label for="security_q2" class="form-label">Security Question 2:</label>
                <select class="form-control" id="security_q2" name="security_q2" required>
                    <option value="">Select a question</option>
                    <option value="What is the name of the street where you grew up?">What is the name of the street where you grew up?</option>
                    <option value="What was the make and model of your first car?">What was the make and model of your first car?</option>
                    <option value="What is your mother’s maiden name?">What is your mother’s maiden name?</option>
                </select>
                <input type="text" class="form-control mt-2" id="answer_q2" name="answer_q2" placeholder="Answer" required>
            </div>
    </div>
</div>

<!-- Right Side Form Section with black background -->
<div class="form-section">
    <div class="signup-box">
        <h2 class="form-title">Sign Up</h2>
        <?php if (!empty($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
        
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="matric_number" class="form-label">Matric Number:</label>
                <input type="text" class="form-control" id="matric_number" name="matric_number" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" required>
                    <span class="input-group-text" onclick="togglePassword()">
                        <i id="toggleIcon" class="bi bi-eye"></i>
                    </span>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100">Register</button>
        </form>
    </div>
</div>

<footer>
    <p>&copy; 2024 CyberRisk Prioritize. All Rights Reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script>
    function togglePassword() {
        var passwordInput = document.getElementById("password");
        var toggleIcon = document.getElementById("toggleIcon");
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleIcon.classList.remove("bi-eye");
            toggleIcon.classList.add("bi-eye-slash");
        } else {
            passwordInput.type = "password";
            toggleIcon.classList.remove("bi-eye-slash");
            toggleIcon.classList.add("bi-eye");
        }
    }
</script>
</body>
</html>
