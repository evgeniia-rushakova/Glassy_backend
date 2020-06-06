<div style="margin: 10px;border: 1px dashed white;border-radius: 10px; max-width: 80%; padding: 10px;" >
	<p>Пользователь: <b>{id}</b></p>
	<p>E-mail:<b>{e-mail}</b></p>
    <div>
		<b>Заказы пользователя:</b>
		<div>
			{orders}
		</div>
	</div>
    <form action="../server/delete_user.php?id={id}" method="post">
        <button class="button button-chocolate">Удалить пользователя</button>
    </form>

</div>