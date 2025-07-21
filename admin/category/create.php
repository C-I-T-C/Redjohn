<?php

 require_once '../../function/helpers.php';
 require_once '../../function/pdo_connection.php';
 require_once '../../function/check-login.php';

 global $pdo;

 if(isset($_POST['name']) && $_POST['name'] !== '')
 {

    $query = "INSERT INTO project.categories SET name = ? , created_at = NOW(); ";

    $statements = $pdo->prepare($query);

    $statements->execute([$_POST['name']]);

    redirect('admin/category/index.php');

 }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@100..900&display=swap" rel="stylesheet">
    <title>PHP panel</title>
<link rel="stylesheet" href=" <?= assets('assets/css/bootstrap.min.css') ?>" media="all" type="text/css">
    <link rel="stylesheet" href=" <?=  assets('assets/css/style.css') ?> " media="all" type="text/css">
</head>

<body>
    <section id="app">
        <?php require_once "../layout/top-nav.php"; ?>

        <section class="container-fluid">
            <section class="row">
                <section class="col-md-2 p-0">
                     <?php require_once "../layout/sidebar.php"; ?>
                </section>
                <section class="col-md-10 pt-3">

                    <form action="<?= url('admin/category/create.php') ?>" method="post">
                        <section class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="name ...">
                        </section>
                        <section class="form-group">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </section>

                    </form>

                </section>
            </section>
        </section>

    </section>

<script src="<?php assets('assets/js/jquery.min.js')?>"></script>
<script src="<?= assets('assets/js/bootstrap.min.js') ?>"></script>
</body>

</html>