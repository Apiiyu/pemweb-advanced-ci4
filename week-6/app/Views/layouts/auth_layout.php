<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= esc($title ?? 'Authentication') ?> - Portal Berita Codeigniter</title>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>" />
	
	<!-- Font Awesome for icons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	
	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	
	<style>
		:root {
			--primary-color: #6366f1;
			--primary-dark: #4f46e5;
			--secondary-color: #8b5cf6;
			--success-color: #10b981;
			--danger-color: #ef4444;
			--text-primary: #1f2937;
			--text-secondary: #6b7280;
			--bg-primary: #ffffff;
			--bg-secondary: #f9fafb;
			--border-color: #e5e7eb;
			--shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
			--shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
			--shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
			--shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
		}
		
		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}
		
		body {
			font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			background-attachment: fixed;
			color: var(--text-primary);
			line-height: 1.6;
		}
		
		.auth-wrapper {
			min-height: 100vh;
			display: flex;
			align-items: center;
			justify-content: center;
			padding: 60px 20px;
		}
		
		.auth-card {
			background: var(--bg-primary);
			border-radius: 24px;
			box-shadow: var(--shadow-xl);
			padding: 48px;
			width: 100%;
			max-width: 480px;
			animation: fadeInUp 0.6s ease-out;
		}
		
		.auth-card-wide {
			max-width: 720px;
		}
		
		@keyframes fadeInUp {
			from {
				opacity: 0;
				transform: translateY(30px);
			}
			to {
				opacity: 1;
				transform: translateY(0);
			}
		}
		
		.auth-header {
			text-align: center;
			margin-bottom: 40px;
		}
		
		.auth-header .icon-wrapper {
			width: 64px;
			height: 64px;
			background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
			border-radius: 16px;
			display: flex;
			align-items: center;
			justify-content: center;
			margin: 0 auto 24px;
			box-shadow: var(--shadow-lg);
		}
		
		.auth-header .icon-wrapper i {
			color: white;
			font-size: 28px;
		}
		
		.auth-header h2 {
			font-size: 28px;
			font-weight: 700;
			color: var(--text-primary);
			margin-bottom: 8px;
			letter-spacing: -0.5px;
		}
		
		.auth-header p {
			color: var(--text-secondary);
			font-size: 15px;
			font-weight: 400;
		}
		
		.form-group {
			margin-bottom: 24px;
		}
		
		.form-label {
			display: block;
			font-size: 14px;
			font-weight: 600;
			color: var(--text-primary);
			margin-bottom: 8px;
			letter-spacing: -0.2px;
		}
		
		.form-control {
			width: 100%;
			padding: 12px 16px;
			font-size: 15px;
			border: 2px solid var(--border-color);
			border-radius: 12px;
			transition: all 0.3s ease;
			font-family: 'Inter', sans-serif;
			background: var(--bg-secondary);
		}
		
		.form-control:focus {
			outline: none;
			border-color: var(--primary-color);
			background: white;
			box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
		}
		
		.form-control::placeholder {
			color: #9ca3af;
		}
		
		.input-group {
			position: relative;
		}
		
		.input-group .form-control {
			padding-left: 48px;
		}
		
		.input-group .input-icon {
			position: absolute;
			left: 16px;
			top: 50%;
			transform: translateY(-50%);
			color: var(--text-secondary);
			font-size: 16px;
			z-index: 1;
		}
		
		.form-control:focus ~ .input-icon {
			color: var(--primary-color);
		}
		
		.btn {
			padding: 14px 24px;
			font-size: 15px;
			font-weight: 600;
			border-radius: 12px;
			border: none;
			cursor: pointer;
			transition: all 0.3s ease;
			font-family: 'Inter', sans-serif;
			letter-spacing: -0.2px;
		}
		
		.btn-primary {
			background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
			color: white;
			width: 100%;
			box-shadow: var(--shadow-md);
		}
		
		.btn-primary:hover {
			transform: translateY(-2px);
			box-shadow: var(--shadow-lg);
		}
		
		.btn-primary:active {
			transform: translateY(0);
		}
		
		.btn-outline-primary {
			background: transparent;
			border: 2px solid var(--primary-color);
			color: var(--primary-color);
		}
		
		.btn-outline-primary:hover {
			background: var(--primary-color);
			color: white;
		}
		
		.btn-link {
			background: transparent;
			color: var(--primary-color);
			text-decoration: none;
			padding: 0;
			font-weight: 600;
		}
		
		.btn-link:hover {
			color: var(--primary-dark);
			text-decoration: underline;
		}
		
		.form-check {
			display: flex;
			align-items: center;
			margin: 20px 0;
		}
		
		.form-check-input {
			width: 20px;
			height: 20px;
			border: 2px solid var(--border-color);
			border-radius: 6px;
			cursor: pointer;
			margin-right: 10px;
		}
		
		.form-check-input:checked {
			background: var(--primary-color);
			border-color: var(--primary-color);
		}
		
		.form-check-label {
			font-size: 14px;
			color: var(--text-secondary);
			cursor: pointer;
			user-select: none;
		}
		
		.auth-divider {
			text-align: center;
			margin: 32px 0;
			position: relative;
		}
		
		.auth-divider::before {
			content: '';
			position: absolute;
			left: 0;
			top: 50%;
			width: 100%;
			height: 1px;
			background: var(--border-color);
		}
		
		.auth-divider span {
			background: white;
			padding: 0 16px;
			color: var(--text-secondary);
			font-size: 14px;
			position: relative;
			z-index: 1;
		}
		
		.auth-footer {
			text-align: center;
			margin-top: 32px;
			padding-top: 32px;
			border-top: 1px solid var(--border-color);
		}
		
		.auth-footer p {
			color: var(--text-secondary);
			font-size: 14px;
			margin: 0;
		}
		
		.auth-footer a {
			color: var(--primary-color);
			font-weight: 600;
			text-decoration: none;
		}
		
		.auth-footer a:hover {
			color: var(--primary-dark);
			text-decoration: underline;
		}
		
		.alert {
			padding: 16px 20px;
			border-radius: 12px;
			margin-bottom: 24px;
			border: none;
			font-size: 14px;
			font-weight: 500;
			animation: slideDown 0.4s ease-out;
		}
		
		@keyframes slideDown {
			from {
				opacity: 0;
				transform: translateY(-10px);
			}
			to {
				opacity: 1;
				transform: translateY(0);
			}
		}
		
		.alert-success {
			background: #d1fae5;
			color: #065f46;
		}
		
		.alert-danger {
			background: #fee2e2;
			color: #991b1b;
		}
		
		.alert-info {
			background: #dbeafe;
			color: #1e40af;
		}
		
		.alert-warning {
			background: #fef3c7;
			color: #92400e;
		}
		
		.text-muted {
			color: var(--text-secondary) !important;
			font-size: 14px;
		}
		
		.text-center {
			text-align: center;
		}
		
		.mt-3 {
			margin-top: 16px;
		}
		
		.mb-3 {
			margin-bottom: 16px;
		}
		
		.row {
			display: flex;
			margin: 0 -12px;
		}
		
		.col-md-6 {
			flex: 0 0 50%;
			max-width: 50%;
			padding: 0 12px;
		}
		
		@media (max-width: 768px) {
			.col-md-6 {
				flex: 0 0 100%;
				max-width: 100%;
			}
			
			.auth-card {
				padding: 32px 24px;
			}
			
			.auth-header h2 {
				font-size: 24px;
			}
		}
		
		/* Navbar styles */
		.navbar {
			background: rgba(255, 255, 255, 0.95) !important;
			backdrop-filter: blur(10px);
			box-shadow: var(--shadow-sm);
		}
		
		.navbar-brand {
			color: var(--primary-color) !important;
			font-weight: 700;
			font-size: 20px;
		}
		
		.nav-link {
			color: var(--text-primary) !important;
			font-weight: 500;
			padding: 8px 16px !important;
			border-radius: 8px;
			transition: all 0.3s ease;
		}
		
		.nav-link:hover {
			background: var(--bg-secondary);
			color: var(--primary-color) !important;
		}
		
		.navbar .btn {
			margin-left: 8px;
			padding: 8px 20px;
			border-radius: 10px;
			font-weight: 600;
			transition: all 0.3s ease;
			font-size: 14px;
		}
		
		.navbar .btn-outline-primary {
			background: transparent;
			border: 2px solid var(--primary-color);
			color: var(--primary-color);
		}
		
		.navbar .btn-outline-primary:hover {
			background: var(--primary-color);
			color: white;
			transform: translateY(-2px);
			box-shadow: var(--shadow-md);
		}
		
		.navbar .btn-primary {
			background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
			color: white;
			border: none;
		}
		
		.navbar .btn-primary:hover {
			transform: translateY(-2px);
			box-shadow: var(--shadow-md);
		}
	</style>
</head>

<body>
    <div class="auth-wrapper">
        <?= $this->renderSection('content') ?>
    </div>

	<!-- Jquery dan Bootsrap JS -->
	<script src="<?= base_url('js/jquery.min.js') ?>"></script>
	<script src="<?= base_url('js/bootstrap.min.js') ?>"></script>
	
	<script>
		// Auto dismiss alerts after 5 seconds
		setTimeout(function() {
			$('.alert').fadeOut('slow');
		}, 5000);
	</script>
</body>

</html>
