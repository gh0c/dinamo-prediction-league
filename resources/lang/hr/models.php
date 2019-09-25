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
                'result'      => [
                    'name' => 'Rezultat'
                ]
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
        'sport'       => [
            '_values' => [
                'football' => 'Nogomet',
                'futsal'   => 'Futsal'
            ]
        ],
        'team'        => [
            'name'        => 'Klub',
            '_attributes' => [
                'name'  => 'Naziv kluba',
                'sport' => 'Sport'
            ]
        ],
    ],

    'predictions' => [
        'disqualification_reason' => [
            '_values' => [
                'inactivity' => 'Nema aktivnosti'
            ],
        ],
        'disqualification'        => [
            'name'        => 'Diskvalifikacija',
            'collection'  => 'Diskvalifikacije',
            '_attributes' => [
                'user'   => 'Član',
                'season' => 'Sezona',
                'reason' => 'Razlog diskvalifikacije',
            ]
        ],
        'prediction'              => [
            'name'                 => 'Prognoza',
            'collection'           => 'Prognoze',
            'collection_for_round' => 'Prognoze za :round. kolo',
            '_attributes'          => [
                'home_team_score' => 'Domaćin',
                'away_team_score' => 'Gost',
                'user'            => 'Član',
                'game'            => [
                    'name'  => 'utakmica',
                    'round' => 'Kolo',
                ],
                'points'          => 'Bodovi',
                'bonus_points'    => 'Bonus',
                'total_points'    => 'Ukupno',
                'jokers_used'     => 'Jokera',
            ]
        ],
    ],

    'results' => [
        'overall' => 'Ukupni poredak'
    ],
];