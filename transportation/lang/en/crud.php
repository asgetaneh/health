<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'New',
        'cancel' => 'Cancel',
        'attach' => 'Attach',
        'detach' => 'Detach',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'station_or_towns' => [
        'name' => 'Station Or Towns',
        'index_title' => 'StationOrTowns List',
        'new_title' => 'New Station or town',
        'create_title' => 'Create StationOrTown',
        'edit_title' => 'Edit StationOrTown',
        'show_title' => 'Show StationOrTown',
        'inputs' => [
            'name' => 'Name',
            'description' => 'Description',
        ],
    ],

    'vehicles' => [
        'name' => 'Vehicles',
        'index_title' => 'Vehicles List',
        'new_title' => 'New Vehicle',
        'create_title' => 'Create Vehicle',
        'edit_title' => 'Edit Vehicle',
        'show_title' => 'Show Vehicle',
        'inputs' => [
            'name' => 'Name',
            'plante_number' => 'Plante Number',
            'level' => 'Level',
            'total_seats' => 'Total Seats',
            'description' => 'Description',
            'diver_id' => 'Diver',
        ],
    ],

    'divers' => [
        'name' => 'Divers',
        'index_title' => 'Divers List',
        'new_title' => 'New Diver',
        'create_title' => 'Create Diver',
        'edit_title' => 'Edit Diver',
        'show_title' => 'Show Diver',
        'inputs' => [
            'full_name' => 'Full Name',
            'licence' => 'Licence',
        ],
    ],

    'routes' => [
        'name' => 'Routes',
        'index_title' => 'Routes List',
        'new_title' => 'New Route',
        'create_title' => 'Create Route',
        'edit_title' => 'Edit Route',
        'show_title' => 'Show Route',
        'inputs' => [
            'vehicle_id' => 'Vehicle',
            'departure_time' => 'Departure Time',
            'expected_arrival_time' => 'Expected Arrival Time',
            'tariff' => 'Tariff',
            'service_charge' => 'Service Charge',
            'departure_station' => 'Departure Station',
            'arrival_station' => 'Arrival Station',
            'user_id' => 'Created By',
        ],
    ],

    'tickets' => [
        'name' => 'Tickets',
        'index_title' => 'Tickets List',
        'new_title' => 'New Ticket',
        'create_title' => 'Create Ticket',
        'edit_title' => 'Edit Ticket',
        'show_title' => 'Show Ticket',
        'inputs' => [
            'route_id' => 'Route',
            'ticket_number' => 'Ticket Number',
            'customer_name' => 'Customer Name',
            'user_id' => 'User',
        ],
    ],

    'users' => [
        'name' => 'Users',
        'index_title' => 'Users List',
        'new_title' => 'New User',
        'create_title' => 'Create User',
        'edit_title' => 'Edit User',
        'show_title' => 'Show User',
        'inputs' => [
            'name' => 'Name',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'stationOrTown_id' => 'Station Or Town',
        ],
    ],

    'roles' => [
        'name' => 'Roles',
        'index_title' => 'Roles List',
        'create_title' => 'Create Role',
        'edit_title' => 'Edit Role',
        'show_title' => 'Show Role',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'permissions' => [
        'name' => 'Permissions',
        'index_title' => 'Permissions List',
        'create_title' => 'Create Permission',
        'edit_title' => 'Edit Permission',
        'show_title' => 'Show Permission',
        'inputs' => [
            'name' => 'Name',
        ],
    ],
];
