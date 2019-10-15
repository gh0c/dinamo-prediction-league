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
            'card' => [
                '_label' => 'Sljedeće kolo',
            ],
        ],
        'current_round'        => [
            'card' => [
                '_label' => 'Aktualno kolo',
            ],
        ],
        'previous_round'       => [
            'card' => [
                '_label' => 'Prošlo kolo',
            ],
        ],
    ],
];