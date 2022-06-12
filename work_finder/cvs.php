<?
include 'vendor/session.php';
include 'vendor/connect.php';
include 'vendor/authorize.php';

include 'assets/templates/cv.php';

function checkPostVar($var): bool
{
    return isset($var) && !empty($var);
}


$title = $_POST['title'];
$min = $_POST['range-val-min'];
$max = $_POST['range-val-max'];
$currency = $_POST['currency'];
$experience = $_POST['experience'];
if (!empty($_POST['schedule'])) {
    $schedule = "(" . implode(',', $_POST['schedule']) . ")";
}
$region = $_POST['region'];

$query = "SELECT `cv_id`, `cv_title`, `cv_salary`, `cv_currency`, `cv_schedule`, `cv_experience`, `cv_description`, 
       `user_last_name`, `user_first_name`, `user_ed_level`
FROM `cvs` 
JOIN users ON cv_user=user_id";
$where = "";
if (checkPostVar($title)) {
    $where .= "cv_title LIKE '%$title%' ";
}
if (checkPostVar($min) && checkPostVar($max)) {
    $where .= "AND cv_salary >= {$min} AND cv_salary <= {$max} ";
}
if (checkPostVar($currency)) {
    $where .= "AND cv_currency='{$currency}' ";
}
if (checkPostVar($schedule)) {
    $where .= "AND cv_schedule in {$schedule} ";
}
if (checkPostVar($experience)) {
    $where .= "AND cv_experience > {$experience} ";
}
if (checkPostVar($region)) {
    $where .= "AND user_region = '{$region}';";
}

if (!empty($where)) {
    $query .= " WHERE " . $where;
}

// получение своих посылок
$cards = "";
$query = str_replace("user_id WHERE AND","user_id WHERE", $query);
$result = $mysqli->query($query);

if (isset($result) && $result != false)
{
    while($row = mysqli_fetch_row($result))
    {
        $title = $row[1];
        $salary = $row[2];
        $currency = $row[3];
        $schedule = $row[4];
        $experience = $row[5];
        $description = $row[6];

        $cards .= getCVShort($title,$salary,$currency,$schedule,$experience,$description);
    }
}



$title = "Резюме";
include 'assets/templates/head.php';

?>
<body class="bg-light">
<?php include 'assets/templates/header.php'; ?>
<div class="form-container container d-flex align-items-center justify-content-center w-50">
    <form class="bg-white p-3" action="cvs.php" method="post">
        <h2>Резюме</h2>
        <div class="row">
            <div class="mt-3 col">

                <label class="mb-3">Должность</label>
                <input class="form-control" type="text" name="title">
                <div class="double-range-container ">
                    <label class="mb-1">Ожидаемый уровень зарплаты</label><br>
                    <div class="input-group">
                        <input class="form-control range-controls" type="text" name="range-val-min" value=""
                               pattern="^\d{5,7}">
                        <input class="form-control range-controls" type="text" name="range-val-max" value=""
                               pattern="^\d{5,7}">
                    </div>
                    <section class="range-slider mt-2 mb-2">
                        <input class="double-range" value="10000" min="10000" max="1000000" step="100" type="range">
                        <input class="double-range" value="1000000" min="10000" max="1000000" step="100" type="range">
                    </section>
                </div>
                <div class="">
                    <label class="form-label" for="currency">Валюта</label>
                    <select class="form-select" name="currency" id="currency">
                        <option value="Рубль">Рубль</option>
                        <option value="Евро">Евро</option>
                        <option value="Доллар">Доллар</option>
                    </select>
                </div>
            </div>
            <div class="mt-3 col container">
                <div class="checkboxes">
                    <label class="mb-3">Занятость</label>
                    <div class="mb-2 ">
                        <input class="form-checkbox" type="checkbox" name="schedule[]" value="1">
                        <label for="">Полный день</label>
                    </div>
                    <div class="mb-2 ">
                        <input class="form-checkbox" type="checkbox" name="schedule[]" value="2">
                        <label for="">Сменный график</label>
                    </div>
                    <div class="mb-2 ">
                        <input class="form-checkbox" type="checkbox" name="schedule[]" value="3">
                        <label for="">Гибкий график</label>
                    </div>
                    <div class="mb-2 ">
                        <input class="form-checkbox" type="checkbox" name="schedule[]" value="4">
                        <label for="">Удаленная работа</label>
                    </div>
                    <div class="mb-2 ">
                        <input class="form-checkbox" type="checkbox" name="schedule[]" value="5">
                        <label for="">Вахтовый метод</label>
                    </div>
                </div>
                <div class="mt-3">
                    <label class="form-label" for="experience">Опыт работы от</label>
                    <select class="form-select" name="experience" id="experience">
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

        <div class="mt-3">
            <input class="form-control btn btn-primary" type="submit" value="Подобрать резюме">
        </div>
    </form>
