<div style="margin: 10px; padding: 10px;border-radius: 10px;border: 1px dashed white;">
	<p class="button" style="padding: 10px 20px;">Заказ номер: {number}, id: {id}, e-mail: {email}</p>
	<table style="width: 100%;">
		<tbody style="width: 100%;">
		<tr style="text-align: left;">
			<th style="margin-right:10px;">Позиция</th>
			<th style="margin-right:10px;">Количество</th>
			<th style="margin-right:10px;">Цена за килограмм</th>
			<th style="margin-right:10px;">Итого</th>
		</tr>
		{rows}
		<tr style="text-align: left;">
			<td colspan="5" style="margin-right:10px; text-align: end;"><b style="color: #d84732; ">{total} руб.</b></td>
		</tr>
		<tr style="text-align: left; display: block;">
			<td>Акции: {offer}</td>
		</tr>
		<tr style="text-align: left; ">
			<td>Статус: <b style="color: #d84732; ">{status}</b></td>
		</tr>

		</tbody>
	</table>
	<form  class="sorting-filters" action="../server/archive.php?act=change_status" method="post" style="justify-content:start;align-items: baseline;">
		<label for="staus" class="sorting-name-grade" style="margin: 0 20px">
			Изменить статус:
		</label>
		<select class="sorting-select" name="status" id="staus"  style="margin-right: 20px">
			<option value="Принят в обработку">Принят в обработку</option>
			<option value="Выполнен">Выполнен</option>
			<option value="Отменен">Отменен</option>
		</select>
		<input type="hidden" value="{id}" name="id">
		<button type="submit" class="button" style="padding: 5px 10px;">Изменить статус</button>
	</form>
</div>