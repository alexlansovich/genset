<?php


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

<?php if (!empty($runs)) : ?>
    <table class="ui yellow table">
        <thead>
            <tr>
                <th>Адреса</th>
                <th>Генератор</th>
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
                        <h4 class="ui header">
                            <button onclick='window.location.href="<?= site_url('GenSets/view/'.$run['genId']) ?>"' class="ui icon mini button">
                                <i class="chartline blue icon"></i>
                            </button>
                            <div class="content">
                                <?= $run['city']; ?>
                                <div class="sub header"><?= $run['address'] ?>
                                </div>
                            </div>
                        </h4>
                    </td>
                    <td>
                        <div class="ui circular label">
                            <?= $run['phase'] ?>
                        </div>
                        <?= $run['type_name'] ?>
                    </td>
                    <td><?= date('d-m-Y H:i:s', $run['startDate']) ?></td>
                    <td>
                        <?php
                        if (!empty($run['stopDate']))
                            echo date('d-m-Y H:i:s', $run['stopDate']);
                        else echo 'Працює зараз';
                        ?>
                    </td>
                    <td><?= $run['worktime'] ?></td>
                    <td><?= $run['runType'] ?></td>
                    <td><?= $run['runResult'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php else : ?>
    <p>Не має запусків генераторів</p>
<?php endif; ?>

