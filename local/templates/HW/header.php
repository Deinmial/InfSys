<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Bitrix\Main\Localization\Loc;
Loc::loadMessages($_SERVER["DOCUMENT_ROOT"] . "/bitrix/templates/" . SITE_TEMPLATE_ID . "/header.php");
?>
<!DOCTYPE html>
<html xml:lang="<?php echo LANGUAGE_ID ?>" lang="<?php echo LANGUAGE_ID ?>">
<head>
    <title><?php $APPLICATION->ShowTitle() ?></title>
<?php
use Bitrix\Main\Page\Asset;
//
//Asset::getInstance()
//    ->addString('<link rel="stylesheet" href="https://fonts.bunny.net/css?family=lato:400,700,900|quicksand:400,500,600,700"/>');
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/assets/css/styles.css');
//Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/assets/js/main.js?v=5.6');
?>
    <?php $APPLICATION->ShowHead(); ?>
</head>
<body <?php $APPLICATION->ShowProperty('BODY_CLASS') ?>>
<div id="panel"><?php $APPLICATION->ShowPanel(); ?></div>
<header>
<? if ($APPLICATION->GetCurPage() != '/') { ?>
    <button class="header__button" onclick="window.location.href='/'">Вернуться на главную</button>
<? }
if ($APPLICATION->GetCurPage() != '/') { ?>
    <button class="header__button__change" onclick="window.location.href='/'">Создать запись</button>
<? } ?>
</header>
<?php
if (!$USER->IsAuthorized() && ($_SERVER['REQUEST_URI'] != '/login/index.php')) {
    LocalRedirect('/login/index.php');
}
?>
<h1><?$APPLICATION->ShowTitle('h1');?></h1>
