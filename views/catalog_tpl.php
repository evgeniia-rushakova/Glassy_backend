{header}
	<main>
		<section class="filters">
			<h1 class="page-title">Каталог</h1>
			<form class="sorting-filters" action="https://echo.htmlacademy.ru" method="post">
				<p class="filter-item-select">
					<label  for="sortfor"><b class="sorting-name-grade">Сортировка:</b></label>
					<select class="sorting-select" name="sorting" id="sortfor">
						<option value="popularity">по популярности</option>
						<option value="pricelow">сначала недорогие</option>
						<option value="pricehight">сначала дорогие</option>
						<option value="fat">по жирности</option>
					</select>
				</p>
				<div class="filter-item-price range-slider">
					<label class="topping-check-range" for="pricerange" tabindex="0">Цена до:<span>100 руб/кг.</span> - <span>500 руб/кг.</span></label>
					<input type="range" min="100" max="500" class="pricerange" id="pricerange" value="130"  step ="any" name="price">
				</div>
				<div class="filter-item-fat">
					<b class="filter-fat-label">Жирность:</b>
					<div class="sort-fat-item-wrapper">
						<p class="sort-fat-item">
							<input type="radio" name="fat" value="0" id="topping0">
							<label for="topping0" tabindex="0">0%</label>
						</p>
						<p class="sort-fat-item">
							<input type="radio" name="fat" value="20" id="topping10">
							<label for="topping10" tabindex="0">до 20%</label>
						</p>
						<p class="sort-fat-item">
							<input type="radio" name="fat" value="40" id="topping30">
							<label for="topping30" tabindex="0">до 40%</label>
						</p>
						<p class="sort-fat-item">
							<input type="radio" name="fat" value="41" id="topping31">
							<label for="topping31" tabindex="0">выше 40%</label>
						</p>
					</div>
				</div>
				<div class="toppings filter-item">
					<b class="sorting-name-toppings">Тип:</b>
					<div class="topping-wrapper">
						<input class="topping-choise" type="checkbox" name="topping" value="chocolate" id="chocolate" checked>
						<label for="chocolate" class="topping-check" tabindex="0">шоколадные</label>
						<input class="topping-choise" type="checkbox" name="topping" value="cream" id="cream" checked>
						<label for="cream" class="topping-check" tabindex="0">сливочные</label>
						<input class="topping-choise" type="checkbox" name="topping" value="fruits" id="fruits">
						<label for="fruits" class="topping-check" tabindex="0">фрукты</label>
						<input class="topping-choise" type="checkbox" name="topping" value="mint" id="mint">
						<label for="mint" class="topping-check" tabindex="0">мятные</label>
					</div>
				</div>
				<button class="submit-result" type="submit">Применить</button>
				<button class="submit-result" style="margin-left: 10px;">Сбросить фильтры</button>
			</form>
		</section>
		<section class="filtered-results">
			<h2 class="visually-hidden">Товары,отсортированные по вашим параметрам</h2>
			<ul class="catalog-list catalog-list-inner">
				{products}
			</ul>
		</section>
	</main>
{footer}
