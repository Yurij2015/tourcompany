<?php
/**
 * Created by PhpStorm.
 * Project: tourcompany.loc.
 * File: tour.php.
 * Date: 24.04.2018
 * Time: 16:43
 */
session_start();
require_once '../Session.php';
?>
<?php $title = "Информация о туре" ?>
<?php
require_once('../Dbsettings.php');
include_once('../DB.php');
require_once('../forms/UserForm.php');

$db = new DB($host, $user, $password, $db_name);
?>
<?php include 'header.php' ?>
<?= isset($_GET['msg']) ? $_GET['msg'] : ''; ?>
    <hr>
    <h5 align="center">Подробная информация о путешествии</h5>
    <hr>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <h5 class="text-center border border-top-0 border-left-0" style="line-height: 40px;">Меню</h5>
            </div>
            <div class="col-sm">
                <h5 class="text-center border border-top-0 border-right-0"
                    style="line-height: 40px;"><?php echo $title ?></h5>
            </div>
        </div>
        <div class="row">
            <?php include_once('../navigation.php'); ?>
            <div class="col-sm" style="padding-bottom: 100px;">
                <div class="text-justify border border-bottom-0 border-right-0"
                     style="line-height: 40px; padding-left: 10px; padding-right: 10px;">

                    <?php
                    require_once "selectuser.php";


                    $idtour = $_GET['idtour'];
                    //echo $idtour;

                    try {
                        $tour = $db->query("SELECT * FROM tour, category WHERE idtour='{$idtour}' AND tour.category_idcategory = category.idcategory");
                        foreach ($tour

                                 as $touritem) {
                            ?>
                            <?php echo '<h3>' . 'Название тура: ' . $touritem["name"] . '</h3>'; ?>
                            <?php echo '<div id="description">' . $touritem["descriptiontour"] . '</div>'; ?>
                            <?php echo '<p>' . 'Категория: ' . $touritem["namecategory"] . '</p>'; ?>
                            <?php echo '<p>' . 'Стоимость: ' . $touritem["cost"] . '</p>'; ?>
                            <?php echo '<p>' . 'Осталось мест: ' . $touritem["numberofplaces"] . '</p>'; ?>

                        <?php }
                        ?>
                        <?php
                    } catch
                    (Exception $e) {
                        echo $e->getMessage() . ':(';
                    }
                    ?>

                    <div style="margin: 4px 0 7px 0;">

                        <a href="addincart.php?idtour=<?= $touritem["idtour"]
                        ?>&user=<?= $id; ?>"

                        <?php if (!empty($email)) {
                            echo 'class="btn btn-info">Добавить в
                            корзину</a>';
                        }

                        ?>


                    </div>

                </div>
            </div>
        </div>
    </div>
<?php include 'footer.php' ?>