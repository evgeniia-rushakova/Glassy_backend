<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<link href="../views/css/normalize.css" rel="stylesheet">
	<link rel="stylesheet" href="../views/css/style.css" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&amp;subset=cyrillic" rel="stylesheet">
	<title>Глейси</title>
</head>
<body>
<div class="container">
	<header class="main-header">
		<div class="navigation-wrapper">
			<a class="main-header-logo" href="index.php">
				<img src="../views/img/header-logo.svg" alt="Логотип магазина" width="154" height="64">
			</a>
			<nav class="main-navigation inner">
				<ul class="site-navigation">
					<li class="active catalog-navigation-item-inner current-page">
						<a href="catalog.php?type=all">Каталог</a>
						<ul class="catalog-navigation">
							<li class="catalog-navigation-item-submenu"><a href="catalog.php?type=cream">Сливочное</a></li>
							<li class="catalog-navigation-item-submenu"><a href="catalog.php?type=choco">Шоколадные</a></li>
							<li class="catalog-navigation-item-submenu"><a href="catalog.php?type=mint">Мятные</a></li>
							<li class="catalog-navigation-item-submenu"><a href="catalog.php?type=fruit">Фруктовые</a></li>
						</ul>
					</li>
					<li class="catalog-navigation-item-inner"><a href="#">Доставка и оплата</a></li>
					<li class="catalog-navigation-item-inner"><a href="#">О Компании</a></li>
				</ul>
			</nav>
			<nav class="user-navigation-general">
				<ul class="user-navigation inner-user-navigation">
					<li class="user-navigation-item search-hover">
						<a class="search-link" href="#" aria-label="Поиск"></a>
						<section class="modal-search">
							<h3 class="visually-hidden">Поиск</h3>
							<form class="search-on-site" action="https://echo.htmlacademy.ru" method="get">
								<label class="visually-hidden" for="find">Введите сюда искомую информацию</label>
								<input class="placeholder input-style" type="search" placeholder="Что ищем?" name="find" id="find">
								<button class="visually-hidden" type="submit">Искать</button>
							</form>
						</section>
					</li>
                    {in-out}
					{cart}
				</ul>
			</nav>
		</div>
		<div class="information-breadcrumbs">
			<p class="contacts-information" aria-label="Часы работы и телефон"><span>С 10 до 20, ежедневно</span><a href=”tel:8-812-450-25-25″>8 812 450-25-25</a></p>
		</div>
	</header>