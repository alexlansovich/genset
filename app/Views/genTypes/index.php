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

<?php if (!empty($genTypes)) : ?>
    <table class="ui yellow table">
        <thead>
            <tr>
                <th>Назва</th>
                <th>Опис</th>
                <th>Споживання</th>
                <th>Кількість фаз</th>
                <th>Потужність Kva</th>
                <th>Потужність Kw</th>
                <th>Параметри сервісу</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($genTypes as $genType) : ?>
                <tr>
                    <td>
                        <?php if (isset($edit)) : ?>
                            <button onclick='openEditModal(<?= json_encode($genType) ?>)' class="ui icon button">
                                <i class="edit outline icon"></i>
                            </button>
                        <?php endif; ?>
                        <?= $genType['type_name']; ?>
                    </td>
                    <td><?= $genType['type_description'] ?></td>
                    <td><?= $genType['litresPerHour'] ?></td>
                    <td><?= $genType['phase'] ?></td>
                    <td><?= $genType['powerKva'] ?></td>
                    <td><?= $genType['powerKw'] ?></td>
                    <td><?= $genType['serviceParameters'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php else : ?>
    <p>Не має визначених типів генераторів</p>
<?php endif; ?>

