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

<?php if (!empty($refuels)) : ?>
    <table class="ui yellow table">
        <thead>
            <tr>
                <th>Дата</th>
                <th>Адреса</th>
                <th>Генератор</th>
                <th>Ємність</th>
                <th>Залито</th>
                <th>Було</th>
                <th>Стало</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($refuels as $refuel) : ?>
                <tr>

                    <td>
                        <button onclick='window.location.href="<?= site_url('GenSets/view/'.$refuel['genId']) ?>"' class="ui icon mini button">
                            <i class="chartline blue icon"></i>
                        </button>
                        <?= date('d-m-Y H:i:s', $refuel['date']) ?></td>
                    <td>
                        <h4 class="ui header">
                            <div class="content">
                                <?= $refuel['city']; ?>
                                <div class="sub header"><?= $refuel['address'] ?>
                                </div>
                            </div>
                        </h4>
                    </td>
                    <td>
                        <div class="ui circular label">
                            <?= $refuel['phase'] ?>
                        </div>
                        <?= $refuel['type_name'] ?>
                    </td>
                    <td><?= $refuel['fueltank_name'] ?></td>
                    <td><?= $refuel['litres'] ?></td>
                    <td><?= $refuel['litresBefore'] ?></td>
                    <td><?= $refuel['litresAfter'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php else : ?>
    <p>Не має заправок генераторів</p>
<?php endif; ?>

