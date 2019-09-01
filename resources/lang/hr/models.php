<?php

return [
    'games' => [
        'competition' => [
            'name'        => 'Natjecanje',
            '_attributes' => [
                'name'  => 'Naziv natjecanja',
                'sport' => 'Sport'
            ]
        ],
        'game'        => [
            'name'        => 'Utakmica',
            '_attributes' => [
                'home_team'   => 'Domaćin',
                'away_team'   => 'Gost',
                'datetime'    => 'Termin odigravanja',
                'competition' => 'Natjecanje',
                'season'      => 'Sezona',
                'round'       => 'Kolo',
            ]
        ],
        'player'      => [
            'name'        => 'Igrač',
            '_attributes' => [
                'name' => 'Ime i prezime',
                'team' => 'Klub',
            ]
        ],
        'season'      => [
            'name'        => 'Sezona',
            '_attributes' => [
                'name'      => 'Naziv sezone',
                'is_active' => 'Aktivna sezona'
            ]
        ],
        'team'        => [
            'name'        => 'Klub',
            '_attributes' => [
                'name'  => 'Naziv kluba',
                'sport' => 'Sport'
            ]
        ],
    ]
];