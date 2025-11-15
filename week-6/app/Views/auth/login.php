<?= $this->extend('layouts/auth_layout') ?>

<?= $this->section('content') ?>

<div class="auth-card">
    <div class="auth-header">
        <div class="icon-wrapper">
            <i class="fas fa-lock"></i>
        </div>
        <h2>Welcome Back</h2>
        <p>Sign in to continue to your account</p>
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
    
    <form action="<?= base_url('auth/attempt-login') ?>" method="post">
        <?= csrf_field() ?>
        
        <div class="form-group">
            <label class="form-label" for="identifier">Email or Username</label>
            <div class="input-group">
                <input type="text" class="form-control" id="identifier" name="identifier" 
                       value="<?= old('identifier') ?>" placeholder="Enter your email or username" required autofocus>
                <i class="fas fa-user input-icon"></i>
            </div>
        </div>
        
        <div class="form-group">
            <label class="form-label" for="password">Password</label>
            <div class="input-group">
                <input type="password" class="form-control" id="password" name="password" 
                       placeholder="Enter your password" required>
                <i class="fas fa-lock input-icon"></i>
            </div>
        </div>
        
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="remember" name="remember">
            <label class="form-check-label" for="remember">Keep me signed in</label>
        </div>
        
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-sign-in-alt"></i> Sign In
        </button>
        
        <div class="text-center mt-3">
            <a href="<?= base_url('auth/forgot-password') ?>" class="btn-link">
                <i class="fas fa-key"></i> Forgot your password?
            </a>
        </div>
    </form>
    
    <div class="auth-footer">
        <p>Don't have an account? <a href="<?= base_url('auth/register') ?>">Sign Up</a></p>
    </div>
    
    <div class="text-center mt-3">
        <a href="<?= base_url() ?>" class="btn-link text-muted">
            <i class="fas fa-arrow-left"></i> Back to Home
        </a>
    </div>
</div>

<?= $this->endSection() ?>
