<?php
// You can add any server-side PHP logic here if needed
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personalized Fitness and Nutrition Coaching</title>
    
    <!-- Favicon -->
    <link rel="icon" href="img/logo.png" type="image/x-icon">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <!-- Custom CSS -->
    <style>
        /* Dark Red Theme Variables */
        :root {
            --primary-color: #8B0000; /* Dark Red */
            --secondary-color: #FF6347; /* Tomato */
            --background-color: #f8f9fa; /* Light Gray */
            --text-color: #ffffff; /* White */
        }

        body {
            font-family: 'Arial', sans-serif;
        }

        /* Navbar */
        .navbar {
            background-color: var(--primary-color);
        }
        .navbar .navbar-brand,
        .navbar .nav-link {
            color: var(--text-color) !important;
        }
        .navbar .nav-link.active,
        .navbar .nav-link:hover {
            color: var(--secondary-color) !important;
        }

        /* Hero Section */
        .hero {
            /* Adding a linear gradient overlay on top of the background image */
            background: linear-gradient(
                    rgba(0, 0, 0, 0.5), /* Top color with opacity */
                    rgba(0, 0, 0, 0.5)  /* Bottom color with opacity */
                ),
                url('img/bg.jpeg') center center/cover no-repeat;
            height: 100vh;
            color: var(--text-color);
            display: flex;
            align-items: center;
            text-align: center;
        }
        .hero h1 {
            font-size: 4rem;
            font-weight: bold;
        }
        .hero p {
            font-size: 1.5rem;
            margin-bottom: 2rem;
        }

        /* Features Section */
        .features {
            padding: 4rem 0;
            background-color: var(--background-color);
        }
        .feature-icon {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        /* Buttons */
        .btn-primary,
        .btn-success {
            background-color: var(--primary-color);
            border: none;
        }
        .btn-primary:hover,
        .btn-success:hover {
            background-color: var(--secondary-color);
        }

        /* Footer */
        .footer {
            background-color: var(--background-color);
            padding: 2rem 0;
        }
        .footer p {
            color: #6c757d;
        }

        /* Optional: Adjust button styles for better visibility */
        .btn-success, .btn-primary {
            transition: background-color 0.3s ease;
        }
        .btn-success:hover, .btn-primary:hover {
            opacity: 0.9;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }
            .hero p {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">Personalized Fitness & Nutrition Coaching</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link active" href="#hero">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
                    <!-- Removed Download and Contact links -->
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="hero" class="hero">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h1>Achieve Your Fitness Goals</h1>
                    <p>Personalized coaching tailored to your fitness and nutrition needs.</p>
                    <!-- Download Button -->
                    <div class="mt-4">
                        <a href="u/uploads/GoodLife.apk" class="btn btn-success btn-lg">
                            <i class="bi bi-download"></i> Download App
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4">
                    <div class="feature-icon">
                        <i class="bi bi-bar-chart-line"></i>
                    </div>
                    <h3>Customized Plans</h3>
                    <p>Receive tailored fitness and nutrition plans designed just for you.</p>
                </div>
                <div class="col-md-4">
                    <div class="feature-icon">
                        <i class="bi bi-heart-pulse"></i>
                    </div>
                    <h3>Health Monitoring</h3>
                    <p>Track your health metrics and progress seamlessly within the app.</p>
                </div>
                <div class="col-md-4">
                    <div class="feature-icon">
                        <i class="bi bi-graph-up"></i>
                    </div>
                    <h3>Progress Tracking</h3>
                    <p>Visualize your progress with detailed analytics and reports.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer text-center">
        <div class="container">
            <p class="mb-0">&copy; <?php echo date("Y"); ?> Goodlife Fitness Center. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS and dependencies (Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
