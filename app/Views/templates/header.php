<!DOCTYPE html>
<html lang="ua">

<head>
    <meta charset="UTF-8">
    <title>Генератори McLaut</title>
    <meta name="description" content="<?php echo base_url(); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <script src="<?php echo base_url('assets/fomantic/dist/jquery-3.7.1.min.js'); ?>"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/fomantic/dist/semantic.min.css'); ?>">
    <script src="<?php echo base_url('assets/fomantic/dist/semantic.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/functions.js'); ?>"></script>
</head>


<body>
<div class="ui attached stackable menu">
    <div class="ui container">
        <a class="item" href="/">
            <i class="home icon"></i> Генератори
        </a>
        <a class="item" href="/Runs">
            <i class="power off icon"></i> Запуски
        </a>
        <a class="item" href="/Refuels">
            <i class="gas pump icon"></i> Заправки
        </a>
        <a class="item" href="/Services">
            <i class="tools icon"></i> Обслуговування
        </a>
        <div class="ui simple dropdown item">
            More
            <i class="dropdown icon"></i>
            <div class="menu">
                <a class="item" href="/GenTypes"><i class="globe icon"></i> Типи генераторів</a>
                <a class="item" href="/FuelTanks"><i class="settings icon"></i> Типи бака</a>
                <a class="item" href="/ServiceTypes"><i class="settings icon"></i> Типи сервісу</a>
            </div>
        </div>
        <div class="right item">
            <a class="item" href="/logout">
                <i class="sign out alternate icon"></i> Вихід
            </a>
        </div>
    </div>
</div>
<div class="ui container segment">
    <h2 class="ui header">
        <?php
        if (!empty($title)) echo $title;
        echo ' ';
        if (!empty($url)) echo $url;
        ?>
    </h2>
    <p>