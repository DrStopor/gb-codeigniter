<?php use App\Controllers\Helper;

$this->extend('layouts/main') ?>

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
            <?php /**
             * @param $param
             * @param $order
             * @return string[]
             */


            if (!empty($messages)): ?>
                <?php
                list($htmlId, $htmlDate) = Helper::getSortButtons($param, $order);

                echo  '<small>' . $htmlId . '</br>' . $htmlDate . '</small>';
                ?>
            <?php foreach ($messages as $message): ?>
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="card-title">
                            <h5><?= $message->name ?> <?= 'оставил(а) сообщение' ?></h5> в <small><?= $message->created_at ?></small><br>
                        </div>
                        <div class="card-text" style="background-color: #f0f0f0; border-radius: 3px">
                            <h5><?= 'Сообщение' ?>:</h5>
                            <p><?= esc($message->text) ?></p>

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
            <div class="row">
                <div class="col-12">
                    <?= form_open('/message/create', ['class' => 'row g-3']) ?>
                    <div class="form-group col-6">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control" value="<?= old('email') ?>" onkeyup="validateEmail(this);" required>
                    </div>
                    <div class="form-group col-6">
                        <label for="date">Дата</label>
                        <input type="datetime-local" name="date" id="date" class="form-control" value="<?= old('created_at') ?>" required>
                    </div>
                    <div class="form-group col-12">
                        <label for="text">Сообщение</label>
                        <textarea class="form-control" name="message" id="text" cols="30" rows="4" placeholder="Сообщение" required></textarea>
                    </div>
                    <div class="form-group col-12">
                        <button class="btn btn-primary" type="button" id="save-button">Отправить</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function confirmDelete() {
        return confirm('Удалить сообщение?');
    }

    function validateEmail(obj) {
        const value = $(obj).val();
        let vd = String(value)
            .toLowerCase()
            .match(
                /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            );
        console.log(vd);
        if (!vd) {
            $(obj).addClass('is-invalid');
            return;
        }
        $(obj).removeClass('is-invalid');
    }

    $(function () {
        $('button#save-button').on('click', function (e) {
            e.preventDefault();
            const form = $(e.target).parents('form');

            const email = form.find('#email');
            validateEmail(email);
            if (email.hasClass('is-invalid')) {
                return;
            }

            const dateValue = new Date(form.find('#date').val());
            const date = dateValue.toLocaleDateString() + ' ' + dateValue.toLocaleTimeString();
            console.log(date);
            const msg = form.find('#text');
            $.ajax({
                url: "<?= site_url('/message/create') ?>",
                method: 'POST',
                data: {
                    name: email.val(),
                    created_at: date,
                    text: msg.val(),
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
<?php session()->remove('error'); session()->remove('success'); ?>
<?= $this->endSection() ?>