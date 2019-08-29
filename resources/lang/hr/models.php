<?php

return [
    'games' => [
        'competition'   => [
            'name'        => 'Natjecanje',
            '_attributes' => [
                'name'  => 'Naziv natjecanja',
                'sport' => 'Sport'
            ]
        ],
        'player' => [
            'name'        => 'Igrač',
            '_attributes' => [
                'name'      => 'Ime i prezime',
                'team'      => 'Klub',
            ]
        ],
        'season' => [
            'name'        => 'Sezona',
            '_attributes' => [
                'name'      => 'Naziv sezone',
                'is_active' => 'Aktivna sezona'
            ]
        ],
        'team'   => [
            'name'        => 'Klub',
            '_attributes' => [
                'name'  => 'Naziv kluba',
                'sport' => 'Sport'
            ]
        ],
    ]
];