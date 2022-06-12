<?php
include 'vendor/session.php';
include 'vendor/connect.php';
include 'vendor/authorize.php';


include 'vendor/file_upload.php';
//session_start();
//$isApplicant = isApplicant();

$isApplicant = true;


if (!isset($_SESSION['user'])) {
    //header('Location: /');
}

$login = $_POST["login"];
$email = $_POST["email"];
$country = $_POST["country"];
$region = $_POST["region"];
$description = $_POST["description"];

if (isset($_POST['data_refresh'])) {
    if (!empty($_FILES['avatar']['name']))
    {
        $avatar = fileUpload('avatar');
    }

    if (isApplicant()) {
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $patronymic = $_POST["patronymic"];
        $gender = $_POST["gender"];
        $birthday = $_POST["birthday"];

        $ed_level = $_POST["ed_level"];
        $ed_institution = $_POST["ed_institution"];
        $ed_department = $_POST["ed_department"];
        $ed_specialization = $_POST["ed_specialization"];
        $ed_year = $_POST["ed_year"];


        $query = "UPDATE users SET user_last_name='{$last_name}', user_first_name='{$first_name}', user_patronymic='{$patronymic}', 
                     user_email='{$email}', ";
        if (!empty($avatar))
            $query .= "user_avatar='{$avatar}', ";
        $query .= "user_description='{$description}', user_country='{$country}', 
                     user_region='{$region}', user_birthdate='{$birthday}', user_gender='{$gender}',  user_ed_level='{$ed_level}', 
                     user_ed_institution='{$ed_institution}', user_ed_department='{$ed_department}', 
                     user_ed_specialization='{$ed_specialization}', user_ed_year='{$ed_year}'
                   WHERE user_id='{$_SESSION['id']}'";

        $mysqli->query($query);
    } elseif (isEmployer()) {
        $company = $_POST["company"];

        $query = "UPDATE users SET user_company='{$company}', user_email='{$email}', ";
        if (!empty($avatar))
            $query .= "user_avatar='{$avatar}', ";
        $query .= "user_description='{$description}', user_country='{$country}', user_region='{$region}'
                  WHERE user_id='{$_SESSION['id']}'";
        $mysqli->query($query);
    }
    //$_POST = array();
}

//$company = $_POST["company"];
//$last_name = $_POST["last_name"];
//$first_name = $_POST["first_name"];
//$patronymic = $_POST["patronymic"];
//$login = $_POST["login"];
//$email = $_POST["email"];
//$email = $_POST["avatar"];
//$description = $_POST["description"];
//$birthday = $_POST["birthday"];
//$gender = $_POST["gender"];
//$country = $_POST["country"];
//$region = $_POST["region"];
//$ed_level = $_POST["ed_level"];
//$ed_institution = $_POST["ed_institution"];
//$ed_department = $_POST["ed_department"];
//$ed_specialization = $_POST["ed_specialization"];
//$ed_year = $_POST["ed_year"];

$query = "SELECT `user_company`, `user_last_name`, `user_first_name`, `user_patronymic`, `user_login`, `user_email`, `user_avatar`, `user_description`, `user_birthdate`, `user_gender`, `user_country`, `user_region`, `user_ed_level`, `user_ed_institution`, `user_ed_department`, `user_ed_specialization`, `user_ed_year` FROM `users` WHERE user_id={$_SESSION['id']} LIMIT 1";
$row = mysqli_fetch_row($mysqli->query($query));

$company = $row[0];
$last_name = $row[1];
$first_name = $row[2];
$patronymic = $row[3];
$login = $row[4];
$email = $row[5];
$avatar = $row[6];
$description = $row[7];
$birthday = $row[8];
$gender = $row[9];
$country = $row[10];
$region = $row[11];
$ed_level = $row[12];
$ed_institution = $row[13];
$ed_department = $row[14];
$ed_specialization = $row[15];
$ed_year = $row[16];


