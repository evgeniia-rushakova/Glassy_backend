<div style="margin-top:50px;">
    <h3 class="page-title" style="margin-bottom: 30px;">{name}</h3>
    <div class="info-wrapper" style="display: flex;justify-content: space-between;">

        <img src="{img}" alt="{name}" style="border-radius: 50%;">
        <div style="display: flex;flex-direction: column;justify-content: space-between;">
            <p class="contacts-information" style="font-size: 25px;margin-bottom: 15px;margin-top: 110px;">Жирность: {fat} %</p>
            <p class="contacts-information" style="font-size: 25px;margin-bottom: 15px;">Цена за килограмм: {price} &#8381;/кг</p>
            <p class="contacts-information" style="font-size: 20px;
            line-height: 23px;
    padding-left: 80px;
    font-weight: normal;
text-align: right">
                <b style="margin-top: 15px; font-size: 23px;">Состав:</b> <br> молоко цельное, молоко цельное сгущенное с сахаром (молоко цельное, молоко обезжиренное, сахар), масло сладко-сливочное,
                сливки из коровьего молока, сахар, вода, сыворотка молочная сухая, натуральный стабилизатор (молочный белок, камедь рожкового дерева),
                ароматизатор «ликер», шоколадный топинг (сахар, масло растительное, рафинированное, дезодорированное; какао-порошок, эмульгатор – соевый лецитин,
                ароматизатор натуральный – ванилин). <br>
                <b style="margin-bottom: 15px;margin-top: 15px; font-size: 23px;">Пищевая ценность в 100г продукта:</b> белка 3,2 г; жира 18,7 г; углеводов 19,3 г. Энергетическая ценность: 138,5
            </p>
        </div>

    </div>
    <form action="../server/add_to_cart.php?product_id={id}" class="sorting-filters" style="    display: flex;
    max-width: 400px;
    justify-content: space-between;
    align-items: baseline;">
        <label for="quan" class="sorting-name-grade">Сколько вешать?(кг)</label>
        <input type="number" id="quan" name="quan" min="0.5" max="10" value="0.5" step="0.5" style="border: none;
    color: white;
    background-color: rgba(255, 255, 255, .4);
    border-radius: 10px;
    padding: 5px;">
        <button type="submit" class="button button-visual" style="min-width: 120px;
    min-height: 45px;">В корзину</button>
    </form>


</div>
