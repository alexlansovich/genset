<?php

declare(strict_types=1);

/**
 * This file is part of CodeIgniter Shield.
 *
 * (c) CodeIgniter Foundation <admin@codeigniter.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Config;

use CodeIgniter\Shield\Config\AuthGroups as ShieldAuthGroups;

class AuthGroups extends ShieldAuthGroups
{
    /**
     * --------------------------------------------------------------------
     * Default Group
     * --------------------------------------------------------------------
     * The group that a newly registered user is added to.
     */
    public string $defaultGroup = 'noc';

    /**
     * --------------------------------------------------------------------
     * Groups
     * --------------------------------------------------------------------
     * An associative array of the available groups in the system, where the keys
     * are the group names and the values are arrays of the group info.
     *
     * Whatever value you assign as the key will be used to refer to the group
     * when using functions such as:
     *      $user->addGroup('superadmin');
     *
     * @var array<string, array<string, string>>
     *
     * @see https://codeigniter4.github.io/shield/quick_start_guide/using_authorization/#change-available-groups for more info
     */
    public array $groups = [
        'superadmin' => [
            'title'       => 'Super Admin',
            'description' => 'Повний доступ.',
        ],
        'noc' => [
            'title'       => 'NOC',
            'description' => 'Моніторять і додають запуски.',
        ],
        'manager' => [
            'title'       => 'Менеджери',
            'description' => 'Моніторять і додають запуски.',
        ],
        'mechanic' => [
            'title'       => 'Механік',
            'description' => 'Мониторить і додає сервіси та паливо.',
        ],
        'fueler' => [
            'title'       => 'Заправщик',
            'description' => 'Мониторить і додає сервіси та паливо.',
        ],
    ];

    /**
     * --------------------------------------------------------------------
     * Permissions
     * --------------------------------------------------------------------
     * The available permissions in the system.
     *
     * If a permission is not listed here it cannot be used.
     */
    public array $permissions = [
        'fueltanks.index'        => 'FuelTanks.edit',
        'fueltanks.create'      => 'FuelTanks.create',
        'fueltanks.edit'        => 'FuelTanks.edit',
        'gensets.index'        => 'Gensets.index',
        'gensets.view'        => 'Gensets.view',
        'gensets.create'        => 'Gensets.create',
        'gensets.edit'        => 'Gensets.edit',
        'gentypes.index'        => 'Gentypes.index',
        'gentypes.create'        => 'Gentypes.create',
        'gentypes.edit'        => 'Gentypes.edit',
        'refuels.index'        => 'Refuels.index',
        'refuels.create'        => 'Refuels.create',
        'runs.index'        => 'Runs.index',
        'runs.start'        => 'Runs.start',
        'runs.stop'        => 'Runs.stop',
        'services.index'        => 'Services.index',
        'services.create'        => 'Services.create',
    ];

    /**
     * --------------------------------------------------------------------
     * Permissions Matrix
     * --------------------------------------------------------------------
     * Maps permissions to groups.
     *
     * This defines group-level permissions.
     */
    public array $matrix = [
        'superadmin' => [
            'fueltanks.*',
            'gentypes.*',
            'gensets.*',
            'refuels.*',
            'runs.*',
            'services.*',
            'servicetypes.*'
        ],
        'noc' => [
            'gensets.index', 'gensets.view',
            'refuels.index',
            'runs.index', 'runs.start', 'runs.stop',
            'services.index',
        ],
        'manager' => [
            'gensets.index', 'gensets.view',
            'refuels.index',
            'runs.index', 'runs.start', 'runs.stop',
            'services.index',
        ],
        'mechanic' => [
            'gensets.index', 'gensets.view',
            'refuels.index', 'refuels.create',
            'runs.index', 'runs.start', 'runs.stop',
            'services.index', 'services.create',
        ],
        'fueler' => [
            'gensets.index', 'gensets.view',
            'refuels.index', 'refuels.create',
            'runs.index', 'runs.start', 'runs.stop',
            'services.index', 'services.create',
        ],
    ];
}
