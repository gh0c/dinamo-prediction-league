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
];