<?php

return [
    'games' => [
        'competition' => [
            'name'        => 'Natjecanje',
            'collection'  => 'Natjecanja',
            '_attributes' => [
                'name'  => 'Naziv natjecanja',
                'sport' => 'Sport'
            ]
        ],
        'game'        => [
            'name'        => 'Utakmica',
            'collection'  => 'Utakmice',
            'count'       => 'Utakmica',
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
            'collection'  => 'Igrači',
            '_attributes' => [
                'name' => 'Ime i prezime',
                'team' => 'Klub',
            ]
        ],
        'season'      => [
            'name'        => 'Sezona',
            'collection'  => 'Sezone',
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
            'collection'  => 'Klubovi',
            '_attributes' => [
                'name'  => 'Naziv kluba',
                'sport' => 'Sport'
            ]
        ],
    ],

    'predictions' => [
        'disqualification_reason' => [
            '_values' => [
                'inactivity' => 'Neaktivnost'
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
        'overall'              => 'Ukupni poredak',
        'round'                => 'Kolo',
        'collection_for_round' => 'Rezultati za :round. kolo',
    ],

    'users' => [
        'user' => [
            'name'        => 'Član',
            'collection'  => 'Članovi',
            '_attributes' => [
                'username' => 'Korisničko ime',
                'email'    => 'E-mail adresa',
                'settings' => [
                    'name'        => 'Postavke',
                    '_attributes' => [
                        'is_admin' => '[Admin]',
                        'is_mod'   => '[Moderator]',
                    ],
                ],
            ],
        ],
    ],
];