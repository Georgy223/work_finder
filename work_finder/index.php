<?php
include 'vendor/session.php';
include 'vendor/connect.php';

if ($_SESSION['user']) {
    //header('Location: profile.php');
}


$title = "Кадровое агенство";
include 'assets/templates/head.php';

?>

<body class="bg-light">
<?php include 'assets/templates/header.php';?>
<div class="container flex-column d-flex align-items-center justify-content-center w-50">
<h2>Кадровое агенство</h2>
<p>Мы поможем найти работу или найти работников!</p>

</div>

<div class="m-3">
    <p class="text-center">
        <a href="register.php">Зарегистрироваться</a>
    </p>
</div>
<div class="m-3">
    <p class="text-center">
        У вас уже есть аккаунт? - <a href="signin.php">Войти</a>
    </p>
</div>


</body>
</html>