<?php

require_once  'function/helpers.php';
require_once 'function/pdo_connection.php';

global $pdo;
$catNotFound = false;
$postNotFound = false;
    if(isset($_GET['cat_id']) && $_GET['cat_id'] !== '' )
    {

        $query = "SELECT * FROM project.categories WHERE id = ?";
        $statements = $pdo->prepare($query);
        $statements ->execute([$_GET['cat_id']]);
        $category = $statements->fetch();
        if($category === false){

            redirect('index.php');

        }

    }else{
        redirect('index.php');
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
    <title>PHP tutorial</title>
    <link rel="stylesheet" href=" <?= assets('assets/css/bootstrap.min.css') ?>" media="all" type="text/css">
    <link rel="stylesheet" href=" <?=  assets('assets/css/style.css') ?> " media="all" type="text/css">
</head>
<body>
<section id="app">
    <?php require_once 'layout/top-nav.php' ?>

    <section class="container my-5">
      

                <?php
                    if(isset($_GET['cat_id']) && $_GET['cat_id'] !== '' )
                        {

                             $query = "SELECT * FROM project.categories WHERE id = ?";
                             $statements = $pdo->prepare($query);
                             $statements ->execute([$_GET['cat_id']]);
                             $category = $statements->fetch();
                             if($category !== false){ 
                              ?>
                    <section class="row">
                    <section class="col-12">              
                    <h1><?= $category->name ?></h1>
                    <hr>
                </section>
            </section>
            <section class="row">
               <?php 
                $query = "SELECT * FROM project.post WHERE status = 10 AND cat_id = ?;";
                $statements = $pdo->prepare($query);
                $statements->execute([$_GET['cat_id']]);
                $posts = $statements->fetchAll();
                foreach($posts as $post)
                {
                ?>
                    <section class="col-md-4">
                        <section class="mb-2 overflow-hidden" style="max-height: 30rem;"><img class="img-fluid" style="width: 100%;height: 350px;" src="<?= assets($post->image) ?>" alt=""></section>
                        <h2 class="h5 text-truncate"><?= $post->title ?></h2>
                        <p><?= substr($post->body, 0, 28)?></p>
                        <p><a class="btn btn-primary" href="<?= url('detail.php?post_id=') . $post->id ?>" role="button">View details »</a></p>
                </section>
                <?php  }
                 }else
                 { 
                    $catNotFound = true;
                 }
                 }else
                 { 
                    $catNotFound = true ;
                 }
                 ?>

            </section>

            <section class="row">
                <?php if($catNotFound){ ?>
                <section class="col-12">
                <h1>Category not found</h1>
                </section>
                <?php } ?>
            </section>
        </section>
        </section>
    </section>

</section>
<script src="<?php assets('assets/js/jquery.min.js')?>"></script>
<script src="<?= assets('assets/js/bootstrap.min.js') ?>"></script>
</body>
</html>