<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Protal Berita Codeigniter</title>

	<!-- Bootstrap CSS (Rafi Khoirulloh 41122100074) -->
	<link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>" />
	
	<!-- Font Awesome for icons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	
	<style>
		.navbar .btn {
			margin-left: 10px;
			padding: 8px 20px;
			border-radius: 5px;
			font-weight: 500;
			transition: all 0.3s ease;
		}
		
		.navbar .btn-outline-light:hover {
			background: white;
			color: #007bff !important;
			transform: translateY(-2px);
		}
		
		.navbar .btn-light:hover {
			transform: translateY(-2px);
			box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
		}
	</style>
</head>

<body>
    <?= $this->include('partials/navbar') ?>
    <?= $this->include('partials/header') ?>
    <?= $this->renderSection('content') ?>
    <?= $this->include('partials/footer') ?>

	<!-- Jquery dan Bootsrap JS -->
	<script src="<?= base_url('js/jquery.min.js') ?>"></script>
	<script src="<?= base_url('js/bootstrap.min.js') ?>"></script>
</body>

</html>