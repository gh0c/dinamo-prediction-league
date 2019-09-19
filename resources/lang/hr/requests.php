<?php

return [
    'admin' => [
        'competition' => [
            'store'              => 'Greška kod spremanja novog natjecanja.',
            'update'             => 'Greška kod uređivanja postojećeg natjecanja.',
            'delete'             => 'Greška kod brisanja postojećeg natjecanja.',
            'successful_store'   => 'Natjecanje <strong>:competition</strong> uspješno pohranjeno.',
            'successful_update'  => 'Promjene na natjecanju <strong>:competition</strong> uspješno pohranjene.',
            'successful_destroy' => 'Natjecanje <strong>:competition</strong> uspješno isbrisano.',
        ],
        'prediction'  => [
            'store'              => 'Greška kod spremanja nove prognoze.',
            'update'             => 'Greška kod uređivanja postojeće prognoze.',
            'delete'             => 'Greška kod brisanja postojeće prognoze.',
            'filter'             => ['scorers_by_game' => 'Greška kod filtriranja strijelaca prema utakmici.'],
            'successful_store'   => 'Prognoza utakmice <strong>:home_team - :away_team</strong> za člana <strong>:user</strong> uspješno pohranjena.',
            'successful_update'  => 'Promjene na prognozi utakmice <strong>:home_team - :away_team</strong> za člana <strong>:user</strong> uspješno pohranjene.',
            'successful_destroy' => 'Prognoza utakmice <strong>:home_team - :away_team</strong> za člana <strong>:user</strong> uspješno isbrisana.',
        ],
        'season'      => [
            'store'              => 'Greška kod spremanja nove sezone.',
            'update'             => 'Greška kod uređivanja postojeće sezone.',
            'delete'             => 'Greška kod brisanja postojeće sezone.',
            'successful_store'   => 'Sezona <strong>:season</strong> uspješno pohranjena.',
            'successful_update'  => 'Promjene na sezoni <strong>:season</strong> uspješno pohranjene.',
            'successful_destroy' => 'Sezona <strong>:season</strong> uspješno isbrisana.',
        ],
        'team'        => [
            'store'              => 'Greška kod spremanja novog kluba.',
            'update'             => 'Greška kod uređivanja postojećeg kluba.',
            'delete'             => 'Greška kod brisanja postojećeg kluba.',
            'successful_store'   => 'Klub <strong>:team</strong> uspješno pohranjen.',
            'successful_update'  => 'Promjene na klubu <strong>:team</strong> uspješno pohranjene.',
            'successful_destroy' => 'Klub <strong>:team</strong> uspješno isbrisan.',
        ],
    ],
    'mod'   => [
        'game'   => [
            'store'              => 'Greška kod spremanja nove utakmice.',
            'update'             => 'Greška kod uređivanja postojeće utakmice.',
            'delete'             => 'Greška kod brisanja postojeće utakmice.',
            'successful_store'   => 'Utakmica <strong>:home_team - :away_team</strong> uspješno pohranjena.',
            'successful_update'  => 'Promjene na utakmici <strong>:home_team - :away_team</strong> uspješno pohranjene.',
            'successful_destroy' => 'Utakmica <strong>:home_team - :away_team</strong> uspješno isbrisana.',
            'result'             => [
                'update'            => 'Greška kod spremanja rezultata utakmice',
                'successful_update' => 'Rezultat utakmice <strong>:home_team - :away_team</strong> uspješno pohranjen.',
            ],
        ],
        'player' => [
            'store'              => 'Greška kod spremanja novog igrača.',
            'update'             => 'Greška kod uređivanja postojećeg igrača.',
            'delete'             => 'Greška kod brisanja postojećeg igrača.',
            'successful_store'   => 'Igrač <strong>:player</strong> uspješno pohranjen.',
            'successful_update'  => 'Promjene igrača <strong>:player</strong> uspješno pohranjene.',
            'successful_destroy' => 'Igrač <strong>:player</strong> uspješno isbrisan.',
        ],
    ],
];
