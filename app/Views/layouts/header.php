<div class="container">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Гостевая книга</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?= site_url() ?>">Главная</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url("/messages") ?>">Сообщения</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url("/users") ?>">Пользователи</a>
                    </li>
                </ul>
            </div>
            <div class="navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <?php if (session()->has('user_id')): ?>
                        <li class="nav-item">
                            <span class="nav-link">Пользователь: <?= session('username') ?></span>
                        </li>
                        <li class="nav-item">
                            <span class="nav-link">E-mail: <?= session('email') ?></span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url("/logout") ?>">Выйти</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url("/signup") ?>">Регистрация</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url("/login") ?>">Войти</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</div>