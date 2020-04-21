<?php
/**
 * Created by PhpStorm.
 * Project: tourcompany.loc.
 * File: tour-edit.php.
 * Date: 19.05.2018
 * Time: 8:03
 */
session_start() ?>
<?php $title = "Обновление информации о туре" ?>
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
    if ($form->validate()) {
        $name = $db->escape($form->getName());
        $descriptiontour = $db->escape($form->getDescription());
        $category = $db->escape($form->getCategory());
        $cost = $db->escape($form->getCost());
        $numberofplaces = $db->escape($form->getNumberPlaces());
        $tourdate = $db->escape($form->getTourDate());

        $email = $_SESSION['email'];
        $res = $db->query("SELECT role_idrole FROM `user` WHERE email = '{$email}'");
        $a = $res[0]['role_idrole'];
        if ($a == 1 || $a == 2) {
            $db->query("UPDATE tour SET `name` = '{$name}', numberofplaces = '{$numberofplaces}', descriptiontour ='{$descriptiontour}', category_idcategory = 
'{$category}', cost = '{$cost}', tourdate = '{$tourdate}' WHERE idtour = {$idtour} LIMIT 1");
            header('location: tour-edit-remove.php?msg=Тур успешно обновлен!');
        } else {
            $msg = 'У Вас нет прав на редактирование!';
        }
    } else {
        $msg = 'Пожалуйста, заполните все поля';
    }
}
?>
<?php include 'header.php' ?>
    <hr>
    <h5 align="center">Страница обновления тура</h5>

    <hr>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <h5 class="text-center border border-top-0 border-left-0" style="line-height: 40px;">Меню</h5>
            </div>
            <div class="col-sm-9">
                <h5 class="text-center border border-top-0 border-right-0"
                    style="line-height: 40px;"><?php echo $title ?></h5>
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
                                <input type="text" class="form-control" id="name" placeholder="Добавьте название тура"
                                       name="name"
                                       value="<?= $touritem["name"] ?>">
                            </div>

                            <div class="form-group">
                                <label for="tourdate">Дата выезда</label>
                                <input type="date" class="form-control" id="tourdate"
                                       name="tourdate"
                                       value="<?= $touritem["tourdate"] ?>">
                            </div>

                            <div class="form-group">
                                <label for="name">Количество</label>
                                <input type="text" class="form-control" id="numberofplaces"
                                       placeholder="Укажите количество"
                                       name="numberofplaces"
                                       value="<?= $touritem["numberofplaces"] ?>">
                            </div>

                            <div class="form-group">
                                <label for="descriptiontour">Описание тура</label>
                                <textarea class="form-control" id="descriptiontour"
                                          name="descriptiontour"><?= $touritem["descriptiontour"] ?>
                        </textarea>
                            </div>

                            <div class="form-group">
                                <label for="cost">Текущая категория</label>
                                <input type="text" class="form-control" id="category"
                                       disabled
                                       name="category" value="<?= $touritem["namecategory"] ?>">
                            </div>

                            <div class="form-group">
                                <label for="category">Категория</label>
                                <select class="form-control" name="category" id="category">
                                    <?php
                                    $category = $db->query("SELECT * FROM category");
                                    foreach ($category as $categoryitem) {
                                        ?>
                                        <option value="<?php echo $categoryitem['idcategory'] ?>"><?php echo $categoryitem['namecategory'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="cost">Стоимость</label>
                                <input type="text" class="form-control" id="cost"
                                       name="cost" value="<?= $touritem["cost"] ?>">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-info">Сохранить</button>

                                <a href="tour.php" class="btn btn-info">Отмена</a>
                            </div>
                        </form>

                    <?php } ?>

                </div>
            </div>
        </div>

    </div>

<?php include 'footer.php' ?>