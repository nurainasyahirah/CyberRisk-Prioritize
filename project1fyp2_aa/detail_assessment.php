<?php
session_start();
include 'db_connection.php';
require_once 'activity_log.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if (!isset($_GET['index'])) {
    header('Location: create_assessment.php');
    exit;
}

$assessment_id = $_GET['index'];
$user_id = $_SESSION['user_id'];

// First, fetch the assessment details including budget
$stmt = $conn->prepare("SELECT * FROM assessments WHERE id = ?");
$stmt->bind_param("i", $assessment_id);
$stmt->execute();
$assessment = $stmt->get_result()->fetch_assoc();
$stmt->close();

// Check if assessment exists
if (!$assessment) {
    header('Location: create_assessment.php');
    exit;
}

// Handle budget form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_budget'])) {
    $budget_low = $_POST['budget_low'];
    $budget_medium = $_POST['budget_medium'];
    $budget_high = $_POST['budget_high'];
    
    $stmt = $conn->prepare("UPDATE assessments SET budget_low = ?, budget_medium = ?, budget_high = ? WHERE id = ?");
    $stmt->bind_param("dddi", $budget_low, $budget_medium, $budget_high, $assessment_id);
    if ($stmt->execute()) {
        logActivity($user_id, "Updated budget for assessment ID: $assessment_id", $conn);
        // Refresh the assessment data
        $stmt = $conn->prepare("SELECT * FROM assessments WHERE id = ?");
        $stmt->bind_param("i", $assessment_id);
        $stmt->execute();
        $assessment = $stmt->get_result()->fetch_assoc();
        $stmt->close();
    }
}

// Handle threat addition
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_threat'])) {
    if (isset($_POST['threat']) && isset($_POST['likelihood']) && isset($_POST['impact'])) {
        $threat = $_POST['threat'];
        $likelihood = $_POST['likelihood'];
        $impact = $_POST['impact'];
        
        // Get budget based on impact level from assessment
        $budget_column = "budget_" . strtolower($impact);
        $budget = $assessment[$budget_column];

        if ($threat && $likelihood && $impact && $budget) {
            $stmt = $conn->prepare("INSERT INTO assessment_details (assessment_id, threat, likelihood, impact, budget) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("isssd", $assessment_id, $threat, $likelihood, $impact, $budget);
            if ($stmt->execute()) {
                logActivity($user_id, "Added a new detail to assessment ID: $assessment_id", $conn);
            }
            $stmt->close();
        }
    }
}

// Handle detail deletion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    if (isset($_POST['detail_id'])) {
        $detail_id = $_POST['detail_id'];
        $stmt = $conn->prepare("DELETE FROM assessment_details WHERE id = ? AND assessment_id = ?");
        $stmt->bind_param("ii", $detail_id, $assessment_id);
        if ($stmt->execute()) {
            logActivity($user_id, "Deleted a detail from assessment ID: $assessment_id", $conn);
        }
        $stmt->close();
    }
}

