<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("База данных");
global $DB;
$connection = Bitrix\Main\Application::getConnection();

session_start();

if (isset($_GET['row'])) {
    $_SESSION['selected_row'] = $_GET['row'];  // Экранирование
}?>
    <form action="update.php" method="post">
<?
$selected_row = $_SESSION['selected_row'];
$results = $connection->query("SELECT * FROM $selected_row");
if ($results) {
    while ($row = $results->Fetch()) {
        foreach ($row as $key => $value){
            if($key == 'ID') {
                continue;
            }?>
            <label><?=$key?></label>
            <input value="<?=$value?>">
            <br>
            <br>
<?
        }
    }
}
?>
        <input type="submit" value="Обновить">
    </form>

<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>