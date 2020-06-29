<?php

return [
    'api_url' => trim(env('POINTER_API_URL','https://solutions-api.wemade.no'),'/'),
    'api_key' => env('POINTER_API_KEY'),
    'api_code' => env('POINTER_API_CODE'),
    'api_digest' => env('POINTER_API_DIGEST')
];
