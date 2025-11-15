<?= $this->extend('layouts/auth_layout') ?>

<?= $this->section('content') ?>

<div class="auth-card">
    <div class="auth-header">
        <div class="icon-wrapper">
            <i class="fas fa-key"></i>
        </div>
        <h2>Forgot Password?</h2>
        <p>No worries, we'll send you reset instructions</p>
    </div>
    
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>
    
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>
    
    <div class="alert alert-info">
        <i class="fas fa-info-circle"></i> 
        Enter your email address and we'll send you a link to reset your password.
    </div>
    
    <form action="<?= base_url('auth/process-forgot-password') ?>" method="post">
        <?= csrf_field() ?>
        
        <div class="form-group">
            <label class="form-label" for="email">Email Address</label>
            <div class="input-group">
                <input type="email" class="form-control" id="email" name="email" 
                       value="<?= old('email') ?>" placeholder="Enter your email address" required autofocus>
                <i class="fas fa-envelope input-icon"></i>
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-paper-plane"></i> Send Reset Link
        </button>
        
        <div class="text-center mt-3">
            <a href="<?= base_url('auth/login') ?>" class="btn-link">
                <i class="fas fa-arrow-left"></i> Back to Login
            </a>
        </div>
    </form>
    
    <div class="text-center mt-3">
        <a href="<?= base_url() ?>" class="btn-link text-muted">
            <i class="fas fa-home"></i> Back to Home
        </a>
    </div>
</div>

<?= $this->endSection() ?>
