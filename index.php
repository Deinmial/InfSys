<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("База данных");

    global $DB;

$results = $DB->Query("SHOW TABLES");
?>
    <div class="button-column">
        <?while($row = $results->Fetch()){
        foreach ($row as $key => $value){?>
            <button onclick="window.location.href='/table/?value=<?=$value?>'"><?=$value?></button>
        <?}
        }?>
    </div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>