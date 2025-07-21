<?php

    require_once '../../function/helpers.php';
    require_once '../../function/pdo_connection.php';
     require_once '../../function/check-login.php';

    global $pdo;

    if(isset($_GET['post_id']) && $_GET['post_id'] !== '')
    {

        $query = "SELECT * FROM project.post WHERE id = ?";
        $statements = $pdo->prepare($query);
        $statements->execute([$_GET['post_id']]);

        $post = $statements->fetch();

        $basePath = dirname(dirname(__DIR__));

        if(file_exists($basePath . $post->image))
        {
            unlink($basePath . $post->image);
        }

        $query = "DELETE FROM project.post WHERE id = ?";
        $statements = $pdo->prepare($query);
        $statements->execute([$_GET["post_id"]]);



    }

    redirect('admin/post/index.php')


?>