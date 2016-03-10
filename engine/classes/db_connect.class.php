<?php
/*
=====================================
 JCat Radio Engine
-------------------------------------
 http://jcat.tk/
-------------------------------------
 Copyright (c) 2016 Molchanov A.I.
=====================================
 Класс подключения к БД
=====================================
*/
if (! defined ('JRE_KEY')) {
    die ( "Hacking attempt!" );
}
$db = 'mysql:host=' . $db_config['host'] . ';dbname=' . $db_config['database'] . ';charset=' . $config['charset'];
$opt = array(
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false
);
$pdo = new PDO($db, $db_config['user'], $db_config['password'], $opt);
?>