$title = 'Профиль';
include 'assets/templates/head.php';
?>
<body class="bg-light">
<?php include 'assets/templates/header.php'; ?>
<div class="form-container mx-auto w-50 ">
    <form class="bg-white p-3" action="profile.php" method="post" enctype="multipart/form-data">
        <a href="index.php">На главную</a>
        <h1>Профиль</h1>
        <section>
            <hr>
            <h3>Общие данные</h3>
            <div class="row">
                <div class="m-3 mt-0 col">
                    <img src="profiles/<?php echo $avatar ?>" alt="Изображение профиля" height="300px">
                </div>
                <div class="m-3 mt-0 col">
                    <label class="form-label" for="">Изображение профиля</label>
                    <input class="form-control" type="file" name="avatar" accept=".jpg, .jpeg, .png">
                </div>
            </div>
            <div class="row">
                <div class="m-3 mt-0 col">
                    <label class="form-label" for="login">Логин</label>
                    <input class="form-control" type="text" name="login" placeholder="Введите свой логин" required value="<?php echo $login ?>" disabled>
                </div>
                <div class="m-3 mt-0 col">
                    <label class="form-label" for="email">Почта</label>
                    <input class="form-control" type="email" name="email" placeholder="Введите адрес своей почты" required value="<?php echo $email ?>" disabled>
                </div>
            </div>
            <div class="row">
                <div class="m-3 mt-0 col">
                    <label class="form-label" for="country">Страна</label>
                    <?php include("assets/templates/country.php") ?>
                </div>

                <div class="m-3 mt-0 col">
                    <label class="form-label" for="country">Регион</label>
                    <?php include("assets/templates/region.php") ?>
                </div>
            </div>
        </section>
        <section>
            <hr>
            <h3>Личные данные</h3>

            <?php if ($isApplicant) : ?>
                <div class="row">
                    <div class="m-3 mt-0 col">
                        <label class="form-label" for="last_name">Фамилия</label>
                        <input class="form-control" type="text" name="last_name" placeholder="Фамилия" required value="<?php echo $last_name ?>">
                    </div>
                    <div class="m-3 mt-0 col">
                        <label class="form-label" for="">Пол</label>
                        <select class="form-select" name="gender">
                            <option value="Мужской">Мужской</option>
                            <option value="Женский">Женский</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="m-3 mt-0 col">
                        <label class="form-label" for="first_name">Имя</label>
                        <input class="form-control" type="text" name="first_name" placeholder="Имя" required value="<?php echo $first_name ?>">
                    </div>
                    <div class="m-3 mt-0 col">
                        <label class="form-label" for="">День рождения</label>
                        <input class="form-control" type="date" name="birthday" value="<?php echo $birthday ?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="m-3 mt-0 col">
                        <label class="form-label" for="patronymic">Отчество</label>
                        <input class="form-control" type="text" name="patronymic" placeholder="Отчество (не обязательно)" value="<?php echo $patronymic ?>" required>
                    </div>
                    <div class="m-3 mt-0 col">
                        <p></p>
                    </div>
                </div>
            <?php else : ?>
                <div class="row">
                    <div class="m-3 mt-0 col">
                        <label class="form-label" for="company">Компания</label>
                        <input class="form-control" type="text" name="company" placeholder="Имя" required value="<?php echo $company ?>" required>
                    </div>
                    <div class="m-3 mt-0 col">
                        <p></p>
                    </div>
                </div>
            <?php endif; ?>
            <div class="row">
                <div class="m-3 mt-0 col">
                    <label class="form-label"
                           for=""><?php if ($isApplicant) echo "О себе"; else echo "О компании"; ?></label>
                    <textarea class="form-control" name="description"><?php echo $description ?></textarea>
                </div>
            </div>
        </section>
        <?php if ($isApplicant) : ?>
        <section>
            <hr>
            <h3>Обучение</h3>
            <div class="row">
                <div class="m-3 mt-0 col">
                    <label class="form-label" for="country">Уровень образования</label>
                    <?php include("assets/templates/education.php") ?>
                </div>
                <div class="m-3 mt-0 col">
                    <label class="form-label" for="">Факультет</label>
                    <input class="form-control" type="text" name="ed_department" placeholder="" required value="<?php echo $ed_department ?>">
                </div>
            </div>
            <div class="row">
                <div class="m-3 mt-0 col">
                    <label class="form-label" for="">Учебнoе заведение</label>
                    <input class="form-control" type="text" name="ed_institution" placeholder="" required value="<?php echo $ed_institution ?>">
                </div>
                <div class="m-3 mt-0 col">
                    <label class="form-label" for="">Специализация</label>
                    <input class="form-control" type="text" name="ed_specialization" placeholder="" required value="<?php echo $ed_specialization ?>">
                </div>
            </div>
            <div class="row">
                <div class="m-3 mt-0 col">
                    <label class="form-label" for="">Год окончания</label>
                    <input class="form-control" type="date" name="ed_year" placeholder="" required value="<?php echo $ed_year ?>">
                </div>
            </div>
        </section>
        <?php endif; ?>
        <section>
<!--            <hr>-->
<!--            <div class="m-3 mt-0 col">-->
<!--                <label class="form-label" for="">Пароль</label>-->
<!--                <input class="form-control" type="password" name="password" placeholder="Введите пароль" required>-->
<!--                <div id="emailHelp" class="form-text">Для сохранения информации введите пароль</div>-->
<!--            </div>-->
            <div class="m-3 mt-0 col">
                <input type="text" name="data_refresh" hidden value="1">
                <input class="btn btn-primary" type="submit" value="Сохранить изменения">
            </div>
        </section>
    </form>
</div>
<script >
    function changeRegion(selector, value){
        let select = document.querySelector(selector);
        select.value=value;
    };
    changeRegion('select[name=region]', "<?php echo $region; ?>");
    changeRegion('select[name=country]', "<?php echo $country; ?>");
    changeRegion('select[name=gender]', "<?php echo $gender; ?>");
    changeRegion('select[name=ed_level]', "<?php echo $ed_level; ?>");
</script>
</body>
</html>
