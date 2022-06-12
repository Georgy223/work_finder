<?php
include 'vendor/session.php';
include 'vendor/connect.php';

include 'assets/templates/head.php';
include 'assets/templates/header.php';
?>
<body class="bg-light">
<div class="form-container signin d-flex align-items-center justify-content-center">
    <form class="bg-white p-3" action="vendor/signin.php" method="post">
        <h2>Вход</h2>
        <div class="row">
            <div class="col">
                <label class="form-label" for="login" class="required">Логин</label>
                <input class="form-control" type="text" required name="login">
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label class="form-label" for="password" class="required">Пароль</label>
                <input class="form-control" type="password" required name="password">
            </div>
        </div>
        <div class="row">
            <div class="col mt-3">
            <input class="form-control" type="submit" value="Войти">
        </div>
        <div class="row">
            <p class="col m-2 text-primary text-center"><? if (isset($_SESSION['message'])) echo $_SESSION['message']; ?></p>
        </div>
</div>
</form>
</div>