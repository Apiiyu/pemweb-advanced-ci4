<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Protal Berita Codeigniter</title>

	<!-- Bootstrap CSS (Rafi Khoirulloh 41122100074) -->
	<link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>" />
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