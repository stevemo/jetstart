<?php

return [
    'Control Panel' => [
        'title'    => 'Control Panel',
        'subtitle' => 'Abilities needed to interact within the control panel',
        'rules'    => [
            [
                'title'     => 'Control Panel',
                'abilities' => [
                    'cpanel.view' => 'View The Control Panel',
                ],
            ],
            [
                'title'     => 'Users',
                'abilities' => [
                    'user.viewAny'      => 'View all users',
                    'user.view'         => 'Show user',
                    'user.create'       => 'Create new user',
                    'user.update'       => 'Update user',
                    'user.delete'       => 'Delete user',
                    'user.restore'      => 'Restore user',
                ],
            ],
        ],
    ],
];
