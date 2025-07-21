<?php

require_once  'function/helpers.php';
require_once 'function/pdo_connection.php';
global $pdo;
$postNotFound = false;


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@100..900&display=swap" rel="stylesheet">
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
            <section class="col-md-12">
            <?php
            
                    $query = "SELECT post.*, categories.name AS catName, categories.id as catID FROM post LEFT JOIN categories ON
                    post.cat_id = categories.id WHERE status = 10 AND post.id = ? ;";

                    $statements = $pdo->prepare($query);
                    $statements->execute([$_GET['post_id']]);
                    $post = $statements->fetch();
                    if($post !== false){  ?>
                <h1><?= $post->title ?></h1>
                <h5 class="d-flex justify-content-between align-items-center">
                    <a href="<?= url('category.php?cat_id=') . $post->catID ?>"><?= $post->catName ?></a>
                    <span class="date-time"><?= $post->created_at ?></span>
                </h5>
                <article class="bg-article p-3">
                <img class="float-right mb-2 ml-2" src="" alt="">
                <?= $post->body?></article>
            <?php }else {?>
                    <section>post not found!</section>
                    <?php } ?>
            </section>
        </section>
    </section>

</section>
<script src="<?php assets('assets/js/jquery.min.js')?>"></script>
<script src="<?= assets('assets/js/bootstrap.min.js') ?>"></script>
</body>
</html>