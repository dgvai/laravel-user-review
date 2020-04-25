<?php 

    return [
        /*
        |--------------------------------------------------------------------------
        | STAR NUMBER OF THE SYSTEM
        |--------------------------------------------------------------------------
        | By default this package uses 5 star based rating system
        | for your project.
        | However, you can change it.
        |
        */

        'star' => env('SYSTEM_RATING_STAR_COUNT', 5),

        /*
        |--------------------------------------------------------------------------
        | DEFAULT FAKE STAR
        |--------------------------------------------------------------------------
        | If you want to show fake star by default for 0 ratings product
        | for your project.
        | You can set it here.
        |
        */

        'fake' => [
            'enabled' => false,
            'star' => 5,
        ]
        
    ];