<?= $project_list ?>

<main class="content__main">
    <h2 class="content__main-heading">Добавление проекта</h2>

    <form class="form" action="add-project.php" method="post" autocomplete="off">
        <div class="form__row">
            <?php $has_name_error = isset($error_list['name']) ?>
            <label class="form__label" for="project_name">Название <sup>*</sup></label>

            <input class="form__input <?php if ($has_name_error): ?>form__input--error<?php endif; ?>" type="text"
                   name="name" id="project_name" value="<?=htmlspecialchars($project_name)?>" placeholder="Введите название проекта">
            <?php if ($has_name_error): ?>
                <p class="form__message"><?= $error_list['name'] ?></p>
            <?php endif; ?>
        </div>

        <div class="form__row form__row--controls">
            <input class="button" type="submit" name="" value="Добавить">
        </div>
    </form>
</main>
