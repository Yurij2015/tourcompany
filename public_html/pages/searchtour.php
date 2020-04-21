<?php
/**
 * Created by PhpStorm.
 * Project: tourcompany.loc.
 * File: searchtour.php.
 * Date: 25.05.2018
 * Time: 21:15
 */
session_start();
require_once '../Session.php';
?>
<?php $title = "Перечень туров компании BestTour" ?>
<?php
require_once('../Dbsettings.php');
include_once('../DB.php');
require_once('../forms/UserForm.php');

$db = new DB($host, $user, $password, $db_name);
?>
<?php include 'header.php' ?>
<?= isset($_GET['msg']) ? $_GET['msg'] : ''; ?>

<?php
if (!empty($_POST['findtour'])) {
    $findtour = trim(htmlspecialchars($_POST['findtour']));
}
?>

<h5 align="center" style="margin-top: 15px;">Найденные туры по запросу "<?= $findtour ?>"</h5>
<hr>
<div class="container">

    <div class="row">
        <div class="col-sm" style="padding-bottom: 100px;">
            <div
                    style="line-height: 40px; padding-left: 10px; padding-right: 10px;">
                <div style="margin: 4px 0 7px 0;">
                    <?php
                    //определение юзера
                    require_once "selectuser.php";
                    ?>

                </div>

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center">Название тура</th>
                        <!--                            <th scope="col" class="text-center">Описание</th>-->
                        <th scope="col" class="text-center">Категория</th>
                        <th scope="col" class="text-center">Дата</th>
                        <th scope="col" class="text-center">Стоимость</th>
                        <th scope="col" class="text-center">Осталось мест</th>
                        <?php if (!empty($email)) echo '<th scope="col" class="text-center">Указать количество</th>' ?>


                        <?php if (!empty($email)) echo '<th scope="col" class="text-center">Корзина</th>'; ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    try {
                    $tour = $db->query("SELECT * FROM tour, category WHERE tour.category_idcategory = category.idcategory AND `name` LIKE '%$findtour%' ");
                    foreach ($tour

                    as $touritem) {
                    ?>
                    <tr>
                        <td>
                            <a href="abouttour.php?idtour=<?= $touritem["idtour"] ?>"><?php echo $touritem["name"]; ?></a>
                        </td>
                        <!--                            <td>-->
                        <?php //echo $touritem["descriptiontour"]; ?><!--</td>-->
                        <td><?php echo $touritem["namecategory"]; ?></td>
                        <td><?php echo $touritem["tourdate"]; ?></td>
                        <td><?php echo $touritem["cost"]; ?></td>
                        <td><?php echo $touritem["numberofplaces"]; ?></td>
                        <?php if (!empty($email)) echo "<td>"; ?>
                        <?php if (!empty($email)) echo ' <form action="addincart.php"> 
                                <input name="count" type="text" id="count"> ' ?>
                        <input name="tour" type="text" id="tour" value="<?= $touritem["idtour"]; ?>" hidden>
                        <input name="user" type="text" id="id" value="<?= $id; ?>" hidden>
                        <?php if (!empty($email)) echo "</td>"; ?>
                        <?php if (!empty($email)) echo "<td>"; ?>
                        <?php if (!empty($email)) echo '<input type="submit" value="Добавить в корзину">' ?>
                        </form>
                        <?php if (!empty($email)) echo "</td>"; ?>
                        <?php }
                        ?>
                    </tr>
                    </tbody>
                </table>
                <?php
                } catch
                (Exception $e) {
                    echo $e->getMessage() . ':(';
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php' ?>
<script>
    function asd() {
        var value = document.getElementById('count');
        var tour = document.getElementById('tour');
        var id = document.getElementById('id');
        alert(value);
        alert(tour);
        alert(id);
    }
</script>