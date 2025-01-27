<?php
session_start();
require '../connection.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: index.php");
    exit;
}

$upload_error = "";
$upload_success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["apk_file"]) && $_FILES["apk_file"]["error"] == 0) {
        $allowed = array("apk" => "application/vnd.android.package-archive");
        $filename = $_FILES["apk_file"]["name"];
        $filetype = $_FILES["apk_file"]["type"];
        $filesize = $_FILES["apk_file"]["size"];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        if (strtolower($ext) !== "apk") {
            $upload_error = "Error: Please upload a valid APK file.";
        } elseif (in_array($filetype, $allowed)) {
            $maxsize = 50 * 1024 * 1024;
            if ($filesize > $maxsize) {
                $upload_error = "Error: File size is larger than the allowed limit.";
            } else {
                $upload_dir = "uploads/";
                if (!is_dir($upload_dir)) {
                    if (!mkdir($upload_dir, 0755, true)) {
                        $upload_error = "Error: Failed to create the uploads directory.";
                    }
                }

                if (!is_writable($upload_dir)) {
                    $upload_error = "Error: The uploads directory is not writable. Please check permissions.";
                } else {
                    $new_filename = "GoodLife.apk";

                    if (move_uploaded_file($_FILES["apk_file"]["tmp_name"], $upload_dir . $new_filename)) {
                        $upload_success = "The file has been uploaded successfully as " . htmlspecialchars($new_filename) . ".";
                    } else {
                        $upload_error = "Error: There was a problem uploading your file. Please try again.";
                    }
                }
            }
        } else {
            $upload_error = "Error: File type mismatch. Please upload a valid APK file.";
        }
    } else {
        $upload_error = "Error: " . $_FILES["apk_file"]["error"];
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload APK - Personalized Fitness and Nutrition Coaching</title>
    <link rel="icon" href="../img/logo.png" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
   <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .upload-container {
            margin-top: 5rem;
        }
        .upload-form {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .progress {
            margin-top: 1rem;
            height: 20px;
        }
        .error {
            color: red;
            margin-bottom: 1rem;
        }
        .success {
            color: green;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="../img/logo.png" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
                Admin Panel
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="upload.php">Upload APK</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout (<?php echo htmlspecialchars($_SESSION['admin_username']); ?>)</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container upload-container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="upload-form">
                    <h2>Upload Latest APK</h2>
                    <form id="uploadForm" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="apk_file" class="form-label">Select APK File</label>
                            <input type="file" class="form-control" id="apk_file" name="apk_file" accept=".apk" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Upload APK</button>
                    </form>
                    <div class="progress d-none">
                        <div class="progress-bar" role="progressbar" style="width: 0%;">0%</div>
                    </div>
                    <div id="responseMessage"></div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('uploadForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const form = e.target;
            const fileInput = document.getElementById('apk_file');
            const progressBar = document.querySelector('.progress-bar');
            const progressContainer = document.querySelector('.progress');
            const responseMessage = document.getElementById('responseMessage');

            if (fileInput.files.length === 0) {
                responseMessage.textContent = 'Please select a file to upload.';
                responseMessage.className = 'error';
                return;
            }

            const formData = new FormData(form);
            const xhr = new XMLHttpRequest();

            xhr.open('POST', 'upload.php', true);

            xhr.upload.onprogress = function (event) {
                if (event.lengthComputable) {
                    const percentComplete = Math.round((event.loaded / event.total) * 100);
                    progressBar.style.width = percentComplete + '%';
                    progressBar.textContent = percentComplete + '%';
                }
            };

            xhr.onloadstart = function () {
                progressContainer.classList.remove('d-none');
                progressBar.style.width = '0%';
                progressBar.textContent = '0%';
            };

            xhr.onload = function () {
                progressContainer.classList.add('d-none');
                if (xhr.status === 200) {
                    responseMessage.textContent = 'Upload successful!';
                    responseMessage.className = 'success';
                } else {
                    responseMessage.textContent = 'Upload failed. Please try again.';
                    responseMessage.className = 'error';
                }
            };

            xhr.onerror = function () {
                responseMessage.textContent = 'An error occurred while uploading. Please try again.';
                responseMessage.className = 'error';
            };

            xhr.send(formData);
        });
    </script>

    <!-- Bootstrap JS and dependencies (Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>
