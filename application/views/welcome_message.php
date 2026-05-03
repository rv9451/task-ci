<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f7fb;
        }
        .auth-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .auth-card {
            width: 100%;
            max-width: 420px;
            background: #fff;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .brand-icon {
            font-size: 30px;
            margin-bottom: 10px;
        }
        .auth-brand h2 {
            margin: 0;
        }
        .extra-links {
            text-align: center;
            margin-top: 15px;
        }
    </style>
</head>

<body>

<div class="auth-page">

    <div class="auth-card">

        <!-- Header -->
        <div class="text-center mb-4">
            <div class="brand-icon">🔐</div>
            <h4>Welcome Back</h4>
            <p class="text-muted small">Login to continue</p>
        </div>

        <!-- Error -->
        <?php if($this->session->flashdata('error')): ?>
            <div class="alert alert-danger">
                <?= $this->session->flashdata('error') ?>
            </div>
        <?php endif; ?>

        <!-- Form -->
        <form id="loginForm" method="post" action="<?= base_url('auth/login') ?>">

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter email" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter password" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">
                <i class="fa fa-sign-in-alt me-1"></i> Login
            </button>

        </form>

        <!-- Footer -->
        <div class="extra-links">
            <a href="<?= base_url('auth/register') ?>">Create Account</a>
        </div>

    </div>

</div>

<!-- Bootstrap 5 JS (no jQuery needed) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>