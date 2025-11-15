<?= $this->extend('layouts/auth_layout') ?>

<?= $this->section('content') ?>

<div class="auth-card">
    <div class="auth-header">
        <div class="icon-wrapper">
            <i class="fas fa-shield-alt"></i>
        </div>
        <h2>Reset Password</h2>
        <p>Create a new secure password</p>
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
    
    <form action="<?= base_url('auth/process-reset-password') ?>" method="post">
        <?= csrf_field() ?>
        <input type="hidden" name="token" value="<?= esc($token) ?>">
        
        <div class="form-group">
            <label class="form-label" for="password">New Password</label>
            <div class="input-group">
                <input type="password" class="form-control" id="password" name="password" 
                       placeholder="Minimum 8 characters" required autofocus>
                <i class="fas fa-lock input-icon"></i>
            </div>
        </div>
        
        <div class="form-group">
            <label class="form-label" for="password_confirm">Confirm New Password</label>
            <div class="input-group">
                <input type="password" class="form-control" id="password_confirm" name="password_confirm" 
                       placeholder="Re-enter your password" required>
                <i class="fas fa-lock input-icon"></i>
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-check"></i> Reset Password
        </button>
    </form>
    
    <div class="auth-footer">
        <p>Remember your password? <a href="<?= base_url('auth/login') ?>">Sign In</a></p>
    </div>
    
    <div class="text-center mt-3">
        <a href="<?= base_url() ?>" class="btn-link text-muted">
            <i class="fas fa-home"></i> Back to Home
        </a>
    </div>
</div>

<?= $this->endSection() ?>
