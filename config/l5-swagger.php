<?php

return [
    'default' => 'api',
    'documentations' => [
        'api' => [
            'api' => [
                'title' => env('APP_NAME', 'My API'),
            ],
            'routes' => [
                'api' => 'api/documentation',
            ],
            'paths' => [
                'docs_json' => 'api-docs.json',
                'docs_yaml' => 'api-docs.yaml',
                'annotations' => [
                    base_path('app'),
                ],
            ],
        ],
    ],
    'generate_always' => true,
    'swagger_version' => '3.0',
    'security' => [],
];
