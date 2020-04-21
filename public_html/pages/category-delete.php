<?php
/**
 * Created by PhpStorm.
 * Project: tourcompany.loc.
 * File: category-delete.php.
 * Date: 26.05.2018
 * Time: 1:38
 */
session_start() ?>
<?php $title = "Удаление категории" ?>
<?php
require_once('../forms/CategoryForm.php');
require_once('../DB.php');
require_once('../Password.php');
require_once('../Session.php');
require_once('../Dbsettings.php');
$msg = '';
$idcategory = $_GET['idcategory'];
$db = new DB($host, $user, $password, $db_name);
$form = new CategoryForm($_POST);
if ($_POST) {
    try {
        $idtour = $_POST['idcategory'];
        $db->query("DELETE FROM category WHERE idcategory='{$idcategory}' LIMIT 1");
        header('location: category-edit-remove.php?msg=Запись успешно удалена!');
    } catch (Exception $e) {
        header('location: category-edit-remove.php?msg=Запись удалить нельзя. Есть связанные данные!');
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
            <div class="col-sm">
                <h5 class="text-center border border-top-0 border-right-0"
                    style="line-height: 40px;"><?php echo $title ?></h5>
                <h6 class="text-center" style="padding-top: 15px; color: red;">Вы уверены, что хотите удалить эту
                    категорию?</h6>
            </div>
        </div>
        <div class="row">
            <?php include_once('../navigation.php'); ?>
            <div class="col-sm" style="padding-bottom: 100px; >
            <div class=" text-justify border border-bottom-0 border-right-0
                 style="line-height: 40px; padding-left: 10px; padding-right: 10px;">

                <b style="color: red;"><?= $msg; ?></b>
                <?php
                $category = $db->query("SELECT * FROM category WHERE idcategory={$idcategory} LIMIT 1");
                foreach ($category as $categoryitem) {
                    ?>

                    <form method="post">
                        <div class="form-group">
                            <label for="name">Название категории</label>
                            <input type="text" class="form-control" id="name" placeholder="Добавьте название категории"
                                   name="namecategory"
                                   value="<?= $categoryitem['namecategory']; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="secondname">Описание категории</label>
                            <textarea class="form-control" id="description"
                                      name="description"><?= $categoryitem['description']; ?>
                        </textarea>

                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-info">Удалить</button>
                            <a href="category.php" class="btn btn-info">Отмена</a>
                        </div>
                    </form>
                <?php } ?>

            </div>
        </div>
    </div>

    </div>


<?php include 'footer.php' ?>