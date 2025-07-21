<?php 

require_once '../../function/helpers.php';
require_once '../../function/pdo_connection.php';
 require_once '../../function/check-login.php';
global $pdo;

if(isset($_POST['title'])  && $_POST['title'] !== '' AND
    isset($_POST['cat_id']) && $_POST['cat_id'] !== '' AND
     isset($_POST['body']) && $_POST['body'] !== '' AND
      isset($_FILES['image']) && $_FILES['image']['name'] !== '')
      {

    $query = "SELECT * FROM project.categories WHERE id = ?";
    $statements = $pdo->prepare($query);
    $statements->execute([$_POST['cat_id']]);
    $category = $statements->fetch();

    $allowedMimes = ['png', 'jpeg', 'jpg', 'gif'];

    $imageMimes = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

    if(!in_array($imageMimes , $allowedMimes))
    {
        redirect('admin/post/index.php');
    }

    $basePath = dirname(dirname(__DIR__));

    $image = '/assets/images/post/' . date("Y_m_d_H_i_s") . '.' . $imageMimes;

    $image_upload = move_uploaded_file($_FILES['image']['tmp_name'], $basePath . $image );

    if($category !== false && $image_upload !== false)
    {

        $query = "INSERT INTO project.post SET title = ?, cat_id = ?, body = ?, image = ?, created_at = NOW()";

        $statements = $pdo->prepare($query);

        $statements->execute([$_POST['title'],$_POST['cat_id'],$_POST['body'],$image]);



    }

        redirect('admin/post/index.php');

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
    <?php require_once '../layout/top-nav.php' ?>

    <section class="container-fluid">
        <section class="row">
            <section class="col-md-2 p-0">
                <?php require_once "../layout/sidebar.php"; ?>
            </section>
            <section class="col-md-10 pt-3">

                <form action="<?= url('admin/post/create.php') ?>" method="POST" enctype="multipart/form-data">
                    <section class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="title ...">
                    </section>
                    <section class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" name="image" id="image">
                    </section>
                    <section class="form-group">
                        <label for="cat_id">Category</label>
                        <select class="form-control" name="cat_id" id="cat_id">
                            <?php
                            $query = "SELECT * FROM project.categories";
                            $statements = $pdo->prepare($query);
                            $statements->execute();
                            $categories = $statements->fetchAll();
                            foreach($categories as $category){
                            ?>
                            <option value="<?= $category->id ?>"> <?= $category->name ?></option>
                            <?php }?>
                        </select>
                    </section>
                    <section class="form-group">
                        <label for="body">Body</label>
                        <textarea class="form-control" name="body" id="body" rows="5" placeholder="body ..."></textarea>
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