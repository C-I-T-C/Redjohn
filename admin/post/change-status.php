<?php 

require_once "../../function/helpers.php";
require_once '../../function/pdo_connection.php';
 require_once '../../function/check-login.php';

global $pdo;

if(isset($_GET['post_id']) && $_GET['post_id'] !== '' )
{

    $query = "SELECT * FROM project.post WHERE id = ?";
    $statements = $pdo->prepare($query);
    $statements->execute([$_GET['post_id']]);
    $post = $statements->fetch();

    if($post !== false)
    {

        $status = ($post->status == 10) ? 0 : 10;

        $query = "UPDATE project.post SET status = ? WHERE id = ?";
        $statements = $pdo->prepare($query);
        $statements->execute([$status,$_GET['post_id']]);

        

    }

    
}
redirect('admin/post/index.php');



?>