<?php 

require_once '../../function/helpers.php';
require_once '../../function/pdo_connection.php';
require_once '../../function/check-login.php';


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

<?php require_once "../layout/top-nav.php" ?>

    <section class="container-fluid">
        <section class="row">
            <section class="col-md-2 p-0">
                <?= require_once "../layout/sidebar.php"; ?>
            </section>
            <section class="col-md-10 pt-3">

                <section class="mb-2 d-flex justify-content-between align-items-center">
                    <h2 class="h4">Categories</h2>
                    <a href="<?= url('admin/category/create.php') ?>" class="btn btn-sm btn-success">Create</a>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>name</th>
                                <th>setting</th>
                            </tr>
                        </thead>
                        <tbody>
                     
                        <?php 

                            global $pdo;

                            $query = "SELECT * FROM project.categories";

                            $statements = $pdo->prepare($query);

                            $statements->execute();

                            $categories =$statements->fetchAll();

                            foreach ($categories as $category) {
                        
                        ?>
                            <tr>
                                <td><?= $category->id ?></td>
                                <td><?= $category->name ?></td>
                                <td>
                                    <a href="<?= url('admin/category/edit.php?cat_id=') . $category->id ?>" class="btn btn-info btn-sm">Edit</a>
                                    <a href="<?= url('admin/category/delete.php?cat_id=') . $category->id ?>" class="btn btn-danger btn-sm">Delete</a>
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