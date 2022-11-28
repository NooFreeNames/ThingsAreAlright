<?php
require_once('init.php');
$title = 'Добро пожаловать!';

$content = include_template(TEMPLATE_GUEST, []);
$layout = include_template(TEMPLATE_LAYOUT, [
    'content' => $content,
    'title' => $title
]);

echo $layout;


