<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("База данных");
global $DB;
$connection = Bitrix\Main\Application::getConnection();

session_start();

if (isset($_GET['value'])) {
    $_SESSION['selected_value'] = $_GET['value'];  // Экранирование
}
$selected_value = $_SESSION['selected_value'];
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $res = $connection->query("DELETE FROM `$selected_value` WHERE `ID`=$id");
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
                <a href="/change/?row=<?=$selected_value?>">Изменить</a> | <a href="#" onclick="confirmDelete(<?=$row['ID']?>)">Удалить</a>
            </td>
             </tr>
            </tbody>
       <? }
    }?>
    </table>
    <div id="sticky-button-container">
        <button id="sticky-button" onclick="window.location.href='/create/?table=<?=$selected_value?>'">Создать запись</button>
    </div>
    <script>
        function confirmDelete(id) {
            if (confirm('Вы уверены, что хотите удалить эту запись?')) {
                window.location.href = '?action=delete&id=' + id;
            }
        }
    </script>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>