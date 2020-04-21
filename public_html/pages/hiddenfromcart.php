<?php
/**
 * Created by PhpStorm.
 * Project: tourcompany.loc.
 * File: hiddenfromcart.php.
 * Date: 25.04.2018
 * Time: 1:35
 */
require_once('../DB.php');
require_once('../Dbsettings.php');
$msg = '';
$db = new DB($host, $user, $password, $db_name);
$cart = $_GET['cart'];

$db->query("UPDATE cart SET status='hidden' WHERE idcart='{$cart}' ");

header('location: cart.php?msg=Запись удалена из корзины!');
