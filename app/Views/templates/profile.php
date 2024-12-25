<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Section</title>
    <?= $this->include('templates/header'); ?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .profile-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 0 20px rgba(0,0,0,0.05);
            max-width: 500px;
            margin: 2rem auto;
        }
        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 2rem;
        }
        .profile-title {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 2rem;
        }
        .profile-info {
            margin-bottom: 1.5rem;
        }
        .profile-label {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 0.3rem;
            text-transform: uppercase;
        }
        .profile-value {
            font-size: 1.1rem;
            color: #212529;
        }
        .divider {
            height: 1px;
            background-color: #dee2e6;
            margin: 1rem 0;
        }
    </style>

</head>
<body>
    <?= $this->include('templates/navbar'); ?>
    <div class="container">
        <div class="profile-card">
            <h1 class="profile-title">About Me!!</h1>
            
            <div class="text-center">
                <img src="<?= base_url('assets/img/fadha.jpg'); ?>" class="profile-image" alt="Profile Picture">
            </div>

            <div class="profile-info">
                <div class="profile-label">Name</div>
                <div class="profile-value">Mufadha Tiohandra</div>
            </div>

            <div class="divider"></div>

            <div class="profile-info">
                <div class="profile-label">NIM</div>
                <div class="profile-value">11210930000044</div>
            </div>

            <div class="divider"></div>

            <div class="profile-info">
                <div class="profile-label">University</div>
                <div class="profile-value">UIN Syarif Hidayatullah Jakarta</div>
            </div>

            <div class="divider"></div>

            <div class="profile-info">
                <div class="profile-label">Phone</div>
                <div class="profile-value">+62 821-8203-3386</div>
            </div>

            <div class="divider"></div>

            <div class="profile-info">
                <div class="profile-label">Major</div>
                <div class="profile-value">Information Systems</div>
            </div>
        </div>
    </div>

    <?= $this->include('templates/footer'); ?>
</body>
</html>