<header>
	<div class="dws-menu">
		<ul class="dws-ul">
			<li class="dws-li"><a href="index.php"><i class="fa fa-home" aria-hidden="true"></i>Главная</a></li>
			<li class="dws-li"><a href="profile.php"><i class="fa fa-server" aria-hidden="true"></i>Профиль</a></li>
			<li class="dws-li"><a href="cvs.php"><i class="fa fa-folder-open" aria-hidden="true"></i> Резюме</a></li>
			<li class="dws-li"><a href="vacancies.php"><i class="fa fa-newspaper-o" aria-hidden="true"></i>Вакансии</a></li>
            <li class="dws-li"><a href="send.php"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Создать</a></li>
            <?php if(!empty($_SESSION)) : ?><li class="dws-li"><a href="vendor/logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Выйти</a></li>
            <li class="dws-li"><?php if (isApplicant()) echo $_SESSION['first_name'].' '.$_SESSION['last_name'];
            if (isEmployer()) echo $_SESSION['company']; ?></li>
            <?php endif;?>
		</ul>
	</div>
</header>