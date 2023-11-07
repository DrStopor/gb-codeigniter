<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
    <div class="container">
        <h1>Вы успешно зарегистрированы</h1>

        <div class="cart mt-5">
            <div class="card-body">
                <h5 class="card-title">Информация о регистрации</h5>
                <p class="card-text">Поздравляем! Вы успешно зарегистрированы на сайте.</p>
                <p class="card-text">Теперь Вы можете войти на сайт, используя свой логин и пароль.</p>
                <a href="<?= site_url('/login') ?>" class="btn btn-primary">Войти</a>
                <a href="<?= site_url('/') ?>" class="btn btn-primary">На главную</a>
            </div>
        </div>
<?= $this->endSection() ?>