-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 12 2022 г., 13:47
-- Версия сервера: 10.5.15-MariaDB
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `work_finder`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cvs`
--

CREATE TABLE `cvs` (
  `cv_id` int(11) NOT NULL,
  `cv_user` int(11) NOT NULL,
  `cv_title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'должность',
  `cv_salary` int(11) NOT NULL COMMENT 'з/п',
  `cv_currency` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'валюта',
  `cv_schedule` int(11) NOT NULL COMMENT 'график работы',
  `cv_experience` int(11) NOT NULL COMMENT 'опыт',
  `cv_description` varchar(3000) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'описание'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `cvs`
--

INSERT INTO `cvs` (`cv_id`, `cv_user`, `cv_title`, `cv_salary`, `cv_currency`, `cv_schedule`, `cv_experience`, `cv_description`) VALUES
(2, 1, 'aefaef', 15000, 'Рубль', 3, 0, 'aefaefaef'),
(3, 3, 'Веб программист', 30000, 'Рубль', 1, 6, 'кпквпывкпывп');

-- --------------------------------------------------------

--
-- Структура таблицы `schedules`
--

CREATE TABLE `schedules` (
  `schedule_id` int(11) NOT NULL,
  `schedule_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `schedules`
--

INSERT INTO `schedules` (`schedule_id`, `schedule_name`) VALUES
(1, 'Полный день'),
(2, 'Сменный график'),
(3, 'Гибкий график'),
(4, 'Удаленная работа'),
(5, 'Вахтовый метод');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_role` varchar(25) NOT NULL COMMENT 'роль',
  `user_company` varchar(255) DEFAULT NULL COMMENT 'название компании',
  `user_last_name` varchar(100) DEFAULT NULL COMMENT 'фамилия',
  `user_first_name` varchar(100) DEFAULT NULL COMMENT 'имя',
  `user_patronymic` varchar(100) DEFAULT NULL COMMENT 'отчество',
  `user_login` varchar(100) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(65) NOT NULL,
  `user_avatar` varchar(255) DEFAULT NULL,
  `user_description` varchar(3000) DEFAULT NULL,
  `user_birthdate` date DEFAULT NULL COMMENT 'дата рождения',
  `user_gender` varchar(11) DEFAULT NULL COMMENT 'пол',
  `user_country` varchar(100) DEFAULT NULL COMMENT 'страна',
  `user_region` varchar(250) DEFAULT NULL COMMENT 'место проживания',
  `user_ed_level` varchar(50) DEFAULT NULL COMMENT 'уровень образования',
  `user_ed_institution` varchar(250) DEFAULT NULL COMMENT 'Учебнoе заведение',
  `user_ed_department` varchar(250) DEFAULT NULL COMMENT 'Факультет ',
  `user_ed_specialization` varchar(250) DEFAULT NULL COMMENT 'Специализация ',
  `user_ed_year` date DEFAULT NULL COMMENT 'год окончания'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `user_role`, `user_company`, `user_last_name`, `user_first_name`, `user_patronymic`, `user_login`, `user_email`, `user_password`, `user_avatar`, `user_description`, `user_birthdate`, `user_gender`, `user_country`, `user_region`, `user_ed_level`, `user_ed_institution`, `user_ed_department`, `user_ed_specialization`, `user_ed_year`) VALUES
(1, 'applicant', NULL, 'Иванов', 'Иван', 'Иванович', 'user1', '', '$2y$10$9WZqtYeQcsFMwUYkzZKZAudN/Ip5VOkDTuK4nDiZPBR3ujJfL61aC', '62a53862083ad.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut quis interdum metus. Vestibulum nec velit enim. Pellentesque posuere pulvinar nisi porttitor commodo. Aenean nec volutpat dui. Vestibulum id quam in mi egestas imperdiet quis ac est. Donec pellentesque, urna a fermentum tincidunt, nisl dui hendrerit sapien, ut interdum elit nibh vel enim. Donec est elit, interdum eget molestie sit amet, tincidunt aliquam massa. Mauris pharetra, nibh vel imperdiet tempor, felis orci consequat risus, a efficitur enim diam non risus. Suspendisse quis pharetra justo, non vulputate orci. Nulla malesuada eros at venenatis auctor.', '1985-06-04', 'Мужской', 'Ангуилья', 'Томская область', 'Кандидат наук', 'АБвГУ', 'Информатики', 'Программист', '2020-06-17'),
(2, 'employer', 'ООО Программист', NULL, NULL, NULL, 'comp1', 'c@c.ru', '$2y$10$kj3OBEeFH/WRIcDJJD75a.cNopK5ojb3qypsRrfKj5FhijiC7gLoS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'applicant', NULL, 'Петров', 'Петр', 'Петрович', 'user2', '', '$2y$10$AjZIUlqHi9h89ser6mDTMuTS/wZ3EjD/f/wFs6l/dX8OxxZdLRpKK', '62a5c345803e4.jpg', 'aefaefaefaef', '2013-01-17', 'Мужской', 'Россия', 'Тульская область', 'Бакалавр', 'АБВ', 'Математики', 'Программист', '2012-05-12');

-- --------------------------------------------------------

--
-- Структура таблицы `vacancies`
--

CREATE TABLE `vacancies` (
  `vacancy_id` int(11) NOT NULL,
  `vacancy_user` int(11) NOT NULL,
  `vacancy_title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vacancy_salary` int(11) NOT NULL,
  `vacancy_currency` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vacancy_schedule` int(11) NOT NULL,
  `vacancy_experience` int(11) NOT NULL,
  `vacancy_description` varchar(3000) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cvs`
--
ALTER TABLE `cvs`
  ADD PRIMARY KEY (`cv_id`),
  ADD KEY `cv_user` (`cv_user`),
  ADD KEY `cv_schedule` (`cv_schedule`);

--
-- Индексы таблицы `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`schedule_id`),
  ADD UNIQUE KEY `schedule_id` (`schedule_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Индексы таблицы `vacancies`
--
ALTER TABLE `vacancies`
  ADD PRIMARY KEY (`vacancy_id`),
  ADD KEY `vacancy_user` (`vacancy_user`),
  ADD KEY `vacancy_schedule` (`vacancy_schedule`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cvs`
--
ALTER TABLE `cvs`
  MODIFY `cv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `schedules`
--
ALTER TABLE `schedules`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `vacancies`
--
ALTER TABLE `vacancies`
  MODIFY `vacancy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `cvs`
--
ALTER TABLE `cvs`
  ADD CONSTRAINT `cvs_ibfk_1` FOREIGN KEY (`cv_user`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `cvs_ibfk_2` FOREIGN KEY (`cv_schedule`) REFERENCES `schedules` (`schedule_id`);

--
-- Ограничения внешнего ключа таблицы `vacancies`
--
ALTER TABLE `vacancies`
  ADD CONSTRAINT `vacancies_ibfk_1` FOREIGN KEY (`vacancy_user`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `vacancies_ibfk_2` FOREIGN KEY (`vacancy_schedule`) REFERENCES `schedules` (`schedule_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
