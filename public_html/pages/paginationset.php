<?php
/**
 * Created by PhpStorm.
 * Project: tourcompany.loc.
 * File: paginationset.php.
 * Date: 25.05.2018
 * Time: 23:51
 */
$offset = 0;
$page_result = 5;

if ($_GET['pageno']) {
    $page_value = $_GET['pageno'];
    if ($page_value > 1) {
        $offset = ($page_value - 1) * $page_result;
    }
}