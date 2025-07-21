<?php

    require_once  'function/helpers.php';
    require_once 'function/pdo_connection.php';
    global $pdo;





?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP tutorial</title>
    <link rel="stylesheet" href=" <?= assets('assets/css/bootstrap.min.css') ?>" media="all" type="text/css">
    <link rel="stylesheet" href=" <?=  assets('assets/css/style.css') ?> " media="all" type="text/css">
</head>
<body>
<section id="app">

    <?php require_once 'layout/top-nav.php' ?>

    <section class="container my-5">
        <!-- Example row of columns -->
        <section class="row">
                <?php
                    $query = "SELECT * FROM project.post WHERE status = 10; ";
                    $statements = $pdo->prepare($query);
                    $statements->execute();
                    $posts = $statements->fetchAll();
                    foreach($posts as $post)
                    { ?>
                <section class="col-md-4">
                    <section class="mb-2 overflow-hidden" style="max-height: 30rem;">
                    <img style="width: 100%;height: 350px;"  class="img-fluid" src="<?= assets($post->image) ?>" alt="">
                    </section>
                    <h2 class="h5 text-truncate"><?= $post->title ?></h2>
                    <p><?= substr($post->body, 0, 29) ?></p>
                    <p><a class="btn btn-primary" href="<?= url('detail.php?post_id= ') . $post->id ?>" role="button">View details »</a></p>
                </section>
                   <?php } ?>
        </section>
    </section>

</section>
<script src="<?php assets('assets/js/jquery.min.js')?>"></script>
<script src="<?= assets('assets/js/bootstrap.min.js') ?>"></script>
</body>
</html>