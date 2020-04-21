<?php
/**
 * Created by PhpStorm.
 * Project: tourcompany.loc.
 * File: pagination.php.
 * Date: 25.05.2018
 * Time: 23:53
 */

$pagecount = 2; // Total number of rows
$num = $pagecount / $page_result;

if ($_GET['pageno'] > 1) {
    echo "<a href = 'tour.php?pageno=" . ($_GET['pageno'] - 1) . " ' class='btn btn-secondary' style='margin-right: 10px;'> Предыдущая </a>";
}
//for ($i = 1; $i <= $num; $i++) {
//    echo "<a href = 'tour.php?pageno=" . $i . " > " . $i . "</a > ";
//}

if ($num != 1) {
    echo "<a href = 'tour.php?pageno=" . ($_GET['pageno'] + 1) . " ' class='btn btn-secondary'> Следующая </a > ";
}