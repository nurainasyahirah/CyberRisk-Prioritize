<?php
session_start();
include 'db_connection.php'; // Include the database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$assessment_id = $_GET['index'] ?? null;
if (!$assessment_id) {
    header('Location: create_assessment.php');
    exit;
}

// Fetch assessment and threats
$stmt = $conn->prepare("SELECT * FROM assessments WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $assessment_id, $user_id);
$stmt->execute();
$assessment = $stmt->get_result()->fetch_assoc();
$stmt->close();

$stmt = $conn->prepare("SELECT * FROM assessment_details WHERE assessment_id = ? ORDER BY id ASC");
$stmt->bind_param("i", $assessment_id);
$stmt->execute();
$details = $stmt->get_result();

$impact_values = ['low' => 0.2, 'medium' => 0.5, 'high' => 0.8];

$risk_data = [];
while ($detail = $details->fetch_assoc()) {
    $risk_exposure = $detail['likelihood'] * $impact_values[$detail['impact']] * $detail['budget'];
    $risk_data[] = [
        'threat' => $detail['threat'],
        'likelihood' => $detail['likelihood'],
        'impact' => $detail['impact'],
        'budget' => $detail['budget'],
        'risk_exposure' => $risk_exposure,
    ];
}
usort($risk_data, fn($a, $b) => $b['risk_exposure'] <=> $a['risk_exposure']);
$stmt->close();

// Generate a summary
function generateSummary($risk_data) {
    $summary = "This report provides a prioritized list of cyber risks based on identified threats. ";
    foreach ($risk_data as $index => $risk) {
        $summary .= ucfirst($risk['threat']) . " is ranked " . ($index + 1) .
            " with a risk exposure of " . $risk['risk_exposure'] .
            ", due to a likelihood of " . $risk['likelihood'] .
            " and an impact of " . ucfirst($risk['impact']) . ". ";
    }
    return $summary;
}

// Generate recommendations based on threat keywords
function generateRecommendations($risk_data) {
    $recommendations = "";
    foreach ($risk_data as $risk) {
        if (stripos($risk['threat'], 'phishing') !== false) {
            $recommendations .= "For phishing, implement multi-factor authentication (MFA) and conduct regular employee awareness training.\n";
        } elseif (stripos($risk['threat'], 'malware') !== false) {
            $recommendations .= "For malware, enhance endpoint detection systems and ensure timely software updates.\n";
        } else {
            $recommendations .= "For " . ucfirst($risk['threat']) . ", follow industry-standard best practices for mitigation.\n";
        }
    }
    return $recommendations;
}

$summary = generateSummary($risk_data);
$recommendations = generateRecommendations($risk_data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Risk Prioritization for <?= htmlspecialchars($assessment['title']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-image: url('pixelcut-export (1).jpeg');
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 20px;
            margin-top: 30px;
        }
        .chart-container {
            max-width: 500px;
            margin: 20px auto;
        }
        footer {
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
        @media print {
            .no-print {
                display: none;
            }
        }
        /* Enhanced table styling */
        .risk-table {
            background-color: #212529 !important;
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            margin: 20px 0;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .risk-table thead {
            background-color: #dc3545 !important;
        }

        .risk-table th {
            padding: 15px;
            font-weight: 600;
            text-align: left;
            border: none;
            color: white !important;
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
            background-color: #dc3545 !important;
        }

        .risk-table td {
            padding: 12px 15px;
            border: none;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            color: white !important;
            background-color: #212529 !important;
        }

        .risk-table tbody tr:hover {
            background-color: #2c3034 !important;
        }

        .risk-table tbody tr:last-child td {
            border-bottom: none;
        }

        /* Risk exposure styling */
        .risk-exposure {
            font-weight: 600;
            padding: 5px 10px;
            border-radius: 4px;
        }

        .risk-high {
            color: #dc3545 !important;
        }

        .risk-medium {
            color: #adb5bd !important;
        }

        .risk-low {
            color: #6c757d !important;
        }

        /* Badge Styling in Table */
        .risk-table .badge {
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: 500;
        }

        .risk-table .bg-danger {
            background-color: #dc3545 !important;
            color: white;
        }

        .risk-table .bg-warning {
            background-color: #6c757d !important;
            color: white;
        }

        .risk-table .bg-success {
            background-color: #343a40 !important;
            color: white;
        }

        /* Section styling */
        .section-title {
            color: #dc3545 !important;
            font-size: 2.2rem;
            margin-bottom: 1.5rem;
            font-weight: 600;
            border-bottom: 3px solid #dc3545;
            padding-bottom: 10px;
            display: inline-block;
        }

        /* Summary and Recommendations styling */
        .content-card {
            background-color: #212529;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .content-card h3 {
            color: #dc3545; /* Red title */
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            font-weight: 600;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding-bottom: 10px;
        }

        .content-card p {
            color: white;
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        /* Recommendations list styling */
        .recommendations-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .recommendations-list li {
            color: white;
            padding: 12px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: flex-start;
        }

        .recommendations-list li:last-child {
            border-bottom: none;
        }

        .recommendations-list li:before {
            content: "•";
            color: #dc3545;
            font-weight: bold;
            margin-right: 10px;
            font-size: 1.2em;
        }

        /* Button styling */
        .action-buttons {
            margin: 20px 0;
        }

        .btn-download {
            background: #dc3545 !important; /* Red background */
            color: white !important;
            padding: 12px 24px;
            border-radius: 6px;
            border: none;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-download:hover {
            background: #c82333 !important; /* Darker red on hover */
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
            color: white !important;
        }

        .btn-back {
            background: #343a40;
            color: white;
            padding: 12px 24px;
            border-radius: 6px;
            border: none;
            margin-left: 10px;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-back:hover {
            background: #23272b;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Alert Styling */
        .alert-info {
            background-color: #212529 !important;
            border: 1px solid #dc3545 !important;
            color: white !important;
        }

        /* Card Header Styling */
        .card {
            background-color: #212529 !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
        }

        .card-header {
            background-color: #1a1e21 !important;
            border-bottom: 1px solid #dc3545 !important;
        }

        .card-body {
            color: white !important;
        }

        /* Table Header Title */
        h3.mt-4 {
            color: #dc3545 !important;
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            font-weight: 600;
            border-bottom: 3px solid #dc3545;
            padding-bottom: 10px;
            display: inline-block;
        }

        /* Chart Layout Styling */
        .chart-row {
            display: flex;
            gap: 20px;
            margin: 20px 0;
            height: 450px; /* Fixed height */
        }

        .chart-container {
            flex: 1;
            background-color: #212529;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            position: relative; /* Add position relative */
            height: 100%; /* Full height of parent */
        }

        .chart-container h3 {
            color: #dc3545 !important;
            font-size: 1.2rem;
            margin-bottom: 20px;
            font-weight: 600;
            text-align: center;
        }

        /* Ensure canvas stays within container */
        .chart-container canvas {
            position: absolute; /* Position absolute within relative container */
            top: 60px; /* Account for title */
            left: 0;
            right: 0;
            bottom: 0;
            width: 100% !important;
            height: calc(100% - 60px) !important; /* Subtract title height */
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .chart-row {
                flex-direction: column;
                height: auto;
            }

            .chart-container {
                height: 450px; /* Fixed height on mobile */
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="container">
        <div class="alert alert-info" role="alert">
            <strong>Instructions:</strong> Review the prioritized risks below and download a PDF report for further analysis.
        </div>

        <div class="card mb-3">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">
                    <button class="btn btn-link text-white text-decoration-none" type="button" 
                            data-bs-toggle="collapse" data-bs-target="#riskPrioritizationNote" 
                            aria-expanded="false" aria-controls="riskPrioritizationNote">
                        What is Risk Prioritization?
                    </button>
                </h5>
            </div>
            <div id="riskPrioritizationNote" class="collapse">
                <div class="card-body">
                    <p><strong>Risk Prioritization</strong> ranks risks based on exposure to allocate resources effectively. 
                    It is calculated as <em>likelihood × impact × budget</em>.</p>
                </div>
            </div>
        </div>

        <h1 class="section-title">Risk Prioritization for <?= htmlspecialchars($assessment['title']) ?></h1>

        <div class="action-buttons">
            <button class="btn-download" onclick="generatePDF()">Download PDF Report</button>
            <a href="detail_assessment.php?index=<?= $assessment_id ?>" class="btn-back">Back</a>
        </div>

        <div class="content-card">
            <h3>Summary</h3>
            <p><?= nl2br(htmlspecialchars($summary)) ?></p>
        </div>

        <div class="content-card">
            <h3>Recommendations</h3>
            <ul class="recommendations-list">
                <?php 
                $recommendations_array = explode("\n", $recommendations);
                foreach($recommendations_array as $recommendation): 
                    if(trim($recommendation)): ?>
                        <li><?= htmlspecialchars(trim($recommendation)) ?></li>
                <?php 
                    endif;
                endforeach; 
                ?>
            </ul>
        </div>

        <h3 class="mt-4">Prioritized Risks</h3>
        <table class="table risk-table" id="riskTable">
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Threat</th>
                    <th>Likelihood</th>
                    <th>Impact</th>
                    <th>Budget</th>
                    <th>Risk Exposure</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($risk_data as $rank => $risk): ?>
                    <tr>
                        <td><?= $rank + 1 ?></td>
                        <td>
                            <strong><?= htmlspecialchars(ucfirst($risk['threat'])) ?></strong>
                        </td>
                        <td><?= $risk['likelihood'] ?></td>
                        <td>
                            <span class="badge bg-<?= strtolower($risk['impact']) === 'high' ? 'danger' : (strtolower($risk['impact']) === 'medium' ? 'warning' : 'success') ?>">
                                <?= ucfirst($risk['impact']) ?>
                            </span>
                        </td>
                        <td>$<?= number_format($risk['budget']) ?></td>
                        <td>
                            <span class="risk-exposure <?= $risk['risk_exposure'] > 5000 ? 'risk-high' : ($risk['risk_exposure'] > 2000 ? 'risk-medium' : 'risk-low') ?>">
                                <?= number_format($risk['risk_exposure'], 2) ?>
                            </span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="chart-row">
            <div class="chart-container">
                <h3>Risk Distribution</h3>
                <canvas id="pieChart"></canvas>
            </div>
            <div class="chart-container">
                <h3>Risk Exposure by Threat</h3>
                <canvas id="barChart"></canvas>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 CyberRisk Prioritize. All Rights Reserved.</p>
    </footer>

    <script>
        const riskData = <?= json_encode($risk_data) ?>;

        const colorPalette = [
            '#dc3545', // red
            '#9e2835', // dark red
            '#6d1d24', // maroon
            '#495057', // dark gray
            '#343a40', // darker gray
            '#820c19', // deep red
            '#212529', // almost black
            '#5c1219'  // dark maroon
        ];

        // Pie Chart
        const pieChart = new Chart(document.getElementById('pieChart'), {
            type: 'pie',
            data: {
                labels: riskData.map(risk => risk.threat),
                datasets: [{
                    data: riskData.map(risk => risk.risk_exposure),
                    backgroundColor: colorPalette,
                    borderWidth: 2,
                    borderColor: '#212529',
                    hoverOffset: 20, // Adds separation on hover
                    hoverBorderWidth: 3,
                    hoverBorderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                layout: {
                    padding: 20
                },
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            color: 'white',
                            font: {
                                size: 12,
                                family: "'Arial', sans-serif"
                            },
                            padding: 20,
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    },
                    title: {
                        display: true,
                        text: 'Risk Exposure Distribution',
                        color: 'white',
                        font: {
                            size: 16,
                            weight: 'bold'
                        },
                        padding: 20
                    },
                    tooltip: {
                        backgroundColor: 'rgba(33, 37, 41, 0.9)',
                        titleColor: '#dc3545',
                        bodyColor: 'white',
                        borderColor: '#dc3545',
                        borderWidth: 1,
                        padding: 12,
                        displayColors: true,
                        callbacks: {
                            label: function(context) {
                                const value = context.raw;
                                return ` Risk Exposure: ${value.toFixed(2)}`;
                            }
                        }
                    }
                },
                animation: {
                    animateRotate: true,
                    animateScale: true
                }
            }
        });

        // Bar Chart
        const barChart = new Chart(document.getElementById('barChart'), {
            type: 'bar',
            data: {
                labels: riskData.map(risk => risk.threat),
                datasets: [{
                    label: 'Risk Exposure',
                    data: riskData.map(risk => risk.risk_exposure),
                    backgroundColor: colorPalette,
                    borderColor: colorPalette,
                    borderWidth: 1,
                    borderRadius: 5,
                    barThickness: 'flex',
                    maxBarThickness: 50,
                    hoverBackgroundColor: [
                        '#ff4d5e', // lighter red
                        '#b83341', // lighter dark red
                        '#7e222a', // lighter maroon
                        '#6c757d', // lighter gray
                        '#495057', // lighter dark gray
                        '#9e1625', // lighter deep red
                        '#343a40', // lighter almost black
                        '#731820'  // lighter dark maroon
                    ],
                    hoverBorderColor: '#ffffff',
                    hoverBorderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',  // This enables interactions across datasets
                    intersect: false // This makes it easier to trigger tooltips
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        enabled: true,
                        backgroundColor: 'rgba(33, 37, 41, 0.9)',
                        titleColor: '#dc3545',
                        bodyColor: 'white',
                        borderColor: '#dc3545',
                        borderWidth: 1,
                        padding: 12,
                        displayColors: true,
                        callbacks: {
                            title: function(tooltipItems) {
                                return tooltipItems[0].label; // Shows the threat name
                            },
                            label: function(context) {
                                const threat = riskData[context.dataIndex];
                                return [
                                    `Risk Exposure: ${context.raw.toFixed(2)}`,
                                    `Likelihood: ${threat.likelihood}`,
                                    `Impact: ${threat.impact}`,
                                    `Budget: $${threat.budget.toLocaleString()}`
                                ];
                            }
                        }
                    }
                },
                hover: {
                    mode: 'index',
                    intersect: false,
                    animationDuration: 200
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)'
                        },
                        ticks: {
                            color: 'white'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: 'white'
                        }
                    }
                },
                animation: {
                    duration: 1000,
                    easing: 'easeInOutQuart'
                },
                onClick: (event, elements) => {
                    if (elements && elements.length > 0) {
                        const index = elements[0].index;
                        const threat = riskData[index];
                        console.log('Clicked threat:', threat);
                    }
                }
            }
        });

        async function generatePDF() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF('p', 'mm', 'a4');
            const pageWidth = doc.internal.pageSize.getWidth();
            const pageHeight = doc.internal.pageSize.getHeight();
            const margin = 20;
            const usableWidth = pageWidth - (margin * 2);

            try {
                // Title page
                doc.setFontSize(24);
                doc.text('Risk Prioritization Report', margin, 40, { align: 'left' });
                
                doc.setFontSize(12);
                doc.text(`Generated on: ${new Date().toLocaleDateString()}`, margin, 55);
                doc.text(`Assessment: ${<?= json_encode($assessment['title']) ?>}`, margin, 65);

                // Summary section with proper spacing
                doc.setFontSize(16);
                doc.text('Executive Summary', margin, 85);
                doc.setFontSize(11);
                const summaryText = <?= json_encode($summary) ?>;
                const splitSummary = doc.splitTextToSize(summaryText, usableWidth);
                doc.text(splitSummary, margin, 95);

                // Calculate position for recommendations based on summary length
                const summaryHeight = splitSummary.length * 7; // Approximate height of summary text
                const recommendationsY = Math.max(130, 95 + summaryHeight + 20); // Ensure minimum spacing

                // Recommendations section
                doc.setFontSize(16);
                doc.text('Recommendations', margin, recommendationsY);
                doc.setFontSize(11);
                const recommendationsText = <?= json_encode($recommendations) ?>;
                const splitRecommendations = doc.splitTextToSize(recommendationsText, usableWidth);

                // Check if recommendations would overflow the page
                if (recommendationsY + splitRecommendations.length * 7 > pageHeight - margin) {
                    // Add new page if content would overflow
                    doc.addPage();
                    doc.setFontSize(16);
                    doc.text('Recommendations', margin, 30);
                    doc.setFontSize(11);
                    doc.text(splitRecommendations, margin, 40);
                } else {
                    // Continue on same page if there's enough space
                    doc.text(splitRecommendations, margin, recommendationsY + 10);
                }

                // Risk Table on new page
                doc.addPage();
                doc.setFontSize(16);
                doc.text('Prioritized Risks', margin, 30);
                
                const table = document.getElementById('riskTable');
                const tableCanvas = await html2canvas(table, {
                    scale: 2,
                    backgroundColor: '#ffffff'
                });
                const tableAspectRatio = tableCanvas.height / tableCanvas.width;
                const tableWidth = usableWidth * 0.9;
                const tableHeight = tableWidth * tableAspectRatio;
                
                doc.addImage(
                    tableCanvas.toDataURL('image/jpeg', 1.0), 
                    'JPEG', 
                    margin + (usableWidth - tableWidth) / 2,
                    40,
                    tableWidth,
                    Math.min(tableHeight, pageHeight - 60)
                );

                // Charts on new page
                doc.addPage();
                doc.setFontSize(16);
                doc.text('Risk Analysis Charts', margin, 30);

                // Add pie chart
                const pieCanvas = document.getElementById('pieChart');
                const chartWidth = usableWidth * 0.8;
                const chartHeight = (pageHeight - 100) / 2.5;
                
                doc.addImage(
                    pieCanvas.toDataURL('image/jpeg', 1.0),
                    'JPEG',
                    margin + (usableWidth - chartWidth) / 2,
                    40,
                    chartWidth,
                    chartHeight
                );

                // Add bar chart with spacing
                const barCanvas = document.getElementById('barChart');
                doc.addImage(
                    barCanvas.toDataURL('image/jpeg', 1.0),
                    'JPEG',
                    margin + (usableWidth - chartWidth) / 2,
                    chartHeight + 60,
                    chartWidth,
                    chartHeight
                );

                // Save the PDF
                doc.save(`Risk_Prioritization_Report_${new Date().toISOString().split('T')[0]}.pdf`);

            } catch (error) {
                console.error('Error generating PDF:', error);
                alert('There was an error generating the PDF. Please check the console for details.');
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
