<?php
require_once('init.php');

$title = 'Вход';

$current_user = [
    'email' => trim($_POST['email'] ?? ''),
    'password' => $_POST['password'] ?? '',
];

$error_list = [];
$error_message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $error_list['password'] = validate_length($current_user['password'], MIN_INPUT_LENGTH, MAX_INPUT_LENGTH);
    $error_list['email'] = validate_email($current_user['email']);

    $error_list = array_filter($error_list);
    if (empty($error_list)) {
        $user = db_get_user($conn, $current_user['email']);
        if (isset($user) && password_verify($current_user['password'], $user['password'])) {
            $_SESSION['user'] = $user;
            header('Location: index.php');
            exit();
        } else {
            $error_message = 'Вы ввели неверный email/пароль';
        }
    }
}

$content = include_template(TEMPLATE_AUTH, [
    'current_user' => $current_user,
    'error_list' => $error_list,
    'error_message' => $error_message,
]);
$layout = include_template(TEMPLATE_LAYOUT, [
    'content' => $content,
    'title' => $title
]);

echo $layout;

