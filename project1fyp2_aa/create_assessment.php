<?php
session_start();
include 'db_connection.php';
require_once 'activity_log.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Assessment - Cyber Risk Prioritization System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background-image: url('pixelcut-export (1).jpeg');
            background-size: cover;
            background-position: center;
        }

        .overlay {
            background-color: rgba(0, 0, 0, 0.6);
            min-height: 100vh;
            padding: 40px;
        }

        /* Assessment Container Styling */
        .assessment-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 30px;
            margin: 20px auto;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            max-width: 1000px;
        }

        /* Update header styling */
        .assessment-header h2 {
            color: #212529;
            font-size: 2.2rem;
            margin-bottom: 20px;
            font-weight: normal;
            border-bottom: 2px solid #dc3545;
            padding-bottom: 10px;
        }

        /* Instructions box styling */
        .instructions-box {
            background: #212529;
            color: white;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid #dc3545;
        }

        .instructions-box strong {
            color: #dc3545;
            margin-right: 5px;
        }

        /* Risk Analysis box styling */
        .info-box {
            background: #212529;
            color: white;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            cursor: pointer;
            border: 1px solid #dc3545;
            transition: all 0.3s ease;
        }

        .info-box:hover {
            background: #2c3034;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(220, 53, 69, 0.2);
        }

        /* Create Assessment section styling */
        .main-section-container {
            background: #212529;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 30px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            width: 100%;
            max-width: none;
        }

        /* Form controls */
        .form-control {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            border-radius: 8px;
            padding: 12px;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.1);
            border-color: #dc3545;
            color: white;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }

        .form-label {
            color: white;
            margin-bottom: 8px;
        }

        /* Button styling */
        .btn-primary {
            background: #dc3545;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: #c82333;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
        }

        /* Assessments list styling */
        .assessments-list-container {
            background: #212529;
            border-radius: 12px;
            padding: 25px;
            margin-top: 40px;
            margin-bottom: 30px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            width: 100%;
            max-width: none;
        }

        .assessments-list-container h2 {
            color: white;
            font-size: 1.8rem;
            margin-bottom: 20px;
            border-bottom: 2px solid #dc3545;
            padding-bottom: 10px;
        }

        .list-group-item {
            background: #343a40;
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 0.8rem;
            border-radius: 8px;
            padding: 1rem;
            transition: all 0.3s ease;
        }

        .list-group-item:hover {
            background: #424649;
            transform: scale(1.01);
        }

        .list-group-item small {
            color: #dc3545;
        }

        /* Button group styling */
        .btn-group .btn {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.875rem;
            margin: 0 2px;
        }

        .btn-info {
            background-color: #212529 !important;
            border: none;
            color: white !important;
        }

        .btn-info:hover {
            background-color: #2c3034 !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .btn-warning {
            background-color: #6c757d !important;
            border: none;
            color: white !important;
        }

        .btn-warning:hover {
            background-color: #5c636a !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(108, 117, 125, 0.2);
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
            color: white;
        }

        /* Footer styling */
        footer {
            background-color: transparent;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        /* Copyright text */
        .copyright-text {
            background: #212529;
            color: white;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
            text-align: center;
        }

        /* Risk Analysis dropdown content styling */
        #riskAnalysisNote .section-container {
            background: #212529;
            color: white;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #dc3545;
            margin-bottom: 20px;
        }

        #riskAnalysisNote .section-container p {
            margin-bottom: 15px;
        }

        #riskAnalysisNote .section-container strong {
            color: #dc3545;
        }

        #riskAnalysisNote .section-container ul {
            list-style-type: none;
            padding-left: 0;
        }

        #riskAnalysisNote .section-container ul li {
            margin-bottom: 10px;
            padding-left: 20px;
            position: relative;
        }

        #riskAnalysisNote .section-container ul li:before {
            content: "•";
            color: #dc3545;
            position: absolute;
            left: 0;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="overlay">
        <div class="assessment-container">
            <div class="assessment-header">
                <h2>Risk Assessment Details</h2>
            </div>

            <div class="instructions-box">
                <strong>Instructions:</strong> Please create an assessment before proceeding. Once the assessment is created, you can click "View Details" to add more information regarding threats, impact, and priorities.
            </div>

            <div class="info-box" data-bs-toggle="collapse" data-bs-target="#riskAnalysisNote">
                What is Risk Analysis?
            </div>

            <div id="riskAnalysisNote" class="collapse mb-4">
                <div class="section-container">
                    <p><strong>Risk Analysis</strong> involves evaluating potential threats by assessing their likelihood and impact. It helps organizations prioritize risks and allocate resources efficiently.</p>
                    <ul>
                        <li><strong>Likelihood:</strong> The probability of the threat occurring.</li>
                        <li><strong>Impact:</strong> The severity of damage if the threat materializes.</li>
                        <li><strong>Budget:</strong> Resources allocated to mitigate the threat.</li>
                    </ul>
                </div>
            </div>

            <div class="main-section-container">
                <form action="create_assessment.php" method="post">
                    <div class="mb-4">
                        <label for="title" class="form-label">Assessment Title:</label>
                        <input type="text" class="form-control" id="title" name="title" required 
                               placeholder="Enter assessment title">
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Create New Assessment
                    </button>
                </form>
            </div>

            <div class="assessments-list-container">
                <h2><i class="fas fa-list me-2"></i>Assessments Created</h2>
                <div class="list-group">
                    <?php
                    $stmt = $conn->prepare("SELECT * FROM assessments WHERE user_id = ? ORDER BY created_at DESC");
                    $stmt->bind_param("i", $user_id);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="list-group-item d-flex justify-content-between align-items-center">';
                        echo '<div><i class="fas fa-file-alt me-2"></i>' . htmlspecialchars($row['title']) . 
                             '<br><small>Created on: ' . $row['created_at'] . '</small></div>';
                        echo '<div class="btn-group">';
                        echo '<a href="detail_assessment.php?index=' . $row['id'] . '" class="btn btn-info btn-sm"><i class="fas fa-eye me-1"></i>View</a>';
                        echo '<a href="create_assessment.php?action=edit&index=' . $row['id'] . '" class="btn btn-warning btn-sm"><i class="fas fa-edit me-1"></i>Edit</a>';
                        echo '<a href="create_assessment.php?action=delete&index=' . $row['id'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this assessment?\')"><i class="fas fa-trash me-1"></i>Delete</a>';
                        echo '</div>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>

            <div class="copyright-text">
                © 2024 CyberRisk Prioritize. All Rights Reserved.
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
