<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("База данных");
global $DB;
$connection = Bitrix\Main\Application::getConnection();

session_start();

if (isset($_GET['value'])) {
    $_SESSION['selected_value'] = $_GET['value'];  // Экранирование
    $selected_value = $_SESSION['selected_value'];
}?>
    <table>
            <thead>
            <tr>

    <?$results = $connection->query("SELECT * FROM $selected_value");
    if ($results) {
        while ($row = $results->Fetch()) {
            foreach ($row as $key => $value) {?>
                <th><?=$key?></th>
          <?  }?>
        </tr>
            </thead>
        <tbody>
        <tr>
            <?foreach ($row as $key => $value) {?>
                <td><?=$value?></td>
            <?  }?>
            <td>
                <a href="#">Изменить</a> | <a href="#">Удалить</a>  <!-- Добавили ссылки на изменение и удаление -->
            </td>
             </tr>
            </tbody>
       <? }
    }?>

    </table>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>