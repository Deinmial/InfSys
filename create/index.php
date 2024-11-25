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
$results = $connection->query("SELECT * FROM $selected_table");
if ($results) {
    while ($row = $results->Fetch()) {
        echo '<pre>';
        print_r($row);
        echo '</pre>';
    }
}

?>

<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>