<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Email Configuration
    |--------------------------------------------------------------------------
    */
    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'noreply@cielo.com'),
        'name' => env('MAIL_FROM_NAME', 'Cielo'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Notifications
    |--------------------------------------------------------------------------
    */
    'admin_emails' => [
        'new_order' => env('ADMIN_EMAIL_NEW_ORDER', true),
        'payment_confirmed' => env('ADMIN_EMAIL_PAYMENT_CONFIRMED', true),
        'order_status_changed' => env('ADMIN_EMAIL_ORDER_STATUS', false),
    ],

    /*
    |--------------------------------------------------------------------------
    | Customer Notifications
    |--------------------------------------------------------------------------
    */
    'customer_emails' => [
        'order_confirmation' => env('CUSTOMER_EMAIL_ORDER_CONFIRMATION', true),
        'order_status_update' => env('CUSTOMER_EMAIL_ORDER_STATUS', true),
        'payment_confirmation' => env('CUSTOMER_EMAIL_PAYMENT_CONFIRMATION', true),
    ],

    /*
    |--------------------------------------------------------------------------
    | Queue Configuration
    |--------------------------------------------------------------------------
    */
    'queue' => [
        'connection' => env('NOTIFICATION_QUEUE_CONNECTION', 'database'),
        'queue' => env('NOTIFICATION_QUEUE_NAME', 'emails'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Retry Configuration
    |--------------------------------------------------------------------------
    */
    'retry' => [
        'times' => env('NOTIFICATION_RETRY_TIMES', 3),
        'delay' => env('NOTIFICATION_RETRY_DELAY', 60), // seconds
    ],

    /*
    |--------------------------------------------------------------------------
    | Rate Limiting
    |--------------------------------------------------------------------------
    */
    'rate_limit' => [
        'enabled' => env('NOTIFICATION_RATE_LIMIT_ENABLED', true),
        'max_attempts' => env('NOTIFICATION_RATE_LIMIT_MAX', 100),
        'decay_minutes' => env('NOTIFICATION_RATE_LIMIT_DECAY', 60),
    ],

    /*
    |--------------------------------------------------------------------------
    | Templates
    |--------------------------------------------------------------------------
    */
    'templates' => [
        'brand_color' => env('NOTIFICATION_BRAND_COLOR', '#2563eb'),
        'logo_url' => env('NOTIFICATION_LOGO_URL', null),
        'company_name' => env('NOTIFICATION_COMPANY_NAME', 'Cielo'),
        'company_address' => env('NOTIFICATION_COMPANY_ADDRESS', ''),
        'support_email' => env('NOTIFICATION_SUPPORT_EMAIL', 'soporte@cielo.com'),
        'support_phone' => env('NOTIFICATION_SUPPORT_PHONE', ''),
    ],

    /*
    |--------------------------------------------------------------------------
    | Testing
    |--------------------------------------------------------------------------
    */
    'testing' => [
        'enabled' => env('NOTIFICATION_TESTING_ENABLED', false),
        'test_email' => env('NOTIFICATION_TEST_EMAIL', 'test@cielo.com'),
    ],
];