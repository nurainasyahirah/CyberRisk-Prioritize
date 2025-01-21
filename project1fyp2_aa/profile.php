<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require_once 'db_connection.php';

// Function to log user activity
function logActivity($user_id, $description, $conn) {
    $stmt = $conn->prepare("INSERT INTO activity_log (user_id, activity_description) VALUES (?, ?)");
    $stmt->bind_param("is", $user_id, $description);
    $stmt->execute();
    $stmt->close();
}

// Function to fetch recent activities
function fetchRecentActivities($user_id, $conn) {
    $stmt = $conn->prepare("SELECT activity_description, activity_time FROM activity_log WHERE user_id = ? ORDER BY activity_time DESC LIMIT 10");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $activities = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $activities;
}

$user_id = $_SESSION['user_id'];

// Fetch user details
$stmt = $conn->prepare("SELECT name, matric_number, email, profile_picture, security_q1, security_q2, answer_q1, answer_q2 FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

// Fetch additional profile details
$stmt = $conn->prepare("SELECT course, major FROM user_profiles WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$profile_result = $stmt->get_result();
$user_profile = $profile_result->fetch_assoc();
$stmt->close();

// Update profile and log the activity
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $course = $_POST['course'];
    $major = $_POST['major'];

    if ($user_profile) {
        $stmt = $conn->prepare("UPDATE user_profiles SET course = ?, major = ? WHERE user_id = ?");
        $stmt->bind_param("ssi", $course, $major, $user_id);
        logActivity($user_id, "Updated course and major information.", $conn);
    } else {
        $stmt = $conn->prepare("INSERT INTO user_profiles (user_id, course, major) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $user_id, $course, $major);
        logActivity($user_id, "Added course and major information.", $conn);
    }
    $stmt->execute();
    $stmt->close();

    header("Location: profile.php");
    exit;
}

// Fetch recent activities
$recent_activities = fetchRecentActivities($user_id, $conn);
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - Cyber Risk Prioritization System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('pixelcut-export (1).jpeg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: white;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            max-width: 900px;
            margin: 40px auto;
            padding: 0 20px;
            display: flex;
            justify-content: center;
        }

        .profile-main {
            width: 100%;
            background: #212529;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        /* Profile Header */
        .profile-header {
            background: linear-gradient(45deg, #800000, #dc3545);
            padding: 40px 30px;
            text-align: center;
            position: relative;
        }

        /* Enhanced Profile Picture Styling */
        .profile-pic {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 5px solid rgba(255, 255, 255, 0.9);
            margin-bottom: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            object-fit: cover;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .profile-pic:hover {
            transform: scale(1.05);
            border-color: #ffffff;
        }

        /* Profile Name Styling */
        .profile-header h2 {
            margin-top: 15px;
            color: white;
            font-size: 24px;
            font-weight: 600;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        /* Updated Profile Content */
        .profile-content {
            padding: 30px 40px;
            background: rgba(33, 37, 41, 0.9);
        }

        /* Info Sections in White */
        .info-section {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 12px;
            padding: 25px 30px;
            margin-bottom: 25px;
            border-left: 4px solid #dc3545;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
        }

        .info-section h3 {
            color: #212529;
            font-size: 1.2rem;
            margin-bottom: 20px;
            font-weight: 600;
            letter-spacing: 1px;
            border-bottom: 1px solid rgba(220, 53, 69, 0.2);
            padding-bottom: 10px;
        }

        /* Info Items */
        .info-item {
            background: rgba(255, 255, 255, 0.7);
            border-radius: 8px;
            padding: 12px 15px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .info-item:hover {
            background: rgba(220, 53, 69, 0.1);
            transform: translateX(5px);
        }

        .info-label {
            color: #343a40;
            font-weight: 600;
            min-width: 150px;
        }

        .info-value {
            color: #495057;
        }

        /* Recent Activities Section in Dark Style */
        .info-section:last-of-type {
            background: #212529;
            border-left: 4px solid #dc3545;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        .info-section:last-of-type h3 {
            color: white;
            border-bottom: 1px solid rgba(220, 53, 69, 0.2);
        }

        .info-section:last-of-type .activity-item {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 8px;
            padding: 12px 15px;
            margin-bottom: 10px;
            transition: all 0.3s ease;
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .info-section:last-of-type .activity-item:hover {
            background: rgba(220, 53, 69, 0.1);
            transform: translateX(5px);
            border-color: rgba(220, 53, 69, 0.2);
        }

        .info-section:last-of-type .activity-time {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.9rem;
        }

        .info-section:last-of-type .activity-item:hover .activity-time {
            color: rgba(255, 255, 255, 0.8);
        }

        /* Edit Button */
        .btn-edit {
            background: #343a40;
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            margin-top: 20px;
        }

        .btn-edit:hover {
            background: #dc3545;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
        }

        /* Modal Styling */
        .modal-content {
            background: #212529;
            border: 1px solid #dc3545;
            border-radius: 12px;
        }

        .modal-header {
            background: #1a1e21;
            border-bottom: 1px solid #dc3545;
            color: white;
        }

        .modal-body {
            color: white;
            padding: 25px;
        }

        .modal-body .form-label {
            color: white !important;
        }

        .modal-body .form-control {
            background: #2c3034;
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            border-radius: 8px;
        }

        .modal-body .form-control:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }

        .modal-footer {
            border-top: 1px solid rgba(220, 53, 69, 0.2);
        }

        .modal-footer .btn-primary {
            background: #dc3545;
            border: none;
        }

        .modal-footer .btn-primary:hover {
            background: #c82333;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
        }

        .modal-footer .btn-secondary {
            background: #343a40;
            border: none;
        }

        .modal-footer .btn-secondary:hover {
            background: #23272b;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                margin: 20px auto;
                padding: 0 15px;
            }

            .profile-header {
                padding: 30px 20px;
            }

            .profile-pic {
                width: 120px;
                height: 120px;
                border-width: 4px;
            }

            .profile-content {
                padding: 20px;
            }

            .info-section {
                padding: 20px;
            }

            .info-item {
                flex-direction: column;
            }

            .info-label {
                margin-bottom: 5px;
            }
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="container mt-5">
        <h2>User Profile</h2>
        <div class="profile-main">
            <div class="profile-header">
                <!-- Profile Picture -->
                <?php if (!empty($user['profile_picture'])): ?>
                    <img src="<?php echo htmlspecialchars($user['profile_picture']); ?>" alt="Profile Picture" class="profile-pic" onclick="document.getElementById('profile_picture').click()">
                <?php else: ?>
                    <img src="default-profile.png" alt="Default Profile Picture" class="profile-pic" onclick="document.getElementById('profile_picture').click()">
                <?php endif; ?>
                <h2><?php echo htmlspecialchars($user['name']); ?></h2>
            </div>

            <div class="profile-content">
                <!-- Personal Information -->
                <div class="info-section">
                    <h3>Personal Information</h3>
                    <div class="info-item">
                        <span class="info-label">Matric Number:</span>
                        <span class="info-value"><?php echo htmlspecialchars($user['matric_number']); ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Email:</span>
                        <span class="info-value"><?php echo htmlspecialchars($user['email']); ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Course:</span>
                        <span class="info-value"><?php echo htmlspecialchars($user_profile['course'] ?? 'N/A'); ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Major:</span>
                        <span class="info-value"><?php echo htmlspecialchars($user_profile['major'] ?? 'N/A'); ?></span>
                    </div>
                </div>

                <!-- Security Information section with button -->
                <div class="info-section">
                    <h3>Security Information</h3>
                    <div class="info-item">
                        <span class="info-label">Security Question 1:</span>
                        <span class="info-value"><?php echo htmlspecialchars($user['security_q1']); ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Answer 1:</span>
                        <span class="info-value"><?php echo htmlspecialchars($user['answer_q1']); ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Security Question 2:</span>
                        <span class="info-value"><?php echo htmlspecialchars($user['security_q2']); ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Answer 2:</span>
                        <span class="info-value"><?php echo htmlspecialchars($user['answer_q2']); ?></span>
                    </div>
                    
                    <!-- Edit Button moved here -->
                    <button class="btn-edit" data-bs-toggle="modal" data-bs-target="#editModal">
                        Edit Additional Information
                    </button>
                </div>

                <!-- Recent Activities -->
                <div class="info-section">
                    <h3>Recent Activities</h3>
                    <?php foreach ($recent_activities as $activity): ?>
                        <div class="activity-item">
                            <span><?php echo htmlspecialchars($activity['activity_description']); ?></span>
                            <span class="activity-time"><?php echo date('Y-m-d H:i', strtotime($activity['activity_time'])); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Hidden File Input -->
        <form action="upload_profile_picture.php" method="post" enctype="multipart/form-data">
            <input type="file" name="profile_picture" id="profile_picture" accept="image/*" onchange="this.form.submit()" style="display: none;">
        </form>
    </div>

    <!-- Edit Modal for Course and Major -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Additional Information</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="update_profile" value="1">
                    <div class="mb-3">
                        <label for="course" class="form-label">Course:</label>
                        <input type="text" id="course" name="course" class="form-control" value="<?php echo htmlspecialchars($user_profile['course'] ?? ''); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="major" class="form-label">Major:</label>
                        <input type="text" id="major" name="major" class="form-control" value="<?php echo htmlspecialchars($user_profile['major'] ?? ''); ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


    <?php include 'footer.php'; ?>

        <!-- Bootstrap JS and dependencies -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
