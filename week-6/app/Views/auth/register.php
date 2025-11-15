<?= $this->extend('layouts/auth_layout') ?>

<?= $this->section('content') ?>

<div class="auth-card auth-card-wide">
    <div class="auth-header">
        <div class="icon-wrapper">
            <i class="fas fa-user-plus"></i>
        </div>
        <h2>Create Account</h2>
        <p>Join us today and get started</p>
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
    
    <form action="<?= base_url('auth/attempt-register') ?>" method="post">
        <?= csrf_field() ?>
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label" for="full_name">Full Name</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="full_name" name="full_name" 
                               value="<?= old('full_name') ?>" placeholder="John Doe" required autofocus>
                        <i class="fas fa-user input-icon"></i>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label" for="username">Username</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="username" name="username" 
                               value="<?= old('username') ?>" placeholder="johndoe" required>
                        <i class="fas fa-at input-icon"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="form-group">
            <label class="form-label" for="email">Email Address</label>
            <div class="input-group">
                <input type="email" class="form-control" id="email" name="email" 
                       value="<?= old('email') ?>" placeholder="john@example.com" required>
                <i class="fas fa-envelope input-icon"></i>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password" name="password" 
                               placeholder="Minimum 8 characters" required>
                        <i class="fas fa-lock input-icon"></i>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label" for="password_confirm">Confirm Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password_confirm" name="password_confirm" 
                               placeholder="Re-enter your password" required>
                        <i class="fas fa-lock input-icon"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-user-plus"></i> Create Account
        </button>
    </form>
    
    <div class="auth-footer">
        <p>Already have an account? <a href="<?= base_url('auth/login') ?>">Sign In</a></p>
    </div>
    
    <div class="text-center mt-3">
        <a href="<?= base_url() ?>" class="btn-link text-muted">
            <i class="fas fa-arrow-left"></i> Back to Home
        </a>
    </div>
</div>

<?= $this->endSection() ?>
