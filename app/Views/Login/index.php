<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
    <div class="container">
        <div class="row">
            <h1>Авторизация</h1>
        </div>
        <div class="row">
            <?php if (session()->has('errors')): ?>
                <div class="alert alert-danger" role="alert">
                    <ul>
                        <?php foreach (session('errors') as $error): ?>
                            <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
        <div class="row">
            <div class="col-5">
                <?= form_open('/login/start', ['class' => 'row g-3']) ?>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" class="form-control" value="<?= old('email') ?>">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" name="password" id="password" class="form-control" value="<?= old('password') ?>">
                </div>
                <button type="submit" class="btn btn-primary">Войти</button>
                <?= form_close() ?>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>