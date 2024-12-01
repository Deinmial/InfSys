<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("База данных");
global $DB;
$connection = Bitrix\Main\Application::getConnection();

session_start();

if (isset($_GET['table'])) {
    $_SESSION['selected_table'] = $_GET['table'];  // Экранирование
}?>
    <form method="post">
        <?
if (isset($_POST['submit_button'])) {
    $selected_table = $_SESSION['selected_table'];
    $fields = [];
    $values = [];
    foreach ($_POST as $key => $value) {
        if (!empty($value) && $key != 'submit_button') { // Проверка, что поле не равно 'submit_button'
            $fields[] = $key;
            $values[] = $value;
        }
    }

    $selected_table = htmlspecialchars($selected_table);

    //LocalRedirect('/table/?value='.$selected_table);
    if (!empty($fields) && !empty($values)) {
        $connection->query("INSERT INTO $selected_table (" . join(', ', $fields) . ") VALUES (" . join(', ', $values) . ")");
    }
}
?>
<?
$selected_table = $_SESSION['selected_table'];
$results = $connection->query("SELECT * FROM $selected_table");
if ($results) {
    while ($row = $results->Fetch()) {
        foreach ($row as $key => $value){
            if($key == 'ID') {
                continue;
            }?>
            <label><?=$key?></label>
            <input name="<?=$key?>">
            <br>
            <br>
            <?
        }
    }
}
?>
    <input type="submit" name="submit_button" value="Добавить">
    </form>

<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>