<?php
require_once('init.php');
require_once ('session.php');

if (isset($_GET['task_id']) and isset($_GET['check'])) {
    db_update_task_status($conn, $user_id, intval($_GET['task_id']), intval($_GET['check']));
}

$filter = $_GET['filter'] ?? '';
$search = trim($_GET['search'] ?? '');

$selected_project_id = isset($_GET['project_id']) ? intval($_GET['project_id']) : 0;
$show_complete_tasks = isset($_GET['show_completed']) ? intval($_GET['show_completed']) : 0;

$tasks = db_get_tasks($conn, $user_id, $selected_project_id, $search, $filter);

$project_list = include_template(TEMPLATE_PROJECT_LIST, [
    'projects' => db_get_projects($conn, $user_id),
    'selected_project_id' => $selected_project_id
]);
$content = include_template(TEMPLATE_MAIN, [
    'project_list' => $project_list,
    'tasks' => $tasks,
    'show_complete_tasks' => $show_complete_tasks,
    'filter' => $filter
]);
$layout = include_template(TEMPLATE_LAYOUT, [
    'content' => $content,
    'title' => $title,
    'selected_project_id' => $selected_project_id
]);

echo $layout;

