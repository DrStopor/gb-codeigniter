<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
    <div class="container">
        <div class="row">
            <h1>Registration</h1>
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
            <div class="col-6">
                <?= form_open('/signup/store') ?>
                <div class="form-group">
                    <label for="name">Username</label>
                    <input type="text" name="username" id="name" class="form-control" value="<?= old('username') ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" class="form-control" value="<?= old('email') ?>">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" name="password" id="password" class="form-control" value="<?= old('password') ?>">
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Password confirmation</label>
                    <input type="text" name="password_confirmation" id="password_confirmation" class="form-control" value="<?= old('password_confirmation') ?>">
                </div>
                <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
                <?= form_close() ?>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>