<?php
// Start session
session_start();

// If the user is already logged in, redirect to index2.php directly
if (isset($_SESSION['user_id'])) {
    header('Location: index2.php');
    exit;
}

// Include activity logging function
require_once 'activity_log.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection file
    require_once 'db_connection.php';

    // Get form data
    $name = $_POST['name'];
    $password = $_POST['password'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE name = ?");
    $stmt->bind_param("s", $name);

    // Execute the statement
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Password is correct, set the session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $name;

            // Log successful login activity
            logActivity($user['id'], "User successfully logged in.", $conn);

            // Redirect to index2 page
            header("Location: index2.php");
            exit;
        } else {
            // Log failed login attempt
            logActivity($user['id'], "Failed login attempt - invalid password.", $conn);

            $error = "Invalid password.";
        }
    } else {
        $error = "User not found.";
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
    <title>Login - CyberRisk Prioritize</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        /* Base Layout */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: url('pixelcut-export (1).jpeg') center/cover no-repeat fixed;
        }

        /* Header Styling */
        .transparent-header {
            background: linear-gradient(90deg, rgba(0, 0, 0, 0.9), rgba(139, 0, 0, 0.8));
            padding: 1rem 2rem;
            border-bottom: 2px solid rgba(255, 0, 0, 0.3);
        }

        .logo-title {
            color: #ffffff;
            font-size: 1.8rem;
            font-weight: 600;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        /* Login Container */
        .form-section {
            flex: 1;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            background: rgba(0, 0, 0, 0.6);
        }

        .login-box {
            width: 100%;
            max-width: 420px;
            padding: 2.5rem;
            background: linear-gradient(135deg, 
                rgba(0, 0, 0, 0.9) 0%, 
                rgba(139, 0, 0, 0.85) 100%);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 0 30px rgba(255, 0, 0, 0.2);
            border: 1px solid rgba(255, 0, 0, 0.2);
        }

        /* Form Elements */
        .form-control {
            background: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(180, 180, 180, 0.5);
            border-radius: 8px;
            padding: 0.75rem 1rem;
            color: #333333;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.9);
            border-color: #ff0000;
            box-shadow: 0 0 15px rgba(255, 0, 0, 0.2);
        }

        /* Button Styling */
        .btn-primary {
            background: linear-gradient(45deg, #ff0000, #cc0000);
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(45deg, #cc0000, #990000);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 0, 0, 0.4);
        }

        /* Links */
        .btn-link {
            color: #ff3333;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-link:hover {
            color: #ff6666;
            text-shadow: 0 0 8px rgba(255, 0, 0, 0.5);
        }

        /* Form Labels & Text */
        .form-label, .form-title, h2, p {
            color: #ffffff;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }

        .form-title {
            color: #ffffff;
            font-size: 2rem;
            margin-bottom: 1.5rem;
            background: none;
            -webkit-text-fill-color: initial;
        }

        /* Footer */
        footer {
            background: linear-gradient(90deg, rgba(0, 0, 0, 0.9), rgba(139, 0, 0, 0.8));
            color: #ffffff;
            padding: 1rem;
            text-align: center;
            border-top: 2px solid rgba(255, 0, 0, 0.3);
        }

        /* Alert Styling */
        .alert-danger {
            background: rgba(255, 0, 0, 0.2);
            border: 1px solid rgba(255, 0, 0, 0.3);
            color: #ffffff;
        }

        /* Progress Bar */
        .progress {
            height: 6px;
            background: rgba(0, 0, 0, 0.3);
        }

        .progress-bar {
            background: linear-gradient(90deg, #ff0000, #cc0000);
        }

        /* Input Group Icons */
        .input-group-text {
            background: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(180, 180, 180, 0.5);
            color: #ff0000;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .input-group-text:hover {
            color: #cc0000;
            text-shadow: 0 0 8px rgba(255, 0, 0, 0.5);
        }

        .bi-eye, .bi-eye-slash {
            color: #ff0000;
            transition: all 0.3s ease;
        }

        .bi-eye:hover, .bi-eye-slash:hover {
            color: #cc0000;
            text-shadow: 0 0 8px rgba(255, 0, 0, 0.5);
        }

        /* Form Control Placeholder */
        .form-control::placeholder {
            color: #999999;
        }
    </style>
</head>
<body>

   <!-- Transparent Header with "CyberRisk Prioritize" -->
<header class="transparent-header">
    <div class="logo-title">CyberRisk Prioritize</div>
</header>

    <!-- Left Side Form Section with maroon background -->
    <div class="form-section">
        <!-- Login Box -->
        <div class="login-box">
            <h2 class="form-title text-center">Log In</h2>
            <?php if (!empty($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
            
            <form id="loginForm" action="login.php" method="post" onsubmit="return validatePasswords()">
                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
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
                <div class="mb-3">
                    <label for="reconfirm_password" class="form-label">Reconfirm Password:</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="reconfirm_password" name="reconfirm_password" required>
                        <span class="input-group-text" onclick="toggleReconfirmPassword()">
                            <i id="toggleIconReconfirm" class="bi bi-eye"></i>
                        </span>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100" onclick="showProgressBar()">Login</button>
            </form>

            <div class="mt-3 text-center">
                <p>Don't have an account? <a href="signup.php" class="btn btn-link">Sign up here</a></p>
                <p><a href="forgot_password.php" class="btn btn-link">Forgot Password?</a></p>
            </div>

            <!-- Progress Bar -->
            <div class="progress mt-3" id="progressBar" style="display: none;">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 100%;"></div>
            </div>
        </div>
    </div>

    <!-- Right Side Background Image Section -->
    <div class="image-section"></div>

    <!-- Footer -->
<footer>
    <p>&copy; 2024 CyberRisk Prioritize. All Rights Reserved.</p>
</footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script>
        function validatePasswords() {
            var password = document.getElementById("password").value;
            var reconfirmPassword = document.getElementById("reconfirm_password").value;
            if (password !== reconfirmPassword) {
                alert("Passwords do not match.");
                return false;
            }
            return true;
        }

        function showProgressBar() {
            document.getElementById("progressBar").style.display = "block";
        }

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

        function toggleReconfirmPassword() {
            var reconfirmPasswordInput = document.getElementById("reconfirm_password");
            var toggleIconReconfirm = document.getElementById("toggleIconReconfirm");
            if (reconfirmPasswordInput.type === "password") {
                reconfirmPasswordInput.type = "text";
                toggleIconReconfirm.classList.remove("bi-eye");
                toggleIconReconfirm.classList.add("bi-eye-slash");
            } else {
                reconfirmPasswordInput.type = "password";
                toggleIconReconfirm.classList.remove("bi-eye-slash");
                toggleIconReconfirm.classList.add("bi-eye");
            }
        }
    </script>
</body>
</html>

