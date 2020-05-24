{header}
		<section class="slider">
			<div class="slider-controls">
				<label for="product-1" tabindex="0">Первый</label>
				<label for="product-2" tabindex="0">Второй</label>
				<label for="product-3" tabindex="0">Третий</label>
			</div>
			<ul class="slider-list">
				<li class="slider-item slide" id="slide1">
					<h3 class="slide-title">
						Крем-брюле и пломбир с брусничным джемом
					</h3>
					<a class="button slide-button" href="../server/add_to_cart.php?duo=rasp">Давайте оба!</a>
				</li>
				<li class="slider-item slide" id="slide2">
					<h3 class="slide-title">
						Кофейный пломбир и лимонное с карамелью
					</h3>
					<a class="button slide-button" href="../server/add_to_cart.php?duo=lemon">Давайте оба!</a>
				</li>
				<li class="slider-item slide" id="slide3">
					<h3 class="slide-title">
						Пломбир с шоколадом и черничное
					</h3>
					<a class="button slide-button" href="../server/add_to_cart.php?duo=straw">Давайте оба!</a>
				</li>
			</ul>
		</section>
		<main>
			<h1 class="visually-hidden">Магазин мороженого "Глэcси"</h1>
			<section class="special-offer">
				<h2 class="visually-hidden">Специальные предложения</h2>
				<div class="topping-gifts raspberry">
					<h3>Малинка даром!</h3>
					<p>При покупке 2 кг любого мороженого, добавим в ваш заказ банку малинового варенья бесплатно.</p>
					<a class="button button-raspberry" href="../server/add_to_cart.php?offer=raspberry">Хочу варенье!</a>
				</div>
				<div class="topping-gifts chocolate">
					<h3>Шоколадки даром!</h3>
					<p>При покупке 2 кг мороженого, добавим в ваш заказ упаковку вкуснейшей шоколадной присыпки совершенно бесплатно.</p>
					<a class="button button-chocolate" href="../server/add_to_cart.php?offer=chocolate">Хочу шоколадки!</a>
				</div>
			</section>
			<section class="type-of-icecream-list">
				<h2 class="visually-hidden">Перечень вкусов</h2>
				<ul class="catalog-list">
				{products}
				</ul>
			</section>
			<section class="our-features">
				<h2 class="visually-hidden">Наши преимущества</h2>
				<b>Магазин Глэйси — это онлайн- и офлайн-магазин по продаже мороженого собственного производства на развес</b>
				<p class="features icon-feature icecream">Все наше мороженое изготавливается на собственном производстве, с использованием современного оборудования и проверенных временем технологий.</p>
				<p class="features icon-feature cow">Закупка ингредиентов  производится только у проверенных фермерских хозяйств и компаний, с которыми нас связывает долговременное сотрудничество.</p>
				<p class="features icon-feature leaf">Для приготовления мороженого используются настоящие сливки и молоко высочайшего качества. Все дополнительные ингредиенты и добавки произведены из натурального, экологически чистого сырья.</p>
				<p class="features icon-feature temperature">Доставка нашего мороженого до заказчиков осуществляется в специальном термопаке, который не дает мороженому растаять в пути и позволяет сохранить превосходный вкус.</p>
			</section>
			<div class="blog-subscribe-wrapper">
				<article class="our-blog">
					<h4>Новое в нашем блоге</h4>
					<a class="10-ways" href="blog.html">10 способов сервировки фруктовых щербетов к столу</a>
				</article>
				<div class="subscribe-block">
					<form class="subscribe-form" action="https://echo.htmlacademy.ru" method="post">
						<p>Подпишитесь на нашу сладкую рассылку и будете всегда в курсе всего самого вкусного, что у нас происходит. Обещаем не спамить и не слать всякой ненужной ерунды. Честно =) </p>
						<label for="email-subscribe" class="visually-hidden">Введите сюда электронную почту</label>
						<div class="subscribe-wrapper">
							<input class="placeholder subscribe-placeholder" type="email" id="email-subscribe" placeholder="Электронная почта">
							<button class="button subscribe-block-button" type="submit">Отправить</button>
						</div>
					</form>
				</div>
			</div>
		</main>
		<section class="map">
			<h2 class="visually-hidden">Как нас найти</h2>
			<img src="img/map.png" alt="Адрес магазина:ул. Большая Конюшенная 19/8, Санкт-Петербург" width="1200" height="430">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1998.6037999040354!2d30.322010416394033!3d59.938716271971415!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4696310fca5ba729%3A0xea9c53d4493c879f!2sBolshaya+Konyushennaya+ul.%2C+19%2C+Sankt-Peterburg%2C+Russia%2C+191186!5e0!3m2!1sen!2s!4v1441888483426" width="1200" height="430" allowfullscreen></iframe>
			<section class="contacts">
				<h2 class="visually-hidden">Контакты</h2>
				<p><span>Aдрес главного офиса
              и офлайн-магазина:</span>
					<b>ул. Большая Конюшенная 19/8, Санкт-Петербург</b>
					<span>Для заказов по телефону:</span>
					<a class="telephone-number" href=”tel:8-812-450-25-25″>8 812 450-25-25</a>
					<span>(с 10 до 20 ежедневно)</span>
				</p>
				<a class="button contact-form-button" href="writeme.html">Форма обратной связи</a>
			</section>
		</section>
{footer}