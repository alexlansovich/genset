<?php

//var_dump($fuelTanks);

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

<?php if (!empty($fuelTanks)) : ?>
    <table class="ui yellow table">
        <thead>
            <tr>
                <th>Назва</th>
                <th>Ємність</th>
                <th>Опис</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($fuelTanks as $fuelTank) : ?>
                <tr>
                    <td>
                        <?php if (isset($edit)) : ?>
                        <button onclick='openEditModal(<?= json_encode($fuelTank) ?>)' class="ui icon button">
                            <i class="edit outline icon"></i>
                        </button>
                        <?php endif; ?>
                        <?= $fuelTank['fueltank_name']; ?>
                    </td>
                    <td><?= $fuelTank['fueltank_litres'] ?></td>
                    <td><?= $fuelTank['fueltank_description'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else : ?>
    <p>Не має визначених типів баків</p>
<?php endif; ?>
