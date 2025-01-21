<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
include 'navbar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deepfakes - Cyber Risk Prioritization System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('pixelcut-export (1).jpeg'); /* Replace with your image path */
            background-size: cover;
            background-attachment: fixed;
            color: #fff;
        }
        .container {
            background: rgba(0, 0, 0, 0.8);
            padding: 30px;
            border-radius: 10px;
        }
        h2 {
            color: #ffc107;
        }
        .section {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 15px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Deepfakes</h1>
        <p class="text-center">
            Deepfakes are synthetic media created using artificial intelligence to realistically mimic or alter a person’s likeness, voice, or actions. While they have creative applications, they are often associated with risks like misinformation, impersonation, and fraud.
        </p>

        <h2>How Deepfakes Work</h2>
        <div class="section">
            <p><strong>Training Data:</strong> AI models are trained on large datasets of images, videos, or audio of the person being mimicked.</p>
            <p><strong>Generation and Refinement:</strong> AI generates content matching the target's expressions, voice, and movements.</p>
            <p><strong>Continuous Improvement:</strong> Generative Adversarial Networks (GANs) use two models (a generator and a discriminator) to create and refine realistic media.</p>
        </div>

        <h2>Common Types of Deepfakes</h2>
        <div class="section">
            <p><strong>Video Deepfakes:</strong> Manipulates facial features in videos to make it appear as if someone is doing or saying things they haven't.</p>
            <p><strong>Audio Deepfakes:</strong> Uses AI to replicate someone's voice, enabling fake phone calls or voice commands.</p>
            <p><strong>Image Deepfakes:</strong> Alters photos to change a person’s face or features in single-frame manipulations.</p>
        </div>

        <h2>Applications of Deepfakes</h2>
        <div class="section">
            <p><strong>Entertainment and Media:</strong> Used in movies or games for digital recreations or voiceovers.</p>
            <p><strong>Educational and Training:</strong> Simulated environments use deepfakes for training, such as replicating historical figures.</p>
            <p><strong>Marketing and Advertising:</strong> Allows brands to create personalized and engaging content.</p>
        </div>

        <h2>Risks and Ethical Concerns</h2>
        <div class="section">
            <p><strong>Misinformation and Propaganda:</strong> Deepfakes can spread false information, particularly in politics, skewing public perception.</p>
            <p><strong>Identity Theft and Fraud:</strong> Audio and video deepfakes enable impersonation, facilitating scams and financial fraud.</p>
            <p><strong>Cyberbullying and Harassment:</strong> Misused to create defamatory or harmful content targeting individuals.</p>
            <p><strong>Loss of Trust:</strong> Deepfake proliferation can erode trust in media and information sources.</p>
        </div>

        <h2>How to Detect Deepfakes</h2>
        <div class="section">
            <ul>
                <li><strong>Visual Cues:</strong> Look for unnatural blinking, mismatched lighting, or unusual facial movements.</li>
                <li><strong>AI and Detection Tools:</strong> Use tools like Microsoft’s Video Authenticator to spot manipulation signs.</li>
                <li><strong>Metadata Analysis:</strong> Check file metadata for editing or manipulation clues.</li>
            </ul>
        </div>

        <h2>Protecting Against Deepfakes</h2>
        <div class="section">
            <p><strong>Digital Literacy and Awareness:</strong> Public awareness helps individuals recognize deepfakes.</p>
            <p><strong>Verification Practices:</strong> Cross-reference information and use fact-checking sites to identify fake media.</p>
            <p><strong>Watermarking and Verification Technology:</strong> Researchers are developing tools to authenticate original media and identify manipulations.</p>
        </div>

        <!-- Additional Information and Reference Link -->
        <p class="mt-4">
            Deepfakes are an evolving technology with both positive and negative impacts. For more information on deepfakes, please visit <a href="https://www.cisa.gov/deepfakes" target="_blank" class="text-warning">CISA's Deepfake Guide</a>.
        </p>

        <!-- Back Button -->
        <div class="text-center mt-4">
            <a href="education.php" class="btn btn-warning">Back to Educational Components</a>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
