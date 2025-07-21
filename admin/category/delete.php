<?php

 require_once '../../function/helpers.php';
 require_once '../../function/pdo_connection.php';
  require_once '../../function/check-login.php';

 global $pdo;

 if(isset($_GET['cat_id']) && $_GET['cat_id'] !== '')
 {

    $query = "DELETE FROM project.categories WHERE id = ? ; ";

    $statements = $pdo->prepare($query);

    $statements->execute([$_GET['cat_id']]);

 }

 redirect('admin/category/index.php');

?>