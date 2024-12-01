<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("База данных");
global $DB;
$connection = Bitrix\Main\Application::getConnection();

session_start();

if (isset($_GET['table'])) {
    $_SESSION['selected_table'] = $_GET['table'];  // Экранирование
}
$selected_table = $_SESSION['selected_table'];

// Обработка формы, если она отправлена
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fields = [];
    $values = [];

    // Собираем данные из формы
    foreach ($_POST as $key => $value) {
        $fields[] = $key;
        $values[] = "'" . $connection->getSqlHelper()->forSql($value) . "'";
    }

    // Формируем SQL-запрос
    $sql = "INSERT INTO $selected_table (" . implode(', ', $fields) . ") VALUES (" . implode(', ', $values) . ")";

    // Выполняем запрос
    $connection->queryExecute($sql);

    LocalRedirect('/table/?value='.$selected_table);
}
?>

    <!-- Форма для добавления данных -->
    <form method="POST" onsubmit="return confirm('Вы уверены, что хотите добавить данные?');">
        <?
        // Вывод данных из таблицы
        $results = $connection->query("SELECT * FROM $selected_table LIMIT 1");
        if ($results) {
            while ($row = $results->Fetch()) {
                foreach ($row as $key => $value) {
                    if($key == 'ID') {
                        continue;
                    }?>
                    <label for="<?=$key?>"><?=$key?>:</label>
                    <input type="text" name="<?=$key?>" id="<?=$key?>"><br><br>
                <?}
            }
        }

        ?>

        <button type="submit">Добавить данные</button>
    </form>

<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>