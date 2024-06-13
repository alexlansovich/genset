<!DOCTYPE html>
<html lang="ua">

<head>
    <meta charset="UTF-8">
    <title>Генератори</title>
    <meta name="description" content="<?php echo base_url(); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <script src="<?php echo base_url('assets/fomantic/jquery-3.7.1.min.js'); ?>"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/fomantic/semantic.min.css'); ?>">
    <script src="<?php echo base_url('assets/fomantic/semantic.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/functions.js'); ?>"></script>
    <style type="text/css">
        body {
            background-color: #DADADA;
        }

        body > .grid {
            height: 100%;
        }

        .column {
            max-width: 450px;
        }
    </style>
    <script>
        $(document)
            .ready(function () {
                $('.ui.form')
                    .form({
                        fields: {
                            email: {
                                identifier: 'email',
                                rules: [
                                    {
                                        type: 'empty',
                                        prompt: 'Введіть ваш e-mail'
                                    },
                                    {
                                        type: 'email',
                                        prompt: 'Введіть правильний e-mail'
                                    }
                                ]
                            },
                            password: {
                                identifier: 'password',
                                rules: [
                                    {
                                        type: 'empty',
                                        prompt: 'Введіть ваш пароль'
                                    }
                                ]
                            }
                        }
                    })
                ;
            })
        ;
    </script>
</head>


<body>

<div class="ui middle aligned center aligned grid">
    <div class="column">
        <h2 class="ui teal image header">
            <div class="content">
                Введіть свій логін/пароль.
            </div>
        </h2>
        <?php if (session('error') !== null) : ?>
            <div class="alert alert-danger" role="alert"><?= session('error') ?></div>
        <?php elseif (session('errors') !== null) : ?>
            <div class="alert alert-danger" role="alert">
                <?php if (is_array(session('errors'))) : ?>
                    <?php foreach (session('errors') as $error) : ?>
                        <?= $error ?>
                        <br>
                    <?php endforeach ?>
                <?php else : ?>
                    <?= session('errors') ?>
                <?php endif ?>
            </div>
        <?php endif ?>

        <?php if (session('message') !== null) : ?>
            <div class="alert alert-success" role="alert"><?= session('message') ?></div>
        <?php endif ?>
        <form action="<?= url_to('login') ?>" method="post" class="ui large form">
            <?= csrf_field() ?>
            <div class="ui stacked segment">
                <div class="field">
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input type="text" name="email" placeholder="E-mail address">
                    </div>
                </div>
                <div class="field">
                    <div class="ui left icon input">
                        <i class="lock icon"></i>
                        <input type="password" name="password" placeholder="Password">
                    </div>
                </div>
                <div class="ui fluid large teal submit button">Ввійти</div>
            </div>

            <div class="ui error message"></div>

        </form>
    </div>
</div>

</body>

</html>
