<section class="content__side">
    <p class="content__side-info">Если у вас уже есть аккаунт, авторизуйтесь на сайте</p>

    <a class="button button--transparent content__side-button" href="register.php">Зарегистрироваться</a>
</section>

<main class="content__main">
    <h2 class="content__main-heading">Вход на сайт</h2>

    <form class="form" action="auth.php" method="post" autocomplete="off">
        <div class="form__row">
            <?php $has_email_error = isset($error_list['email']) ?>
            <label class="form__label" for="email">E-mail <sup>*</sup></label>

            <input class="form__input <?php if ($has_email_error): ?>form__input--error<?php endif; ?>" type="text"
                   name="email" id="email" value="<?=htmlspecialchars($current_user['email'])?>" placeholder="Введите e-mail">

            <?php if ($has_email_error): ?>
                <p class="form__message"><?= $error_list['email'] ?></p>
            <?php endif; ?>
        </div>

        <div class="form__row">
            <?php $has_password_error = isset($error_list['password']) ?>
            <label class="form__label" for="password">Пароль <sup>*</sup></label>

            <input class="form__input <?php if ($has_password_error): ?>form__input--error<?php endif; ?>"
                   type="password" name="password" id="password" value="<?=htmlspecialchars($current_user['password'])?>" placeholder="Введите пароль">

            <?php if ($has_password_error): ?>
                <p class="form__message"><?= $error_list['password'] ?></p>
            <?php endif; ?>
        </div>

        <div class="form__row form__row--controls">
            <?php if (!empty($error_message)): ?>
                <p class="error-message"><?= $error_message ?></p>
            <?php endif; ?>
            <input class="button" type="submit" name="" value="Войти">
        </div>
    </form>

</main>
