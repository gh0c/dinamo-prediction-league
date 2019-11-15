<?php

return [
    'profile' => [
        'index' => [
            'title'                   => 'Moj profil - :username',
            'user_card'               => [
                'admin'            => 'Admin',
                'mod'              => 'Mod',
                '_label'           => 'Aktualna sezona',
                'ranking'          => [
                    '_label' => 'Poredak',
                ],
                'points'           => [
                    '_label' => 'Bodovi',
                ],
                'remaining_jokers' => [
                    '_label' => 'Preostalo jokera',
                ],
            ],
            'results_card'            => [
                '_label' => 'Rezultati',
                'links'  => [
                    'overall_results'  => [
                        '_label' => 'Ukupno',
                    ],
                    'results_by_round' => [
                        '_label' => 'Po kolima',
                    ],
                ]
            ],
            'no_stats'                => 'Nema rezultata za aktualnu sezonu',
            'disqualified'            => 'Diskvalificirani ste za aktualnu sezonu',
            'disqualification_reason' => 'Razlog diskvalifikacije',
            'card_links'              => [
                'password_change' => [
                    'label' => 'Promjena lozinke',
                ],
            ],
        ],
    ],

    'dashboard' => [
        'no_rounds_for_season' => [
            '_label' => 'Nema kola za aktualnu sezonu'
        ],
        'next_round'           => [
            'card'   => [
                '_label' => 'Sljedeće kolo',
            ],
            'button' => [
                'add_predictions_for_round' => [
                    '_title' => 'Unos prognoza za :round. kolo'
                ]
            ],
        ],
        'current_round'        => [
            'card' => [
                '_label' => 'Aktualno kolo',
            ],
        ],
        'previous_round'       => [
            'card'   => [
                '_label' => 'Prošlo kolo',
            ],
            'button' => [
                'show_round_results' => [
                    '_title' => 'Pregled rezultata za :round. kolo'
                ]
            ],
        ],
    ],

    'home' => [
        'prediction' => [
            'prediction'         => [
                '_label' => 'Prognoza',
            ],
            'points'             => [
                '_label' => 'Bodovi:'
            ],
            'total_round_points' => [
                '_label' => 'Bodovi:'
            ],
            'no_prediction'      => [
                '_label' => 'Nemaš prognozu za ovu utakmicu!'
            ]
        ],
    ]
];