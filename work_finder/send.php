<?php
include 'vendor/session.php';
include 'vendor/connect.php';
include 'vendor/authorize.php';

include 'assets/templates/cv.php';
if ($_SESSION['user']) {
    //header('Location: profile.php');
}

if (isset($_POST['send']))
{
    $user = $_SESSION['id'];
    $title = $_POST['title'];
    $salary = $_POST['salary'];
    $currency = $_POST['currency'];
    $schedule = $_POST['schedule'][0];
    $experience = $_POST['experience'];
    $description = $_POST['description'];

    if (isApplicant()) {
        $query = "INSERT INTO `cvs`(`cv_user`, `cv_title`, `cv_salary`, `cv_currency`, `cv_schedule`, `cv_experience`, `cv_description`) 
    VALUES ('$user','$title','$salary','$currency','$schedule','$experience','$description')";
    }
    if (isEmployer()) {
        $query = "INSERT INTO `vacancies`(`vacancy_user`, `vacancy_title`, `vacancy_salary`, `vacancy_currency`, 
                        `vacancy_schedule`, `vacancy_experience`, `vacancy_description`) 
    VALUES ('$user','$title','$salary','$currency','$schedule','$experience','$description')";
    }
    $mysqli->query($query);

}

// удаление
if (isset($_POST["delete"]))
{
    unset($query);
    unset($_POST["delete"]);
    $remove_id =$_POST["remove_id"];

    if ($remove_id > 0)
    {
        if (isApplicant()) {
            $query = "DELETE FROM cvs WHERE cv_id={$remove_id} AND cv_user={$_SESSION['id']}";
            }
        else{
            $query = "DELETE FROM vacancies WHERE vacancy_id={$remove_id} AND vacancy_user={$_SESSION['id']}";
        }
        $mysqli->query($query);
    }
}


// получение своих посылок
$cards = "";
if (isEmployer())
{
    $query = "SELECT `vacancy_id`, `vacancy_title`, `vacancy_salary`, `vacancy_currency`, `schedule_name`, `vacancy_experience`, `vacancy_description` 
        FROM `vacancies` JOIN schedules ON vacancy_schedule=schedule_id WHERE vacancy_user={$_SESSION['id']}";
}
if (isApplicant()) {
    $query = "SELECT `cv_id`, `cv_title`, `cv_salary`, `cv_currency`, `schedule_name`, `cv_experience`, `cv_description` 
        FROM `cvs` JOIN schedules ON cv_schedule=schedule_id WHERE cv_user={$_SESSION['id']}";
}
$result = $mysqli->query($query);

if (isset($result) && $result != false)
{
    while($row = mysqli_fetch_row($result))
    {
        $id = $row[0];
        $title = $row[1];
        $salary = $row[2];
        $currency = $row[3];
        $schedule = $row[4];
        $experience = $row[5];
        $description = $row[6];

        $cards .= getCVShort($title,$salary,$currency,$schedule,$experience,$description, $id);
    }
}


$title = "Кадровое агенство";
include 'assets/templates/head.php';

?>
<body class="bg-light">
<?php include 'assets/templates/header.php'; ?>
<div class="form-container container d-flex align-items-center justify-content-center w-50">
    <form class="bg-white p-3" action="send.php" method="post">
        <div class="row">
            <div class="mt-3 col">

                <label class="mb-3">Должность</label>
                <input class="form-control" type="text" name="title" required>
                <div class="double-range-container ">
                    <label class="mb-1">Ожидаемый уровень зарплаты</label><br>
                        <input class="form-control range-controls" type="text" name="salary" value="15000" required>
                </div>
                <div class="">
                    <label class="form-label" for="currency">Валюта</label>
                    <select class="form-select" name="currency" id="currency" required>
                        <option value="Рубль" selected>Рубль</option>
                        <option value="Евро">Евро</option>
                        <option value="Доллар">Доллар</option>
                    </select>
                </div>
            </div>
            <div class="mt-3 col container">
                <div class="checkboxes">
                    <label class="mb-3">Занятость</label>
                    <div class="mb-2 ">
                        <input class="form-radio" type="radio" name="schedule" value="1" required>
                        <label for="">Полный день</label>
                    </div>
                    <div class="mb-2 ">
                        <input class="form-radio" type="radio" name="schedule" value="2">
                        <label for="">Сменный график</label>
                    </div>
                    <div class="mb-2 ">
                        <input class="form-radio" type="radio" name="schedule" value="3">
                        <label for="">Гибкий график</label>
                    </div>
                    <div class="mb-2 ">
                        <input class="form-radio" type="radio" name="schedule" value="4">
                        <label for="">Удаленная работа</label>
                    </div>
                    <div class="mb-2 ">
                        <input class="form-radio" type="radio" name="schedule" value="5">
                        <label for="">Вахтовый метод</label>
                    </div>
                </div>
                <div class="mt-3">
                    <label class="form-label" for="experience">Опыт работы от</label>
                    <select class="form-select" name="experience" id="experience" required>
                        <option value="0">0 лет</option>
                        <option value="1">1 года</option>
                        <option value="2">2 лет</option>
                        <option value="3">3 лет</option>
                        <option value="4">4 лет</option>
                        <option value="5">5 лет</option>
                        <option value="6">6 лет</option>
                        <option value="7">7 лет</option>
                        <option value="8">8 лет</option>
                        <option value="9">9 лет</option>
                        <option value="10">10 лет</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label class="form-label" for="">Описание</label>
                <textarea class="form-control" name="description" required></textarea>
            </div>
        </div>
        <div class="mt-3">
            <input class="form-control btn btn-primary" type="submit" value="<?php if (isApplicant()) echo "Отправить резюме"; else echo "Создать вакансию"; ?>">
            <input type="text" name="send" value="1" hidden>
        </div>
    </form>
</div>
<div class="document-container flex-column d-flex align-items-center justify-content-center">
    <h2><?php if (isApplicant()) echo "Ваши резюме"; else echo "Ваши вакансии"; ?></h2>

    <?php
    //echo shortDocument("Программист","60 000", "Рубль", "Полная занятость", "3 года", "ыклпыклпыкполр", 2);
    //echo getVacancyShort("Программист","60 000", "Рубль", "Полная занятость", "3 года", "ыклпыклпыкполр", "ООО Компания");
    //    echo document("Программист","60 000", "Рубль", "Полная занятость", "3 года", "ыклпыклпыкполр",
    //        "Иванов", "Иван", "Иванович",
    //        "Бакалавр", "ТГПУ", "Факультет математики", "МОАИС", "2021");
    //

    ?>

    <?php echo $cards; ?>
</div>
<script>
    var regExpMask = IMask(
    document.querySelector('input[name=salary]'),
    {
        mask: /^\d+$/
    });

</script>