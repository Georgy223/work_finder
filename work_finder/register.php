<?php
include 'vendor/session.php';
include 'vendor/connect.php';
if (isset($_SESSION['user'])) {
    header('Location: profile.php');
}

$title = 'Профиль';
include 'assets/templates/head.php';
?>
<body class="bg-light">
<?php include 'assets/templates/header.php'; ?>
<div class="w-75 container d-flex align-items-center justify-content-center">
    <form class="bg-white p-3" action="vendor/signup.php" method="post">
        <div class="m-3">
            <h2 class="text-center">Регистрация соискателя</h2>
        </div>
        <div class="m-3">
            <label class="form-label" for="login">Логин</label>
            <input class="form-control" type="text" name="login" placeholder="Введите свой логин" required>
        </div>
        <div class="m-3">
            <label class="form-label" for="email">Почта</label>
            <input class="form-control" type="email" name="email" placeholder="Введите адрес своей почты" required>
        </div>
        <?php if (isset($_GET['register']) && $_GET['register'] == 'employer') : ?>
            <div class="m-3">
                <label class="form-label" for="">Компания</label>
                <input class="form-control" type="text" name="company" placeholder="Имя" required>
            </div>
        <?php else : ?>
            <div class="m-3">
                <label class="form-label" for="">Фамилия</label>
                <input class="form-control" type="text" name="last_name" placeholder="Фамилия" required>
            </div>
            <div class="m-3">
                <label class="form-label" for="">Имя</label>
                <input class="form-control" type="text" name="first_name" placeholder="Имя" required>
            </div>
            <div class="m-3">
                <label class="form-label" for="">Отчество</label>
                <input class="form-control" type="text" name="patronymic" placeholder="Отчество (не обязательно)">
            </div>
        <?php endif; ?>
        <div class="m-3">
            <label class="form-label" for="">Пароль</label>
            <input class="form-control" type="password" name="password" placeholder="Введите пароль" required>
        </div>
        <div class="m-3">
            <label class="form-label" for="">Подтверждение пароля</label>
            <input class="form-control" type="password" name="password_confirm" placeholder="Подтвердите пароль"
                   required>
        </div>
        <div class="m-3">
            <input type="text" hidden name="registration" value="1">
            <input type="text" hidden name="role" value="<?php if (isset($_GET['register']) && $_GET['register'] == 'employer') echo 'employer'; else echo 'applicant'; ?>">
            <input class="form-control btn btn-primary" type="submit" value="Зарегистироваться">
        </div>
        <div class="m-3">
            <p class="text-center">
                У вас уже есть аккаунт? - <a href="signin.php">Войти</a>
            </p>
        </div>
        <div class="m-3">
            <?php if (isset($_GET['register']) && $_GET['register'] == 'employer') : ?>
                <p class="text-center">
                    Регистрация для <a href="register.php">Соискателя</a>!
                </p>
            <?php else : ?>
                <p class="text-center">
                    Регистрация для <a href="register.php?register=employer">Работодателя</a>!
                </p>
            <?php endif; ?>
        </div>
        <div class="m-3">
            <?php
            if ($_SESSION['message']) {
                echo '<p class="text-center .text-danger"> ' . $_SESSION['message'] . ' </p>';
            }
            unset($_SESSION['message']);
            ?>
        </div>
    </form>
</div>

<script>

</script>
</body>
</html>