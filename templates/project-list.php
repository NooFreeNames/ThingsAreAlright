<section class="content__side">
    <h2 class="content__side-heading">Проекты</h2>

    <nav class="main-navigation">
        <?php foreach ($projects as $project): ?>
            <ul class="main-navigation__list">
                <li class="main-navigation__list-item <?php if ($project['id'] === $selected_project_id): ?>main-navigation__list-item--active<?php endif; ?>">
                    <a class="main-navigation__list-item-link"
                       href="/?project_id=<?= $project['id'] ?>"><?= htmlspecialchars($project['name']) ?></a>
                    <span class="main-navigation__list-item-count"><?= $project['task_count'] ?></span>
                </li>
            </ul>
        <?php endforeach; ?>
    </nav>

    <a class="button button--transparent button--plus content__side-button"
       href="add-project.php" target="project_add">Добавить проект</a>
</section>
