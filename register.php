<?php
require_once('init.php');

$title = 'Регистрация';

$current_user = [
    'name' => trim($_POST['name'] ?? ''),
    'email' => trim($_POST['email'] ?? ''),
    'password' => $_POST['password'] ?? '',
];


$error_list = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $error_list['name'] = validate_length($current_user['name'], MIN_INPUT_LENGTH, MAX_INPUT_LENGTH);
    $error_list['password'] = validate_length($current_user['password'], MIN_INPUT_LENGTH, MAX_INPUT_LENGTH);
    $error_list['email'] = validate_email($current_user['email']);

    if (!isset($error_list['email']) && db_user_exist($conn, $current_user['email'])) {
        $error_list['email'] = 'Пользователь с такой электронной почтой уже существует';
    }

    $error_list = array_filter($error_list);
    if (empty($error_list)) {
        db_insert_user($conn, $current_user['name'], $current_user['password'] , $current_user['email'] );
        $_SESSION['user'] = db_get_user($conn, $current_user['email']);
        header('Location: index.php');
        exit();
    }
}

$content = include_template(TEMPLATE_REGISTER, [
    'current_user' => $current_user,
    'error_list' => $error_list,
]);
$layout = include_template(TEMPLATE_LAYOUT, [
    'content' => $content,
    'title' => $title,
]);

echo $layout;
