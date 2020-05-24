<li class="user-navigation-item login-hover">
	<a class="login-link" href="#">Вход</a>
	<section class="modal-login">
		<h2 class="visually-hidden">Личный кабинет</h2>
		<div class="modal-login-wrapper">
			<form class="login-form modal" action="server/login.php" method="post">
				<label class="visually-hidden" for="user-email">Электронная почта</label>
				<input class="user-email placeholder" type="email" name="email" placeholder="Электронная почта" id="user-email">
				<label class="visually-hidden" for="user-password">Пароль</label>
				<input class="user-password placeholder" type="password" name="password" placeholder="Пароль" id="user-password">
				<div class="help-wrapper">
					<button class="button modal-login-button" type="submit">Войти</button>
					<div class="help-me">
						<a class="restore" href="#">Забыли пароль?</a>
						<a class="registration-user" href="#">Новая регистрация</a>
					</div>
				</div>
			</form>
		</div>
	</section>
</li>