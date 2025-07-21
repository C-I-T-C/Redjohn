<?php

    session_start();

    require_once '../function/helpers.php';
    require_once '../function/pdo_connection.php';
    global $pdo;
    $error = '';

     if(isset($_SESSION['user']))
        {
         unset($_SESSION['user']);
        }

    if(isset($_POST['email']) && $_POST['email'] !== '' and 
        isset($_POST['password']) && $_POST['password'] !== '')
        {

            $query = "SELECT * FROM project.users WHERE email = ?";
            $statements = $pdo->prepare($query);
            $statements->execute([$_POST['email']]);
            $user = $statements->fetch();

            if($user !== false)
            {

                if(password_verify($_POST['password'], $user->password))
                {

                    $_SESSION['user'] = $user->email;
                    redirect('admin/index.php');

                }else{
                    $error = '!رمز عبور اشتباه است';
                }


            }else{
                $error = "!ایمیل وارد شده اشنباه است";
            }


        }else{

            if(!empty($_POST))
            {
                $error = "!همه فیلد ها الزامی است";
            }

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

        <section style="height: 100vh; background-color: #138496;" class="d-flex justify-content-center align-items-center">
            <section style="width: 20rem;">
                <h1 class="bg-warning rounded-top px-2 mb-0 py-3 h5">PHP Tutorial login</h1>
                <section class="bg-light my-0 px-2">
                    <small class="text-danger">
                        <?php if($error !== '') echo $error; ?>
                    </small></section>
                <form class="pt-3 pb-1 px-2 bg-light rounded-bottom" action="<?= url('auth/login.php') ?>" method="post">
                    <section class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="email ...">
                    </section>
                    <section class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="password ...">
                    </section>
                    <section class="mt-4 mb-2 d-flex justify-content-between">
                        <input type="submit" class="btn btn-success btn-sm" value="login">
                        <a class="" href="<?= url('auth/register.php') ?>">register</a>
                    </section>
                </form>
            </section>
        </section>

    </section>
<script src="<?php assets('assets/js/jquery.min.js')?>"></script>
<script src="<?= assets('assets/js/bootstrap.min.js') ?>"></script>
</body>

</html>