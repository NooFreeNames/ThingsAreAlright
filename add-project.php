<?php
require_once('init.php');
require_once('session.php');

$title = 'Добавление проэкта';

$project_name = trim($_POST['name'] ?? '');

$error_list = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $error_list['name'] = validate_length($project_name, MIN_INPUT_LENGTH, MAX_INPUT_LENGTH);
    if (!isset($error_list['name'])) {
        $error_list['name'] = db_project_exist_from_name($conn, $user_id, $project_name) ? 'Проэкт уже существует' : null;
    }

    $error_list = array_filter($error_list, );
    if (empty($error_list)) {
        db_insert_project($conn, $user_id, $project_name);
        header('Location: index.php');
        exit();
    }
}

$project_list = include_template(TEMPLATE_PROJECT_LIST, [
    'projects' => db_get_projects($conn, $user_id),
    'project' => null
]);
$content = include_template(TEMPLATE_FORM_PROJECT, [
    'error_list' => $error_list,
    'project_list' => $project_list,
    'project_name' => $project_name,
]);
$layout = include_template(TEMPLATE_LAYOUT, [
    'content' => $content,
    'title' => $title
]);
echo $layout;


