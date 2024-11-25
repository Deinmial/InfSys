<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("База данных");
global $DB;
$connection = Bitrix\Main\Application::getConnection();

session_start();

if (isset($_GET['row'])) {
    $_SESSION['selected_row'] = $_GET['row'];  // Экранирование
}
$selected_row = $_SESSION['selected_row'];
$results = $connection->query("SELECT * FROM $selected_row");
if ($results) {
    while ($row = $results->Fetch()) {
        echo '<pre>';
        print_r($row);
        echo '</pre>';
    }
}

?>

<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>