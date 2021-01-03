<?php

return [
    // Do you need users' country ?
    'with_country' => true,
    
    // How to track user , "disable", "ip", "user"
    'track_mode' => 'disable',

    // If you are using user mode and you want to track guest user
    'track_guest' => true,

    // Geo class to get ip data
    'geo_class' => \Tracker\Support\geoJs::class
];
