<?php
/*
=======================================
 JCat Radio CMS
---------------------------------------
 https://radio-cms.ru/
---------------------------------------
 Copyright (c) 2016-2021 Molchanov A.I.
=======================================
 Авторизация пользователя
=======================================
*/
require_once ENGINE_DIR . '/classes/db_connect.php';
require_once ENGINE_DIR . '/classes/helpers.php';

if (!empty($_POST)) {
    if (empty($_POST['login'])) $helpers->addMessage('Не введен Логин', true);
    if (empty($_POST['pass'])) $helpers->addMessage('Не введен Пароль', true);
    if (empty($helpers->msg)) {
        $stmt = $pdo->prepare('SELECT * FROM `users` JOIN `user_groups` ON users.usergroup_id = user_groups.id WHERE `login` = :login AND `status` = 1');
        $stmt->bindValue(':login', $_POST['login'], PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch();
        if (empty($row)) {
            $helpers->addMessage('Логин <b>' . htmlentities($_POST['login']) . '</b> не найден!', true);
        } else {
            if (password_verify($_POST['pass'], $row->password)) {
                $_SESSION['auth'] = true;
                $_SESSION['user_data'] = [
                    'username' => $row->login,
                    'usergroup' => $row->name,
                    'image' => $row->image,

                    'is_admin' => $row->is_admin,
                    'news_edit' => $row->news_edit,
                    'programs_edit' => $row->programs_edit,
                    'schedule_edit' => $row->schedule_edit,
                    'page_edit' => $row->page_edit,
                    'users_view' => $row->users_view,
                    'users_edit' => $row->users_edit,
                    'groups_edit' => $row->groups_edit
                ];
                header('Location:http://' . $_SERVER['HTTP_HOST']);
                exit;
            } else {
                $helpers->addMessage('Неверный пароль!', true);
            }
        }
    }
}
require_once $template . '/auth.php';
