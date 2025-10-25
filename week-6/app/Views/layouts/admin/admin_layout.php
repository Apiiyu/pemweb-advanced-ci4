<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Berita Codeigniter</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>" />
</head>

<body>

    <?= $this->include('partials/admin/navbar') ?>

    <div class="container my-5">
        <div class="row">
            <div class="col-md-12">
                <?= $this->renderSection('content') ?>
            </div>
        </div>
    </div>

    <!-- Custom scripts for all pages-->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="<?= base_url('js/bootstrap.min.js') ?>"></script>

</body>

</html>