<?= $project_list ?>

<main class="content__main">
    <h2 class="content__main-heading">Добавление задачи</h2>

    <form class="form" action="add-task.php" method="post" autocomplete="off" enctype="multipart/form-data">
        <div class="form__row">
            <?php $has_name_error = isset($error_list['name']) ?>
            <label class="form__label" for="name">Название <sup>*</sup></label>

            <input class="form__input <?php if ($has_name_error): ?>form__input--error<?php endif; ?>" type="text"
                   name="name" id="name" value="<?=htmlspecialchars($current_task['name'])?>" placeholder="Введите название">
            <?php if ($has_name_error): ?>
                <p class="form__message"><?= $error_list['name'] ?></p>
            <?php endif; ?>
        </div>

        <div class="form__row">
            <?php $has_project_error = isset($error_list['project']) ?>
            <label class="form__label" for="project">Проект <sup>*</sup></label>

            <select
                class="form__input form__input--select <?php if ($has_project_error): ?>form__input--error<?php endif; ?>"
                name="project" id="project">
                <?php if (empty($current_task['project_id'])):?>
                    <option value="0">&lt;Проект не выбран></option>
                <?php endif;?>
                <?php foreach ($projects as $project): ?>

                    <option value="<?= $project['id'] ?>"
                            <?php if ($project['id'] === $current_task['project_id']): ?>selected<?php endif; ?>><?= htmlspecialchars($project['name']) ?></option>
                <?php endforeach; ?>
            </select>
            <?php if ($has_project_error): ?>
                <p class="form__message"><?= $error_list['project'] ?></p>
            <?php endif; ?>
        </div>

        <div class="form__row">
            <?php $has_date_error = isset($error_list['date']) ?>
            <label class="form__label" for="date">Дата выполнения</label>

            <input class="form__input form__input--date <?php if ($has_date_error): ?>form__input--error<?php endif; ?>"
                   type="text" name="date" id="date" value="<?=$current_task['date']?>" placeholder="Введите дату в формате ГГГГ-ММ-ДД">

            <?php if ($has_date_error): ?>
                <p class="form__message"><?= $error_list['date'] ?></p>
            <?php endif; ?>
        </div>

        <div class="form__row">
            <?php $has_file_error = isset($error_list['file']) ?>
            <label class="form__label" for="file">Файл</label>

            <div class="form__input-file">
                <input class="visually-hidden" type="file" name="file" id="file" value="C:\Users\Study\Pictures\1.png">

                <label
                    class="button button--transparent <?php if ($has_file_error): ?>form__input--error<?php endif; ?>"
                    for="file">
                    <span>Выберите файл</span>
                </label>

                <?php if ($has_file_error): ?>
                    <p class="form__message"><?= $error_list['file'] ?></p>
                <?php endif; ?>
            </div>
        </div>

        <div class="form__row form__row--controls">
            <input class="button" type="submit" name="" value="Добавить">
        </div>
    </form>
</main>

