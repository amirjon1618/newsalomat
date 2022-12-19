<html>
<style>
	label {
		font-size: 18px;

	}

	i {
		font-size: 16px;
	}
</style>
<label>
	Ваш заказ ждет васмн.
</label>
<br />
Ячейка: {box_alias_id}<br />
Пароль: {box_password}
<br />
<i>Или используйте Barcode для открытия ячейки</i>
<br />
<br />
<img src="{base_url}barcode.php?codetype=Code39&size=150&text={box_alias_id}{box_password}&sizefactor=3" style="width: 100%" />

</html>