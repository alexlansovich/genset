<?php

$colors = [
    'normal' => [
        'caption' => 'Інші',
        'color' => 'blue'
    ],
    'running' => [
        'caption' => 'Працюють зараз',
        'color' => 'green'
    ],
    'broken' => [
        'caption' => 'Неробочий стан',
        'color' => 'red'
    ],
];

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

<?php if (!empty($genSetArray)) : ?>
    <?php foreach ($genSetArray as $key => $genSets) : ?>
        <?php if (!empty($genSets)) : ?>
            <div class="ui raised segment">
                <a class="ui <?= $colors[$key]['color']; ?> ribbon label"><?= $colors[$key]['caption']; ?></a>
                <table class="ui yellow table">
                    <thead>
                    <tr>
                        <th>Адреса</th>
                        <th></th>
                        <th>Останній запуск</th>
                        <th>Генератор</th>
                        <th>Бак</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($genSets as $genSet) : ?>
                        <tr>
                            <td>
                                <h4 class="ui header">
                                    <?php if (isset($edit)) : ?>
                                        <button onclick='openEditModal(<?= json_encode($genSet, JSON_HEX_APOS ) ?>)' class="ui icon button">
                                            <i class="edit outline icon"></i>
                                        </button>
                                    <?php endif; ?>

                                    <div class="content">
                                        <?= $genSet['city']; ?>
                                        <div class="sub header"><?= $genSet['address'] ?>
                                        </div>
                                    </div>
                                </h4>
                            </td>
                            <td>
                                <button onclick='window.location.href="<?= site_url('GenSets/view/'.$genSet['genId']) ?>"' class="ui icon button">
                                    <i class="chartline blue icon"></i>
                                </button>
                                <button onclick='openRefuelModal(<?= json_encode($genSet,JSON_HEX_APOS) ?>)' class="ui icon button">
                                    <i class="gas pump red icon"></i>
                                </button>
                                <button onclick='openServiceModal(<?= json_encode($genSet,JSON_HEX_APOS) ?>)' class="ui icon button">
                                    <i class="tools black icon"></i>
                                </button>
                                <?php if ($key === 'running') : ?>
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
                                <?php
                                if (($key === 'running') && ($genSet['last_run_timestamp'] !== null)) {
                                    echo '<div class="ui pointing below red basic label">';
                                    echo 'Працює ';
                                    $diffSeconds = abs(time() - $genSet['last_run_timestamp']);
                                    $hours = floor($diffSeconds / 3600); // 1 hour = 3600 seconds
                                    $minutes = floor(($diffSeconds % 3600) / 60); // 1 minute = 60 seconds
                                    // If hours are less than 1, set them to 0
                                    if ($hours < 1)
                                        echo "$minutes хв.";
                                    else
                                        echo "$hours год., $minutes хв.";
                                    echo '</div>';
                                }
                                ?>
                                <br>
                                <?= $genSet['last_run_timestamp'] !== null ? date('d-m-Y H:i:s', $genSet['last_run_timestamp']) : '' ?>

                            </td>
                            <td>
                                <div class="ui circular label">
                                    <?= $genSet['phase'] ?>
                                </div>
                                <?= $genSet['type_name'] ?>
                            </td>
                            <td>
                                <div class="ui fluid large label">
                                    <i class="gas pump icon"></i>
                                    <?= $genSet['genLitres'] !== null ? $genSet['genLitres'] : 'не вказано' ?>
                                    <?= ' / ' .$genSet['fueltank_litres'].' л.' ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>

<?php else : ?>
    <p>Не має визначених генераторів</p>
<?php endif; ?>
