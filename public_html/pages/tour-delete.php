<?php
/**
 * Created by PhpStorm.
 * Project: tourcompany.loc.
 * File: tour-edit.php.
 * Date: 19.05.2018
 * Time: 8:03
 */
session_start() ?>
<?php $title = "Обновление инфомрации о туре" ?>
<?php
require_once('../forms/TourForm.php');
require_once('../DB.php');
require_once('../Password.php');
require_once('../Session.php');
require_once('../Dbsettings.php');
$msg = '';
$db = new DB($host, $user, $password, $db_name);
$form = new TourForm($_POST);
$idtour = $_GET['idtour'];
if ($_POST) {
    try {
        $idtour = $_POST['idtour'];
        $db->query("DELETE FROM tour WHERE idtour='{$idtour}' LIMIT 1");
        header('location: tour-edit-remove.php?msg=Запись успешно удалена!');
    } catch (Exception $e) {
        header('location: tour-edit-remove.php?msg=Запись удалить нельзя. Есть связанные данные!');
    };
}
?>
<?php include 'header.php' ?>
    <hr>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <h5 class="text-center border border-top-0 border-left-0" style="line-height: 40px;">Меню</h5>
            </div>
            <div class="col-sm-9">
                <h5 class="text-center border border-top-0 border-right-0"
                    style="line-height: 40px;"><?php echo $title ?></h5>
                <h6 class="text-center" style="padding-top: 15px; color: red;">Вы уверены, что хотите удалить эту
                    запись?</h6>
            </div>
        </div>
        <div class="row">
            <?php include_once('../navigation.php'); ?>
            <div class="col-sm-9" style="padding-bottom: 100px; ">
                <div class="text-justify border border-bottom-0 border-right-0"
                     style="line-height: 40px; padding-left: 10px; padding-right: 10px;">
                    <b style="color: red;"><?= $msg; ?></b>
                    <?php
                    $tour = $db->query("SELECT * FROM tour, category WHERE idtour='{$idtour}' AND tour.category_idcategory = category.idcategory");
                    foreach ($tour as $touritem) {
                        ?>
                        <form method="post">
                            <div class="form-group">
                                <label for="name">Название тура</label>
                                <input type="hidden" value="<?php echo $touritem["idtour"]; ?>" name="idtour">
                                <input type="text" class="form-control" id="name" placeholder="Добавьте название тура"
                                       name="name" disabled
                                       value="<?= $touritem["name"] ?>">
                            </div>
                            <div class="form-group">
                                <label for="descriptiontour">Описание тура</label>

                                <textarea class="form-control" id="descriptiontour" disabled
                                          name="descriptiontour"><?= $touritem["descriptiontour"] ?>
                        </textarea>
                            </div>
                            <div class="form-group">
                                <label for="cost">Категория</label>
                                <input type="text" class="form-control" id="category"
                                       disabled
                                       name="category" value="<?= $touritem["namecategory"] ?>">
                            </div>
                            <div class="form-group">
                                <label for="cost">Стоимость</label>
                                <input type="text" class="form-control" id="cost" disabled
                                       name="cost" value="<?= $touritem["cost"] ?>">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-info">Удалить</button>
                                <a href="tour-edit-remove.php" class="btn btn-info">Отмена</a>
                            </div>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
<?php include 'footer.php' ?>