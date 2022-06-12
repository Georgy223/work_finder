<?php
require_once 'session.php';
require_once 'connect.php';

if($_POST['registration'] == '1') {
    $role = $_POST["role"];
    $login = $_POST["login"];
    $email = $_POST["email"];
    $pass = $_POST["password"];
    $confirm = $_POST["password_confirm"];
    //$desc = $_POST["description"];

    $query = "SELECT user_login FROM users WHERE user_login='" . $login . "' LIMIT 1";
    $query_result = $mysqli->query($query)->num_rows;

    if ($query_result) {
        die('Пользователь с таким логином уже существует');
    }

    unset($query);
    if ($pass !== $confirm) {
        die('Пароли не совпадают<br>');
    } else if (strlen($pass) < 2) {
        die('Нужно придумать пароль длиннее<br>');
    }
    $password_hash = password_hash($pass, PASSWORD_BCRYPT);
    if ($role == 'employer') {
        $company = $_POST["company"];

        $query = "INSERT INTO `users`(`user_role`, `user_company`, `user_login`, `user_email`, `user_password`) VALUES 
        ('{$role}', '{$company}','{$login}', '{$email}', '{$password_hash}');";
    }
    elseif ($role == "applicant"){
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $patronymic = $_POST["patronymic"];

        $query = "INSERT INTO `users`(`user_role`, `user_login`, `user_last_name`, `user_first_name`, `user_patronymic`, `user_email`, `user_password`) VALUES 
        ('{$role}', '{$login}', '{$last_name}', '{$first_name}', '{$patronymic}','{$email}', '{$password_hash}');";
    }

    if (!$query_result && isset($query)) {
        $query_result = $mysqli->query($query);

        if ($query_result) {
            $_SESSION['login'] = $login;
            $_SESSION['id'] = $mysqli->insert_id;
            $_SESSION['role'] = $role;
            $_POST = array();
            /*echo 'Регистрация прошла успешно';*/
 			//header('location: index.php');
        } else {
            echo 'Ошибка';
        }
    }
    else{
        echo 'Ошибка';
    }
    header('Location: signin.php');
}