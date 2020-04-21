<?php
/**
 * Created by PhpStorm.
 * Project: tourcompany.loc.
 * File: addorder.php.
 * Date: 24.04.2018
 * Time: 23:28
 */
require_once('../DB.php');
require_once('../Dbsettings.php');
$msg = '';
$db = new DB($host, $user, $password, $db_name);
$cart = $_GET['cart'];
$db->query("INSERT INTO `order` (cart_idcart) VALUES ('{$cart}') ");

//отправка на эл. ящик сообщения о новом заказе
$emailto = $db->query("SELECT * FROM `order`, cart, `user`, tour WHERE `order`.cart_idcart = '{$cart}' AND `order`.cart_idcart = cart.idcart AND cart.user_iduser=user.iduser AND cart.tour_idtour=tour.idtour");
foreach ($emailto as $emailtoitem) {
    // $emailtoitem['name'];
    $to = "admin@tourcompany.com";
    $subject = "Формлен новый заказ пользователем: " . $emailtoitem['username'] . " " . $emailtoitem['usersecondname'];
    $message = "Детали заказа: " . "Тур:" . $emailtoitem['name'] . "\r\n" . "E-mail пользователя: " . $emailtoitem['email'] . "\r\n" .
        "From: tourcompany@tourcompany.loc \r\n" . "Стоимость: " . $emailtoitem['cost'] . "Дата заказа: " . $emailtoitem['date'];
    $headers = "Content-type: text/html; charset=windows-1251 \r\n";
    $headers .= "From: От кого письмо <taskshedule@taskshedule.loc>\r\n";
    $headers .= "Reply-To: reply-to@tourcompany.com\r\n";

    mail($to, $subject, $message, $headers);
}

header('location: cart.php?msg=Заказ оформлен. В скором времени с Вами свяжется наш менеджер!');