<?php
/*
=======================================
 JCat Radio CMS
---------------------------------------
 https://radio-cms.ru/
---------------------------------------
 Copyright (c) 2016-2021 Molchanov A.I.
=======================================
 Главный обработчик движка
=======================================
*/
require_once ENGINE_DIR . '/classes/config_loader.php';
session_start();
ob_start();

$config = ConfigLoader::load('config');
$db_config = ConfigLoader::load('db_config');
$template = ROOT_DIR . '/template/' . $config->tpl_dir;
require_once ENGINE_DIR . '/classes/user.php';
require_once ENGINE_DIR . '/classes/stats.php';

$do = isset($_GET['do']) ? $_GET['do'] : null;
switch ($do) {
    default:
        include ENGINE_DIR . '/frontend/index.php';
        break;

    case 'news':
    case 'programs':
    case 'schedule':
    case 'static':
    case 'user':
    case 'auth':
    case 'reg':
        include ENGINE_DIR . "/frontend/$do.php";
        break;

    case 'logout':
        session_destroy();
        header("Location://{$_SERVER['HTTP_HOST']}");
        break;
}
$content = ob_get_clean();

$head = empty($seo_title) ? "<title>$config->title</title>" : "<title>$seo_title</title>";
$head .= empty($seo_description) ? '<meta name="description" content="' . $config->description . '">' : '<meta name="description" content="' . $seo_description . '">';
$head .= empty($seo_keywords) ? '<meta name="keywords" content="' . $config->keywords . '">' : '<meta name="keywords" content="' . $seo_keywords . '">';

if (!isset($_SERVER['HTTP_X_PJAX'])) {
    require_once $template . '/main.php';
} else {
    echo $head, $content;
}
