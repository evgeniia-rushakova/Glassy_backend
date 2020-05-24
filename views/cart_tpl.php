
{header}

<div class="cart">
	<h2 class="cart-titleh2">Ваши заказы:</h2>
	<div>
		{orders}
	</div>
	<h2 class="cart-titleh2">Ваша корзина:</h2>
	<div class="cart-archive">
        {cart-archive}
	</div>
	<h3 class="cart-titleh3">Текущий заказ</h3>
	{cart-inner}
	<div class="buttons">
		<a href="../server/archive.php?act=archive" class="button button-chocolate">Архивировать заказ</a>
		<a href="../server/delete_from_cart.php?act=delete" class="button button-chocolate">Очистить корзину</a>
		<a href="../server/delete_from_cart.php?act=buy" class="button button-chocolate">Оплатить и заказать</a>
	</div>

</div>
{footer}
