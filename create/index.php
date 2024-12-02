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
        $results = $connection->query("SHOW COLUMNS FROM $selected_table");
        if ($results) {
            while ($row = $results->Fetch()) {
                foreach ($row as $key => $value) {

                    /**
                     * Реализация проверки на пустоту полей
                     */
//                    if ($key == 'Null'){
//                        $req = $value;
//                        if ($req == 'YES'){
//                            $span = '<span style="color: red">*</span>';
//                        } else {
//                            $span = '';
//                        }
//                    }

                    if($key == 'Field'){
                        if($value == 'ID') {
                            continue;
                        }?>
                    <label for="<?=$value?>"><?=$value?>:</label>
                    <input type="text" name="<?=$value?>" id="<?=$value?>" <?// echo $req == 'YES' ? 'REQUIRED':''?>>
                        <?// echo $span?>
                        <br><br>
                <?
                    }
                }
            }
        }

        ?>

        <button type="submit">Добавить данные</button>
    </form>

<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>