<?php
    require_once 'connect.php';
    require_once 'session.php';

    session_unset();

    $login = $_POST['login'];

    $password = $_POST['password'];

    $query = "SELECT `user_login`,`user_role`, `user_id`, `user_password`, `user_company`,  `user_last_name`, 
       `user_first_name`, `user_patronymic`, `user_email`, `user_avatar`, `user_description`, `user_birthdate`, 
       `user_gender`, `user_country`, `user_region`, `user_ed_level`, `user_ed_institution`, `user_ed_department`, 
       `user_ed_specialization`, `user_ed_year` FROM users WHERE user_login ='".$login."' LIMIT 1";
    //"SELECT * user_login, user_role, user_id, user_password FROM users WHERE user_login ='". $login."' LIMIT 1";

    $result = $mysqli->query($query);

    $row = mysqli_fetch_array($result);

    if (password_verify($_POST['password'], $row[3]))
    {
        //var_dump($_SESSION);
        $_SESSION['login'] = $row[0];
        $_SESSION['role'] = $row[1];
        $_SESSION['id'] = $row[2];
        if (isApplicant())
        {
            $_SESSION['last_name'] = $row[5];
            $_SESSION['first_name'] = $row[6];
            $_SESSION['patronymic'] = $row[7];
        }

        if(isEmployer())
        {
            $_SESSION['company'] = $row[4];
        }
        $_SESSION['message'] = "Вход успешен";
    } else {
        $_SESSION['message'] = 'Неверный логин или пароль';
    }
header('Location: ../signin.php');