<?= $project_list ?>

<main class="content__main">
    <h2 class="content__main-heading">Список задач</h2>

    <form class="search-form" action="index.php" method="get" autocomplete="off">
        <input class="search-form__input" type="text" name="search" value="" placeholder="Поиск по задачам">

        <input class="search-form__submit" type="submit" name="" value="Искать">
    </form>

    <div class="tasks-controls">
        <nav class="tasks-switch">
            <a href="/"
               class="tasks-switch__item <?php if (empty($filter)): ?>tasks-switch__item--active<?php endif; ?>">Все
                задачи</a>
            <a href="/?filter=<?= FILTER_TODAY ?>"
               class="tasks-switch__item <?php if ($filter === FILTER_TODAY): ?>tasks-switch__item--active<?php endif; ?>">Повестка
                дня</a>
            <a href="/?filter=<?= FILTER_TOMORROW ?>"
               class="tasks-switch__item <?php if ($filter === FILTER_TOMORROW): ?>tasks-switch__item--active<?php endif; ?>">Завтра</a>
            <a href="/?filter=<?= FILTER_OVERDUE ?>"
               class="tasks-switch__item <?php if ($filter === FILTER_OVERDUE): ?>tasks-switch__item--active<?php endif; ?>">Просроченные</a>
        </nav>

        <label class="checkbox">
            <input class="checkbox__input visually-hidden show_completed" type="checkbox"
                   <?php if ($show_complete_tasks === 1): ?>checked<?php endif; ?>>
            <span class="checkbox__text">Показывать выполненные</span>
        </label>
    </div>

    <table class="tasks">
        <?php if ($tasks->num_rows === 0): ?>
            <p>Ничего не найдено по вашему запросу</p>
        <?php else: foreach ($tasks as $task): ?>
            <tr class="<?php if ($show_complete_tasks === 0 && $task["is_completed"] === 1): ?>hidden<?php endif; ?> <?php if (time_deff($task["end_date"]) < 24): ?>task--important<?php endif; ?> tasks__item task <?php if ($task["is_completed"] === 1): ?>task--completed<?php endif; ?>">
                <td class="task__select ">
                    <label class="checkbox task__checkbox">
                        <input class="checkbox__input visually-hidden task__checkbox" type="checkbox"
                               value="<?= $task["id"] ?>"
                               <?php if ($task['is_completed'] == 1): ?>checked<?php endif; ?>>
                        <span class="checkbox__text"><?= htmlspecialchars($task["name"]) ?></span>
                    </label>
                </td>

                <td class="task__file">
                    <?php if (!empty($task['file_path'])): ?>
                        <a class="download-link"
                           href="<?= 'uploads/' . htmlspecialchars($task['file_path']) ?>" download><?= htmlspecialchars($task['file_path']) ?></a>
                    <?php endif; ?>
                </td>
                <td class="task__date"><?= $task["end_date"] ?></td>
                <td class="task__controls"><?= htmlspecialchars($task['project']) ?></td>
            </tr>
        <?php endforeach; endif; ?>
    </table>
</main>
