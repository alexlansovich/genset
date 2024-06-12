<?php
//echo '<pre>';
//var_dump($genSet);
//exit;
//todo повернення на ту сторінку з якоі натиснулася модалка
?>
<?php if (isset($_GET['success'])) : ?>
    <!-- <div id="successMessage" class="ui positive message">
        <p><?= $_GET['success'] ?></p>
    </div>
    <script>
        // Auto-hide success message after 5 seconds (5000 milliseconds)
        setTimeout(function() {
            $('#successMessage').fadeOut('slow');
        }, 5000);
    </script>
-->
<?php endif; ?>

<!-- Define the success message element -->
<div id="successMessage" class="ui positive message" style="display: none;">
    <p>Success</p>
</div>

<div class="ui raised segment">
    <table class="ui yellow table">
        <thead>
        <tr>
            <th>Адреса</th>
            <th></th>
            <th>Генератор</th>
            <th>Заповнений</th>
            <th>Ємність</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <h4 class="ui header">
                        <button onclick='openEditModal(<?= json_encode($genSet,JSON_HEX_APOS) ?>)' class="ui icon button">
                            <i class="edit outline icon"></i>
                        </button>
                        <div class="content">
                            <?= $genSet['city']; ?>
                            <div class="sub header"><?= $genSet['address'] ?>
                            </div>
                        </div>
                    </h4>
                </td>
                <td>
                    <button onclick='openRefuelModal(<?= json_encode($genSet,JSON_HEX_APOS) ?>)' class="ui icon button">
                        <i class="gas pump red icon"></i>
                    </button>
                    <button onclick='openServiceModal(<?= json_encode($genSet,JSON_HEX_APOS) ?>)' class="ui icon button">
                        <i class="tools black icon"></i>
                    </button>
                    <?php if ($genSet['genState'] === '1') : ?>
                        <button onclick='openStopModal(<?= json_encode($genSet,JSON_HEX_APOS) ?>)' class="ui icon button">
                            <i class="power off red icon"></i>
                        </button>
                    <?php else : ?>
                        <button onclick='openRunModal(<?= json_encode($genSet,JSON_HEX_APOS) ?>)' class="ui icon button">
                            <i class="bolt red icon"></i>
                        </button>
                    <?php endif; ?>
                </td>
                <td>
                    <div class="ui circular label">
                        <?= $genSet['phase'] ?>
                    </div>
                    <?= $genSet['type_name'] ?>
                </td>
                <td><?= $genSet['genLitres'] !== null ? $genSet['genLitres'] . ' Літра' : 'не вказано' ?></td>
                <td><?= $genSet['fueltank_name'] ?></td>
            </tr>
        </tbody>
    </table>
</div>
<?php if (!empty($runs)) : ?>
            <div class="ui raised segment">
                <h4 class="ui header">
                    <i class="plug icon"></i>
                    <div class="content">
                        Запуски
                    </div>
                </h4>
                <table class="ui yellow table">
                    <thead>
                    <tr>
                        <th>Запуск</th>
                        <th>Зупинка</th>
                        <th>Час роботи</th>
                        <th>Тип</th>
                        <th>Результат</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($runs as $run) : ?>
                        <tr>
                            <td>
                                <?= date('d-m-Y H:i:s', $run['startDate']) ?>
                            </td>
                            <td>
                                <?php
                                if (!empty($run['stopDate']))
                                echo date('d-m-Y H:i:s', $run['stopDate']);
                                else echo 'Працює зараз';
                                ?>
                            </td>
                            <td>
                                <?= $run['worktime'] ?>
                            </td>
                            <td>
                                <?= $run['runType'] ?>
                            </td>
                            <td>
                                <?= $run['runResult'] ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
<?php endif; ?>

<?php if (!empty($refuels)) : ?>
    <div class="ui raised segment">
        <h4 class="ui header">
            <i class="gas pump icon"></i>
            <div class="content">
                Заправки
            </div>
        </h4>
        <table class="ui yellow table">
            <thead>
            <tr>
                <th>Дата</th>
                <th>Залито</th>
                <th>Було</th>
                <th>Стало</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($refuels as $refuel) : ?>
                <tr>
                    <td>
                        <?= date('d-m-Y H:i:s', $refuel['date']) ?>
                    </td>
                    <td>
                        <?= $refuel['litres'] ?>
                    </td>
                    <td>
                        <?= $refuel['litresBefore'] ?>
                    </td>
                    <td>
                        <?= $refuel['litresAfter'] ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<?php if (!empty($services)) : ?>
    <div class="ui raised segment">
        <h4 class="ui header">
            <i class="tools icon"></i>
            <div class="content">
                Сервіси
            </div>
        </h4>
        <table class="ui yellow table">
            <thead>
            <tr>
                <th>Дата</th>
                <th>Роботи</th>
                <th>Додатково</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($services as $service) : ?>
                <tr>
                    <td>
                        <?= date('d-m-Y H:i:s', $service['serviceDate']) ?>
                    </td>
                    <td>
                        <div class="ui bulleted list">
                            <?php foreach (unserialize($service['serviceWorks']) as $work) : ?>
                                <div class="item">
                                    <?php //todo переробити на js ? чи додаткову перевірку що масив існує ?>
                                    <?= $serviceTypes[$work]['servicetype_name'] ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </td>
                    <td>
                        <?= $service['serviceDesc'] ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>
