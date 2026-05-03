<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Register</title>

    <!-- Bootstrap 3 -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>

<body>

<div class="auth-page">

    <div class="auth-card">

        <div class="auth-brand">
            <div class="brand-icon">📝</div>
            <div>
                <h2>Create Account</h2>
                <p>Register to get started</p>
            </div>
        </div>

        <?php if($this->session->flashdata('error')): ?>
            <div class="alert alert-danger">
                <?= $this->session->flashdata('error') ?>
            </div>
        <?php endif; ?>

        <form id="registerorm" method="post" action="<?= base_url('auth/register/store') ?>">

            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" class="form-control input-lg" placeholder="Enter full name" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control input-lg" placeholder="Enter email" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control input-lg" placeholder="Enter password" required>
            </div>

            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control input-lg" placeholder="Confirm password" required>
            </div>

            <button type="submit" class="btn btn-primary btn-block btn-lg">
                Register
            </button>

        </form>

        <div class="extra-links">
            Already have an account? 
            <a href="<?= base_url('') ?>">Login</a>
        </div>

    </div>

</div>

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- Bootstrap JS -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script src="<?= base_url('assets/js/core.js') ?>"></script>

</body>
</html>