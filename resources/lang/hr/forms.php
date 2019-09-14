<?php

return [
    'admin' => [
        'competitions' => [
            'name'           => [
                'label'       => 'Naziv natjecanja',
                'placeholder' => 'Natjecanje'
            ],
            'sport'          => [
                'label' => 'Sport',
            ],
            'featured_image' => [
                'label' => 'Logo natjecanja',
            ],
            '_submit'        => 'Spremi',
            '_headings'      => [
                'create'              => 'Dodaj novo natjecanje',
                'store'               => 'Spremi novo natjecanje',
                'update'              => 'Uredi postojeće natjecanje',
                'destroy'             => 'Izbriši natjecanje',
                'delete_confirmation' => 'Jeste li sigurni da želite izbrisati odabrano natjecanje?'
            ],
        ],
        'seasons'      => [
            'name'      => [
                'label'       => 'Naziv sezone',
                'placeholder' => 'Sezona'
            ],
            'is_active' => [
                'label' => 'Aktivna sezona?',
            ],
            '_submit'   => 'Spremi',
            '_headings' => [
                'create'              => 'Dodaj novu sezonu',
                'store'               => 'Spremi novu sezonu',
                'update'              => 'Uredi postojeću sezonu',
                'destroy'             => 'Izbriši sezonu',
                'delete_confirmation' => 'Jeste li sigurni da želite izbrisati odabranu sezonu?'
            ],
        ],
        'teams'        => [
            'name'           => [
                'label'       => 'Naziv kluba',
                'placeholder' => 'Klub'
            ],
            'sport'          => [
                'label' => 'Sport',
            ],
            'featured_image' => [
                'label' => 'Klupski grb',
            ],
            '_submit'        => 'Spremi',
            '_headings'      => [
                'create'              => 'Dodaj novi klub',
                'store'               => 'Spremi novi klub',
                'update'              => 'Uredi postojeći klub',
                'destroy'             => 'Izbriši klub',
                'delete_confirmation' => 'Jeste li sigurni da želite izbrisati odabrani klub?'
            ],
        ],
    ],
    'mod'   => [
        'games'   => [

            'home_team'         => [
                'label'       => 'Domaćin',
                'placeholder' => '- Odaberi klub'
            ],
            'away_team'         => [
                'label'       => 'Gost',
                'placeholder' => '- Odaberi klub'
            ],
            'competition'       => [
                'label'       => 'Natjecanje',
                'placeholder' => '- Odaberi natjecanje',
            ],
            'season'            => [
                'label'       => 'Sezona',
                'placeholder' => '- Odaberi sezonu',
            ],
            'round'             => [
                'label' => 'Kolo',
            ],
            'datetime'          => [
                'label' => 'Termin',
            ],
            'datetime_date'     => [
                'label' => 'Datum',
            ],
            'datetime_time'     => [
                'label' => 'Vrijeme',
            ],
            'goal_scorer'       => [
                'placeholder' => ' - Odaberi strijelca'
            ],
            'first_goal_scorer' => [
                'label' => 'Prvi gol'
            ],
            '_submit'           => 'Spremi',
            '_add_goal_scorer'  => 'Dodaj strijelca',

            '_headings' => [
                'create'              => 'Dodaj novu utakmicu',
                'store'               => 'Spremi novu utakmicu',
                'update'              => 'Uredi postojeću utakmicu',
                'destroy'             => 'Izbriši utakmicu',
                'delete_confirmation' => 'Jeste li sigurni da želite izbrisati odabranu utakmicu?',
                'result'              => [
                    'edit'   => 'Uredi rezultat utakmice',
                    'update' => 'Spremi rezultat utakmice',
                ],
            ],
        ],
        'players' => [
            'name'            => [
                'label'       => 'Ime igrača',
                'placeholder' => 'Ime igrača'
            ],
            'team'            => [
                'label'       => 'Klub',
                'placeholder' => '- Odaberi klub'
            ],
            'is_mod_approved' => [
                'title' => 'Igrač zasad nije potvrđen od strane moderatora/administratora'
            ],
            '_submit'         => 'Spremi',
            '_headings'       => [
                'create'              => 'Dodaj novog igrača',
                'store'               => 'Spremi novog igrača',
                'update'              => 'Uredi postojećeg igrača',
                'destroy'             => 'Izbriši igrača',
                'delete_confirmation' => 'Jeste li sigurni da želite izbrisati odabranog igrača?'
            ],
        ],
    ],

    '_modals' => [
        'buttons' => [
            'close'        => 'Zatvori',
            'cancel'       => 'Odustani',
            'save_changes' => 'Spremi promjene',
            'confirm'      => 'Potvrdi'
        ]
    ],
    '_toasts' => [
        'danger'  => 'Greška',
        'warning' => 'Upozorenje',
        'success' => 'Uspjeh',
        'info'    => 'Info'
    ]
];
