<?php

return [
    'Control Panel' => [
        'title'    => 'Control Panel',
        'subtitle' => 'Abilities needed to interact within the control panel',
        'rules'    => [
            [
                'title'     => 'Control Panel',
                'abilities' => [
                    'cpanel:view' => 'View The Control Panel',
                ],
            ],
            [
                'title'     => 'Users',
                'abilities' => [
                    'user:viewAny'      => 'View all users',
                    'user:create'       => 'Create new user',
                    'user:update'       => 'Update user',
                    'user:delete'       => 'Suspend user',
                    'user:restore'      => 'Restore user',
                ],
            ],
        ],
    ],
];
