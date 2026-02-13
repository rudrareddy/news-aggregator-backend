<?php

return [
    'newsapi' => [
        'key' => env('NEWSAPI_KEY'),
        'base_url' => 'https://newsapi.org/v2',
        'enabled' => env('NEWSAPI_ENABLED', true)
    ],
    
    'guardian' => [
        'key' => env('GUARDIAN_KEY'),
        'base_url' => 'https://content.guardianapis.com',
        'enabled' => env('GUARDIAN_ENABLED', true)
    ],
    
    'nytimes' => [
        'key' => env('NYTIMES_KEY'),
        'base_url' => 'https://api.nytimes.com/svc',
        'enabled' => env('NYTIMES_ENABLED', true)
    ],
    
    'fetch_schedule' => env('NEWS_FETCH_SCHEDULE', 'hourly')
];