// Fetch the list of threats
$stmt = $conn->prepare("SELECT * FROM assessment_details WHERE assessment_id = ? ORDER BY id ASC");
$stmt->bind_param("i", $assessment_id);
$stmt->execute();
$details = $stmt->get_result();
$stmt->close();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Risk Analysis - <?= htmlspecialchars($assessment['title']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
            min-height: 100vh; /* Ensure the overlay covers the entire page */
            padding: 40px;
        }

        h2, h3 {
            color: white;
            position: relative;
        }

        .navbar {
            background-color: rgba(128, 0, 0, 0.9);
        }

        .btn-primary {
            background-color: white;
            color: maroon;
        }

        .btn-primary:hover {
            background-color: #d1d1d1;
            color: black;
        }

        footer {
            background-color: transparent;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        /* Modern Container Styling */
        .assessment-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 30px;
            margin: 20px auto;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            max-width: 1200px;
        }

        /* Header Styling */
        .assessment-header {
            border-bottom: 3px solid #dc3545; /* Red accent */
            margin-bottom: 30px;
            padding-bottom: 15px;
        }

        .assessment-header h2 {
            color: #212529; /* Dark grey/black */
            font-size: 2.2rem;
            margin: 0;
            font-weight: 600;
        }

        /* Budget Card Styling */
        .budget-card {
            background: #212529; /* Dark background */
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 30px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: transform 0.2s ease;
            color: white;
        }

        .budget-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .budget-card h3 {
            color: white;
            font-size: 1.5rem;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .budget-values {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        .budget-item {
            flex: 1;
            padding: 15px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .budget-item strong {
            display: block;
            color: #dc3545; /* Red accent */
            margin-bottom: 5px;
            font-size: 1.1rem;
        }

        .budget-item span {
            color: white;
            font-size: 1.2rem;
        }

        /* Budget Form Styling */
        .budget-card .form-label {
            color: white !important;
        }

        .budget-card .form-control {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
        }

        .budget-card .form-control:focus {
            background: rgba(255, 255, 255, 0.1);
            border-color: #dc3545;
            color: white;
        }

        .budget-card .form-control::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        /* Budget Edit Button */
        .budget-card .btn-primary {
            background: #dc3545;
            color: white;
            border: none;
        }

        .budget-card .btn-primary:hover {
            background: #c82333;
            transform: translateY(-2px);
        }

        .budget-card .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .budget-card .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        /* Form Styling */
        .threat-form {
            background: #212529; /* Dark background */
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .threat-form h3 {
            color: white;
            font-size: 1.5rem;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .threat-form .form-label {
            color: white !important;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .threat-form .form-control {
            background: white;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            padding: 12px;
            color: #212529;
            transition: all 0.3s ease;
        }

        .threat-form .form-control:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }

        .threat-form .form-select {
            background-color: white;
            color: #212529;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Range Input Styling */
        .threat-form .form-range {
            height: 8px;
            border-radius: 4px;
        }

        .threat-form .form-range::-webkit-slider-thumb {
            background: #dc3545;
            cursor: pointer;
        }

        .threat-form .form-range::-webkit-slider-runnable-track {
            background: rgba(255, 255, 255, 0.2);
        }

        /* Likelihood value display */
        #likelihood-value {
            color: #dc3545;
            font-weight: bold;
            margin-left: 8px;
        }

        /* Button in threat form */
        .threat-form .btn-primary {
            background: #dc3545;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .threat-form .btn-primary:hover {
            background: #c82333;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
        }

        /* Table Styling */
        .table {
            background: #212529 !important; /* Dark background */
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            margin-top: 20px;
        }

        .table thead th {
            background-color: #1a1e21 !important; /* Slightly darker than body */
            color: white !important;
            border-bottom: 2px solid rgba(255, 255, 255, 0.1) !important;
            font-weight: 500;
            padding: 15px;
            border: none;
        }

        .table tbody td {
            background-color: #212529 !important;
            color: white !important;
            padding: 12px 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            vertical-align: middle;
        }

        .table tbody tr:hover td {
            background-color: #2c3034 !important;
        }

        .table tbody tr:last-child td {
            border-bottom: none;
        }

        /* Delete Button */
        .table .btn-danger {
            background-color: #dc3545 !important;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s ease;
            color: white;
        }

        .table .btn-danger:hover {
            background-color: #c82333 !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
        }

        /* Impact Badge Styling */
        .table .badge {
            padding: 6px 12px;
            border-radius: 4px;
            font-weight: 500;
        }

        .badge-high {
            background-color: #dc3545 !important;
            color: white !important;
        }

        .badge-medium {
            background-color: #6c757d !important;
            color: white !important;
        }

        .badge-low {
            background-color: #495057 !important;
            color: white !important;
        }

        /* Empty State */
        .table .no-data {
            text-align: center;
            padding: 30px;
            color: rgba(255, 255, 255, 0.7) !important;
            font-style: italic;
        }

        /* Alert Styling */
        .alert {
            border-radius: 12px;
            border: none;
            padding: 20px;
            margin-bottom: 30px;
        }

        /* Badge Styling */
        .badge {
            padding: 8px 12px;
            border-radius: 6px;
            font-weight: 500;
        }

        .badge-danger {
            background-color: #dc3545;
        }

        .badge-warning {
            background-color: #6c757d; /* Grey instead of traditional warning color */
        }

        .badge-success {
            background-color: #212529; /* Dark instead of traditional success color */
        }

        /* Delete Button Styling */
        .btn-danger {
            background: #dc3545;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            background: #c82333;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
        }

        /* Additional Hover Effects */
        .budget-item:hover {
            border: 1px solid #dc3545;
            transform: translateY(-2px);
            transition: all 0.3s ease;
        }

        /* Form Range Track */
        .form-range::-webkit-slider-runnable-track {
            background: #dee2e6;
        }

        .form-range::-webkit-slider-thumb:hover {
            background: #c82333;
        }

        /* Calculate Risk Button Styling */
        .btn-success {
            background-color: #dc3545 !important; /* Red instead of green */
            border-color: #dc3545 !important;
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-success:hover {
            background-color: #c82333 !important;
            border-color: #c82333 !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
        }

        /* Alert Styling */
        .alert-info {
            background-color: #212529 !important;
            border: 1px solid #dc3545 !important;
            color: white !important;
            border-radius: 8px;
            padding: 15px 20px;
            margin-bottom: 20px;
        }

        .alert-info strong {
            color: #dc3545;
        }

        /* Card Styling */
        .info-card {
            background-color: #212529 !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        .info-card .card-header {
            background-color: #1a1e21 !important;
            border-bottom: 1px solid #dc3545 !important;
            padding: 15px 20px;
        }

        .info-card .card-header h5 {
            margin: 0;
        }

        .info-card .btn-link {
            color: white !important;
            text-decoration: none !important;
            width: 100%;
            text-align: left;
            padding: 0;
        }

        .info-card .btn-link:hover {
            color: #dc3545 !important;
        }

        .info-card .card-body {
            background-color: #212529 !important;
            color: white !important;
            padding: 20px;
        }

        .info-card .card-body strong {
            color: #dc3545;
        }

        .info-card .card-body ul {
            list-style-type: none;
            padding-left: 0;
            margin-top: 15px;
        }

        .info-card .card-body ul li {
            margin-bottom: 10px;
            padding-left: 20px;
            position: relative;
        }

        .info-card .card-body ul li:before {
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

<div class="assessment-container">
    <div class="assessment-header">
        <h2>Risk Assessment Details</h2>
    </div>

    <div class="alert alert-info" role="alert">
        <strong>Instructions:</strong> Add threat details below, including likelihood, impact, and budget. This data will help prioritize risks effectively.
    </div>

    <div class="card info-card mb-3">
        <div class="card-header">
            <h5 class="mb-0">
                <button class="btn btn-link" type="button" 
                        data-bs-toggle="collapse" data-bs-target="#riskAnalysisNote" 
                        aria-expanded="false" aria-controls="riskAnalysisNote">
                    What is Risk Analysis?
                </button>
            </h5>
        </div>
        <div id="riskAnalysisNote" class="collapse">
            <div class="card-body">
                <p><strong>Risk Analysis</strong> involves evaluating potential threats by assessing their likelihood and impact. It helps organizations prioritize risks and allocate resources efficiently.</p>
                <ul>
                    <li><strong>Likelihood:</strong> The probability of the threat occurring.</li>
                    <li><strong>Impact:</strong> The severity of damage if the threat materializes.</li>
                    <li><strong>Budget:</strong> Resources allocated to mitigate the threat.</li>
                </ul>
            </div>
        </div>
    </div>

    <?php if (!$assessment['budget_low'] && !$assessment['budget_medium'] && !$assessment['budget_high']): ?>
        <div class="budget-card">
            <h3>Set Assessment Budget</h3>
            <form action="detail_assessment.php?index=<?= $assessment_id ?>" method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Low Impact Budget:</label>
                            <input type="number" class="form-control" name="budget_low" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Medium Impact Budget:</label>
                            <input type="number" class="form-control" name="budget_medium" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">High Impact Budget:</label>
                            <input type="number" class="form-control" name="budget_high" required>
                        </div>
                    </div>
                </div>
                <button type="submit" name="update_budget" class="btn btn-primary">Set Budget</button>
            </form>
        </div>
    <?php else: ?>
        <div class="budget-card">
            <h3>
                Assessment Budget
                <button class="btn btn-sm btn-primary" onclick="toggleBudgetEdit()">Edit Budget</button>
            </h3>
            
            <div id="budgetDisplay">
                <div class="budget-values">
                    <div class="budget-item">
                        <strong>Low Impact</strong>
                        <span>$<?= number_format($assessment['budget_low'], 2) ?></span>
                    </div>
                    <div class="budget-item">
                        <strong>Medium Impact</strong>
                        <span>$<?= number_format($assessment['budget_medium'], 2) ?></span>
                    </div>
                    <div class="budget-item">
                        <strong>High Impact</strong>
                        <span>$<?= number_format($assessment['budget_high'], 2) ?></span>
                    </div>
                </div>
            </div>
            
            <!-- Edit budget form (hidden by default) -->
            <div id="budgetEditForm" style="display: none;">
                <form action="detail_assessment.php?index=<?= $assessment_id ?>" method="post">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Low Impact Budget:</label>
                                <input type="number" class="form-control" name="budget_low" 
                                       value="<?= $assessment['budget_low'] ?>" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Medium Impact Budget:</label>
                                <input type="number" class="form-control" name="budget_medium" 
                                       value="<?= $assessment['budget_medium'] ?>" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">High Impact Budget:</label>
                                <input type="number" class="form-control" name="budget_high" 
                                       value="<?= $assessment['budget_high'] ?>" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="update_budget" class="btn btn-primary">Update Budget</button>
                    <button type="button" class="btn btn-secondary" onclick="toggleBudgetEdit()">Cancel</button>
                </form>
            </div>
        </div>
    <?php endif; ?>

    <div class="threat-form">
        <h3 class="mb-4">Add New Threat</h3>
        <form action="detail_assessment.php?index=<?= $assessment_id ?>" method="post">
            <div class="mb-3">
                <label for="threat" class="form-label text-white">Threat:</label>
                <input type="text" class="form-control" id="threat" name="threat" required>
            </div>
            <div class="mb-3">
                <label for="likelihood" class="form-label text-white">Likelihood: 
                    <span id="likelihood-value">0.50</span>
                </label>
                <input type="range" class="form-range" id="likelihood" name="likelihood" min="0" max="1" step="0.01" value="0.5"
                       oninput="document.getElementById('likelihood-value').innerText = this.value;">
            </div>
            <div class="mb-3">
                <label for="impact" class="form-label text-white">Impact:</label>
                <select class="form-control" id="impact" name="impact" required>
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                </select>
            </div>
            <button type="submit" name="add_threat" class="btn btn-primary">Add Detail</button>
        </form>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Threat</th>
                <th>Likelihood</th>
                <th>Impact</th>
                <th>Budget</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($details->num_rows > 0): ?>
                <?php while ($detail = $details->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($detail['threat']) ?></td>
                        <td><?= $detail['likelihood'] ?></td>
                        <td>
                            <span class="badge badge-<?= strtolower($detail['impact']) ?>">
                                <?= ucfirst($detail['impact']) ?>
                            </span>
                        </td>
                        <td>$<?= number_format($detail['budget'], 2) ?></td>
                        <td>
                            <form action="detail_assessment.php?index=<?= $assessment_id ?>" method="post" class="d-inline">
                                <input type="hidden" name="detail_id" value="<?= $detail['id'] ?>">
                                <button type="submit" name="delete" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="no-data">No details added yet.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="d-flex justify-content-end mt-4">
        <a href="risk_prioritization.php?index=<?= $assessment_id ?>" class="btn btn-success">Calculate Risk Prioritization</a>
    </div>
</div>

<footer>
    <p>&copy; 2024 CyberRisk Prioritize. All Rights Reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<script>
function toggleBudgetEdit() {
    const displayDiv = document.getElementById('budgetDisplay');
    const editDiv = document.getElementById('budgetEditForm');
    
    if (displayDiv.style.display !== 'none') {
        displayDiv.style.display = 'none';
        editDiv.style.display = 'block';
    } else {
        displayDiv.style.display = 'block';
        editDiv.style.display = 'none';
    }
}
</script>

</body>
</html>
