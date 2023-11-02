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
            <?php if (!empty($messages)): ?>
            <?php foreach ($messages as $message): ?>
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="card-title">
                            <h5><?= isset($message->user) ? $message->user->username : 'Гость' ?> <?= 'оставил(а) сообщение' ?></h5> в <small><?= $message->created_at ?></small><br>
                            <h5><?= 'Тема' ?>: <?= $message->title ?></h5>
                        </div>
                        <div class="card-text" style="background-color: #f0f0f0; border-radius: 3px">
                            <h5><?= 'Сообщение' ?>:</h5>
                            <?= $message->message ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <!-- paginataion -->
            <div class="row">
                <div class="col-12">
                    <?= $pager->links('group1', 'default_bs4') ?>
                    <?php /*= $pager->simpleLinks('group2') */?>
                </div>

            </div>
            <?php else: ?>
            <div class="alert alert-info" role="alert">
                Нет сообщений
            </div>
            <?php endif; ?>
            <hr>
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <textarea class="form-control" name="message" id="message" cols="30" rows="4" placeholder="Сообщение" required></textarea>
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
</script>
<?= $this->endSection() ?>