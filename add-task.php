<?php
require_once('init.php');
require_once('session.php');

$title = 'Добавление задачи';

$selected_project_id = intval($_POST['project'] ?? $_GET['project_id'] ?? 0);
if (!db_project_exist_from_id($conn, $user_id, $selected_project_id)) {
    $selected_project_id = 0;
}
$current_task = [
    'name' => trim($_POST['name'] ?? ''),
    'date' => $_POST['date'] ?? '',
    'project_id' => $selected_project_id
];

$projects = db_get_projects($conn, $user_id);
if ($projects->num_rows === 0) {
    header('Location: add-project.php');
    exit();
}

$error_list = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $error_list['name'] = validate_length($current_task['name'], MIN_INPUT_LENGTH, MAX_INPUT_LENGTH);
    $error_list['date'] = validate_date($current_task['date']);
    $error_list['project'] = $current_task['project_id'] === 0 ? 'Проэкт не выбран' : null;

    if ($_FILES['file']['error'] !== UPLOAD_ERR_NO_FILE && $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
        $error_list['file'] = 'Не удалось загрузить файл';
    }

    $error_list = array_filter($error_list);
    if (empty($error_list)) {
        move_file($_FILES['file'], UPLOADS_DIR);
        db_insert_task($conn, $current_task['name'], $user_id, $current_task['project_id'], $current_task['date'], $_FILES['file']['name']);
        header('Location: index.php');
        exit();
    }
}

$project_list = include_template(TEMPLATE_PROJECT_LIST, [
    'projects' => $projects,
    'project' => null
]);
$content = include_template(TEMPLATE_FROM_TASK, [
    'project_list' => $project_list,
    'projects' => $projects,
    'current_task' => $current_task,
    'error_list' => $error_list,
]);
$layout = include_template(TEMPLATE_LAYOUT, [
    'content' => $content,
    'title' => $title
]);

echo $layout;
