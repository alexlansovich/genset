<?php

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

<?php if (!empty($services)) : ?>
    <table class="ui yellow table">
        <thead>
        <tr>
            <th>Дата</th>
            <th>Адреса</th>
            <th>Генератор</th>
            <th>Роботи</th>
            <th>Додатково</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($services as $service) : ?>
            <tr>

                <td>
                    <button onclick='window.location.href="<?= site_url('GenSets/view/'.$service['genId']) ?>"' class="ui icon mini button">
                        <i class="chartline blue icon"></i>
                    </button>
                    <?= date('d-m-Y H:i:s', $service['serviceDate']) ?></td>
                <td>
                    <h4 class="ui header">
                        <div class="content">
                            <?= $service['city']; ?>
                            <div class="sub header"><?= $service['address'] ?>
                            </div>
                        </div>
                    </h4>
                </td>
                <td>
                    <div class="ui circular label">
                        <?= $service['phase'] ?>
                    </div>
                    <?= $service['type_name'] ?>
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
                <td><?= $service['serviceDesc'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

<?php else : ?>
    <p>Не має сервісу генераторів</p>
<?php endif; ?>