</div>

<div class="document-container flex-column d-flex align-items-center justify-content-center">
    <h3>Результаты поиска</h3>
    <?php
//    echo shortDocument("Программист","60 000", "Рубль", "Полная занятость", "3 года", "ыклпыклпыкполр", 2);
//    echo getVacancyShort("Программист","60 000", "Рубль", "Полная занятость", "3 года", "ыклпыклпыкполр", "ООО Компания");
//    echo document("Программист","60 000", "Рубль", "Полная занятость", "3 года", "ыклпыклпыкполр",
//        "Иванов", "Иван", "Иванович",
//        "Бакалавр", "ТГПУ", "Факультет математики", "МОАИС", "2021");
//

    echo $cards;
    ?>

</div>
    <script type="text/javascript">
        // double slider

        let min_value = 10000;
        let max_value = 1000000;

        function getValueIntoInputText() {
            // Get slider values
            let slides = document.querySelectorAll("input[type=range].double-range");
            console.log(slides);
            let slide1 = parseFloat(slides[0].value);
            let slide2 = parseFloat(slides[1].value);
            // Neither slider will clip the other, so make sure we determine which is larger
            if (slide1 > slide2) {
                let tmp = slide2;
                slide2 = slide1;
                slide1 = tmp;
            }

            let min_elem_input = document.querySelector("input[name=range-val-min]");
            let max_elem_input = document.querySelector("input[name=range-val-max]");
            min_elem_input.value = slide1;
            max_elem_input.value = slide2;
            // prev_min = slide1;
            // prev_max = slide2;
        }

        const prev_min = "min_value";
        document.querySelector("input[name=range-val-min]").addEventListener('input', function () {
            const v = parseInt(this.value, 10);
            if (Number.isInteger(v) && !isNaN(v)) {
                this.value = v;
                console.log(v);
            }
            console.log(v);
            if (v < max_value + 1) {
                refreshFromInput();
            } else if (!isNaN(v)) {
                this.value = min_value;
            }
        });
        const prev_max = "max_value";
        document.querySelector("input[name=range-val-max]").addEventListener('input', function () {
            let v = parseInt(this.value, 10);
            if (!isNaN(v)) {
                this.value = v;
                console.log(v);
            }
            v = this.value;
            console.log(v);
            if (v < max_value + 1) {
                this.value = v;
                refreshFromInput();
            } else if (!isNaN(v)) {
                this.value = max_value;
            }
        });

        document.querySelector("input[name=range-val-min]").addEventListener('change', function () {
            this.value = Math.max(Math.min(max_value, this.value), min_value);
            refreshFromInput();
        });
        document.querySelector("input[name=range-val-max]").addEventListener('change', function () {
            if (this.value < min_value || this.value > max_value) {
                this.value = max_value;
            }
            refreshFromInput();
        });

        function refreshFromInput() {
            let min_elem_input = document.querySelector("input[name=range-val-min]").value;
            let max_elem_input = document.querySelector("input[name=range-val-max]").value;
            console.log(min_elem_input);

            if (min_elem_input > max_elem_input) {
                let tmp = min_elem_input;
                min_elem_input = max_elem_input;
                max_elem_input = tmp;
            }

            let slides = document.querySelectorAll("section>input[type=range]");
            console.log(slides);
            slides[0].value = min_elem_input;
            slides[1].value = max_elem_input;
        }

        window.onload = function () {
            document.querySelectorAll("section.range-slider>input[type=range]").forEach(
                elem => {
                    elem.oninput = getValueIntoInputText;
                    // Manually trigger event first time to display values
                    elem.oninput();
                });
        }
    </script>