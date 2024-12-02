<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("База данных");
global $DB;
$connection = Bitrix\Main\Application::getConnection();

session_start();

if (isset($_GET['table'])) {
    $_SESSION['selected_table'] = $_GET['table'];  // Экранирование
}
if (isset($_GET['row'])) {
    $_SESSION['selected_row'] = $_GET['row'];  // Экранирование
}

$selected_table = $_SESSION['selected_table'];
$selected_row = $_SESSION['selected_row'];

// Обработка формы, если она отправлена
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $updates = [];

    // Собираем данные из формы
    foreach ($_POST as $key => $value) {
        $updates[] = "$key = '" . $connection->getSqlHelper()->forSql($value) . "'";
    }

    // Формируем SQL-запрос
    $sql = "UPDATE $selected_table SET " . implode(', ', $updates) . " WHERE ID = $selected_row";

    // Выполняем запрос
    $connection->queryExecute($sql);

    LocalRedirect('/table/?value='.$selected_table);
}
?>

    <!-- Форма для редактирования данных -->
    <form method="post" onsubmit="return confirm('Вы уверены, что хотите изменить данные?');">
        <?
        $results = $connection->query("SELECT * FROM $selected_table WHERE ID=$selected_row");
        if ($results) {
            while ($row = $results->Fetch()) {
                foreach ($row as $key => $value){
                    if($key == 'ID') {
                        continue;
                    }?>
                    <label for="<?=$key?>"><?=$key?>:</label>
                    <input type="text" name="<?=$key?>" id="<?=$key?>" value="<?=$value?>"><br><br>
                    <?
                }
            }
        }
        ?>
        <button type="submit">Изменить данные</button>
    </form>

<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>