<?php
/**
 * Created by PhpStorm.
 * Project: tourcompany.loc.
 * File: addincart.php.
 * Date: 24.04.2018
 * Time: 20:07
 */
require_once('../DB.php');
require_once('../Dbsettings.php');
$msg = '';
$db = new DB($host, $user, $password, $db_name);
$user = $_GET['user'];
$tour = $_GET['tour'];
$db->query("INSERT INTO cart (user_iduser, tour_idtour, status) VALUES ('{$user}','{$tour}', 'active') ");

header('location: tour.php?msg=Тур добавлен в корзину!');
