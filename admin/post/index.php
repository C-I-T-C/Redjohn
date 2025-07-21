<?php 

require_once '../../function/helpers.php';
require_once '../../function/pdo_connection.php';
require_once '../../function/check-login.php';
global $pdo;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP panel</title>
    <link rel="stylesheet" href=" <?= assets('assets/css/bootstrap.min.css') ?>" media="all" type="text/css">
    <link rel="stylesheet" href=" <?=  assets('assets/css/style.css') ?> " media="all" type="text/css">
</head>
<body>
<section id="app">

<?php require_once '../layout/top-nav.php' ?>


    <section class="container-fluid">
        <section class="row">
            <section class="col-md-2 p-0">
                <?php require_once "../layout/sidebar.php"; ?>
            </section>
            <section class="col-md-10 pt-3">

                <section class="mb-2 d-flex justify-content-between align-items-center">
                    <h2 class="h4">Articles</h2>
                    <a href="<?= url('admin/post/create.php') ?>" class="btn btn-sm btn-success">Create</a>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>image</th>
                            <th>title</th>
                            <th>cat_id</th>
                            <th>body</th>
                            <th>status</th>
                            <th>setting</th>
                        </tr>
                        </thead>
                        <tbody>

                            <?php
                            
                                $query =
                                "SELECT project.post.*, project.categories.name AS category_name FROM project.post LEFT JOIN
                                 project.categories ON project.post.cat_id = project.categories.id ; ";

                                $statements = $pdo->prepare($query);

                                $statements->execute();
                                
                                $posts = $statements->fetchAll();

                                foreach($posts as $post)
                                {

                                        
                            ?>
                            <tr>
                                <td><?= $post->id ?></td>
                                <td><img style="width: 80px; height: 40px;" src="<?= assets($post->image) ?>"></td>
                                <td><?= $post->title ?></td>
                                <td><?= $post->category_name ?></td>
                                <td><?=   " ... " . substr($post->body, 0,29)?></td>
                                <td>
                                    <?php 
                                    
                                        if( $post->status == 10)
                                        {
                                    ?>
                                    <span class="text-success">enable</span>
                                    <?php }else{ ?>
                                     <span class="text-danger">disable</span>
                                     <?php  } ?>
                                </td>
                                <td>
                                    <a href="<?= url('admin/post/change-status.php?post_id=') . $post->id?>" class="btn btn-warning btn-sm">Change status</a>
                                    <a href="<?= url("admin/post/edit.php?post_id=") . $post->id ?>" class="btn btn-info btn-sm">Edit</a>
                                    <a href="<?= url('admin/post/delete.php?post_id=') . $post->id ?>" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </section>


            </section>
        </section>
    </section>





</section>

<script src="<?php assets('assets/js/jquery.min.js')?>"></script>
<script src="<?= assets('assets/js/bootstrap.min.js') ?>"></script>
</body>
</html>