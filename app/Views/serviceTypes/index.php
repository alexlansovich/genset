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

<?php if (!empty($serviceTypes)) : ?>
    <table class="ui yellow table">
        <thead>
            <tr>
                <th>Назва</th>
                <th>Опис</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($serviceTypes as $serviceType) : ?>
                <tr>
                    <td>
                        <?php if (isset($edit)) : ?>
                        <button onclick='openEditModal(<?= json_encode($serviceType) ?>)' class="ui icon button">
                            <i class="edit outline icon"></i>
                        </button>
                        <?php endif; ?>
                        <?= $serviceType['servicetype_name']; ?>
                    </td>
                    <td><?= $serviceType['servicetype_description'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else : ?>
    <p>Не має визначених типів сервісу</p>
<?php endif; ?>
