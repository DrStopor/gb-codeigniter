<?php $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Сообщения</h1>
            <?php if (session()->has('errors')): ?>
            <div class="alert alert-danger" role="alert">
                <ul>
                    <?php foreach (session('errors') as $error): ?>
                    <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>
            <?php if (session()->has('success')): ?>
            <div class="alert alert-success" role="alert">
                <?= session('success') ?>
            </div>
            <?php endif; ?>
            <?php /*dd(session()); */?>
            <?php if (!empty($messages)): ?>
           <div class="col-12">
                <?= $pager->only(['order'])->simpleLinks('date') ?>
            </div>
            <?php foreach ($messages as $message): ?>
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="card-title">
                            <h5><?= isset($message->user) ? esc($message->user->username) : 'Гость' ?> <?= 'оставил(а) сообщение' ?></h5> в <small><?= $message->created_at ?></small><br>
                        </div>
                        <div class="card-text" style="background-color: #f0f0f0; border-radius: 3px">
                            <h5><?= 'Сообщение' ?>:</h5>
                            <p><?= esc($message->message) ?></p>

                        </div>
                        <div class="card-footer mb-4">
                            <a href="<?= site_url('/message/delete/' . $message->id) ?>" class="btn btn-danger btn-sm" onclick="return confirmDelete()">удалить</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <!-- pagination -->
            <div class="row">
                <div class="col-12">
                    <?= $pager->only(['order'])->links('id', 'default_bs4') ?>
                </div>
            </div>
            <?php else: ?>
            <div class="alert alert-info" role="alert">
                Нет сообщений
            </div>
            <?php endif; ?>
            <hr>
            <!--<div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <textarea class="form-control" name="message" id="message" cols="30" rows="4" placeholder="Сообщение" required></textarea>
                        <button class="btn btn-primary" type="submit">Отправить</button>
                    </div>
                </div>
            </div>-->
            <div class="row">
                <div class="col-12">
                    <?= form_open('/message/create', ['class' => 'row g-3']) ?>
                    <div class="form-group col-6">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control" value="<?= old('email') ?>">
                    </div>
                    <div class="form-group col-6">
                        <label for="password">Password</label>
                        <input type="text" name="password" id="password" class="form-control" value="<?= old('password') ?>">
                    </div>
                    <div class="form-group col-12">
                        <label for="text">Сообщение</label>
                        <textarea class="form-control" name="message" id="text" cols="30" rows="4" placeholder="Сообщение" required></textarea>
                    </div>
                    <div class="form-group col-12">
                        <button class="btn btn-primary" type="submit">Отправить</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('button[type="submit"]').on('click', function (e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url('/message/create') ?>",
                method: 'POST',
                data: {
                    message: $('#message').val(),
                    id_user: '<?= isset($user) ? $user->id : null ?>',
                },
                success: function (data) {
                    console.log(data);
                    if (data.status === 'success') {
                        location.reload();
                    }

                    if (data.status === 'error') {
                        alert(data.message);
                    }
                },
                error: function (data) {
                    console.log(data);
                }
            });
        });
    });

    function ConfirmDelete() {
        return confirm('Удалить сообщение?');
    }
</script>
<?= $this->endSection() ?>