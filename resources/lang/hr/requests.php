<?php

return [
    'admin'       => [
        'competition'      => [
            'store'              => 'Greška kod spremanja novog natjecanja.',
            'update'             => 'Greška kod uređivanja postojećeg natjecanja.',
            'delete'             => 'Greška kod brisanja postojećeg natjecanja.',
            'successful_store'   => 'Natjecanje <strong>:competition</strong> uspješno pohranjeno.',
            'successful_update'  => 'Promjene na natjecanju <strong>:competition</strong> uspješno pohranjene.',
            'successful_destroy' => 'Natjecanje <strong>:competition</strong> uspješno isbrisano.',
        ],
        'disqualification' => [
            'store'              => 'Greška kod spremanja nove diskvalifikacije.',
            'update'             => 'Greška kod uređivanja postojeće diskvalifikacije.',
            'delete'             => 'Greška kod brisanja postojeće diskvalifikacije.',
            'successful_store'   => 'Diskvalifikacija člana <strong>:user</strong> za sezonu <strong>:season</strong> uspješno pohranjena.',
            'successful_update'  => 'Promjene na diskvalifikaciji člana <strong>:user</strong> za sezonu <strong>:season</strong> uspješno pohranjene.',
            'successful_destroy' => 'Diskvalifikacija člana <strong>:user</strong> za sezonu <strong>:season</strong> uspješno isbrisana.',
        ],
        'prediction'       => [
            'store'                      => 'Greška kod spremanja nove prognoze.',
            'update'                     => 'Greška kod uređivanja postojeće prognoze.',
            'delete'                     => 'Greška kod brisanja postojeće prognoze.',
            'successful_store'           => 'Prognoza utakmice <strong>:home_team - :away_team</strong> za člana <strong>:user</strong> uspješno pohranjena.',
            'successful_update'          => 'Promjene na prognozi utakmice <strong>:home_team - :away_team</strong> za člana <strong>:user</strong> uspješno pohranjene.',
            'successful_destroy'         => 'Prognoza utakmice <strong>:home_team - :away_team</strong> za člana <strong>:user</strong> uspješno isbrisana.',
            'successful_store_for_round' => 'Prognoze utakmica za <strong>:round. kolo</strong> za člana <strong>:user</strong> uspješno pohranjene.',

            'successful_set_prediction_outcomes_for_round_in_active_season' => 'Ishodi prognoza za <strong>:round</strong>. kolo uspješno postavljeni',
        ],
        'season'           => [
            'store'              => 'Greška kod spremanja nove sezone.',
            'update'             => 'Greška kod uređivanja postojeće sezone.',
            'delete'             => 'Greška kod brisanja postojeće sezone.',
            'successful_store'   => 'Sezona <strong>:season</strong> uspješno pohranjena.',
            'successful_update'  => 'Promjene na sezoni <strong>:season</strong> uspješno pohranjene.',
            'successful_destroy' => 'Sezona <strong>:season</strong> uspješno isbrisana.',

            'active_season_not_found' => 'Aktivna sezona ne postoji!',
        ],

    ],
    'mod'         => [
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

            'games_not_found_for_round' => 'Ne postoje utakmice za odabrano kolo!',
        ],
        'player' => [
            'store'              => 'Greška kod spremanja novog igrača.',
            'update'             => 'Greška kod uređivanja postojećeg igrača.',
            'delete'             => 'Greška kod brisanja postojećeg igrača.',
            'successful_store'   => 'Igrač <strong>:player</strong> uspješno pohranjen.',
            'successful_update'  => 'Promjene igrača <strong>:player</strong> uspješno pohranjene.',
            'successful_destroy' => 'Igrač <strong>:player</strong> uspješno isbrisan.',
        ],
        'team'   => [
            'store'              => 'Greška kod spremanja novog kluba.',
            'update'             => 'Greška kod uređivanja postojećeg kluba.',
            'delete'             => 'Greška kod brisanja postojećeg kluba.',
            'successful_store'   => 'Klub <strong>:team</strong> uspješno pohranjen.',
            'successful_update'  => 'Promjene na klubu <strong>:team</strong> uspješno pohranjene.',
            'successful_destroy' => 'Klub <strong>:team</strong> uspješno isbrisan.',
        ],
    ],
    'super_admin' => [
        'user' => [
            'store'                      => 'Greška kod spremanja novog korisnika.',
            'update'                     => 'Greška kod uređivanja postojećeg korisnika.',
            'delete'                     => 'Greška kod brisanja postojećeg korisnika.',
            'successful_store'           => 'Korisnik <strong>:username</strong> uspješno pohranjen.',
            'successful_update'          => 'Promjene na korisniku <strong>:username</strong> uspješno pohranjene.',
            'successful_destroy'         => 'Korisnik <strong>:username</strong> uspješno isbrisan.',
            'change_password'            => 'Greška kod promjene lozinke.',
            'successful_password_change' => 'Promjena lozinke uspješna za korisnika <strong>:username</strong>.',
        ],
    ],
    'filters'     => [
        'filter' => [
            'scorers_by_game' => 'Greška kod filtriranja strijelaca prema utakmici.'
        ],
    ],
    'home'        => [
        'predictions' => [
            'create'                     => [
                'default_message'    => 'Greška kod otvaranja forme za unos prognoza',
                'predictions_locked' => 'Isteklo je vrijeme za unos prognoza za :round. kolo'
            ],
            'store_for_round'            => [
                'default_message'                   => 'Greška kod spremanja prognoza',
                'number_of_jokers_exceeded'         => 'Zbroj iskorištenih jokera veći je od broja jokera dostupnih u sezoni',
                'scorer_for_scoreless_game_exists'  => 'Odabir strijelca nije moguć za prognozu rezultata 0:0',
                'scorer_from_scoreless_team_exists' => 'Odabran strijelac iz ekipe za koju je prognozirano da neće zabiti gol',
                'scorer_for_game_with_joker_exists' => 'Odabir strijelca nije moguć za prognozu u kojoj je korišten joker',
                'predictions_locked'                => 'Isteklo je vrijeme za unos prognoza',
            ],
            'successful_store'           => 'Prognoza utakmice <strong>:home_team - :away_team</strong> uspješno pohranjena.',
            'successful_store_for_round' => 'Prognoze utakmica za <strong>:round. kolo</strong> uspješno pohranjene.',

        ],
    ],
    'profile'     => [
        'change_password'            => 'Greška kod promjene lozinke.',
        'password_change_mismatch'   => 'Neispravna trenutna lozinka.',
        'successful_password_change' => 'Promjena lozinke uspješna.',
    ],
];
