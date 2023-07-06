<?php

return [
    'enabled' => env('RATE_LIMITING_ENABLED', true),
    'limit' => env('RATE_LIMITING_LIMIT', 100),
    'expires' => env('RATE_LIMITING_EXPIRES', 60),
];

?>