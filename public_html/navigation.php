<div class="col-sm-3">
    <div class="list-group">
        <a href="/pages/category.php" class="list-group-item list-group-item-action">Категории туров</a>
        <a href="/pages/tour.php" class="list-group-item list-group-item-action">Список туров</a>
        <?php
        if (!empty(Session::get('email'))) {
            echo "<a href=\"/pages/cart.php\" class=\"list-group-item list-group-item-action\">Корзина пользователя</a>
        <a href=\"/pages/order.php\" class=\"list-group-item list-group-item-action\">Заказы пользователя</a>";
        }
        ?>

    </div>
</div>