<?
define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

if (is_string($_REQUEST["backurl"]) && mb_strpos($_REQUEST["backurl"], "/") === 0)
{
    LocalRedirect($_REQUEST["backurl"]);
}

$APPLICATION->SetTitle("Вход на сайт");
?><p>
<?$APPLICATION->IncludeComponent(
    "bitrix:system.auth.form",
    "auth_custom",
    Array(
        "FORGOT_PASSWORD_URL" => "",
        "PROFILE_URL" => "",
        "REGISTER_URL" => "",
        "SHOW_ERRORS" => "N"
    )
);?>
    </p>
    <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>