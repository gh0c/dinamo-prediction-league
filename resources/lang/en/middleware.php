<?php

return [
    'roles' => [
        'errors' => [
            'general'          => 'You don\'t have roles necessary to access that page!',
            'super_admin'      => 'You must have super_admin role to access that page!',
            'admin'            => 'You must have admin role to access that page!',
            'mod'              => 'You must have moderator role to access that page!',
            'disqualified'     => 'You must be disqualified to access that page!',
            'not_disqualified' => 'You can\'t access that page because you\'ve been disqualified!',
        ]
    ],

    'auth'  => [
        'errors' => [
            'general' => 'You must be logged in to access that page',
        ]
    ]
];
