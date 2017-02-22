<?php

return [
    'dependencies' => [
        'invokables' => [
            Zend\Expressive\Router\RouterInterface::class => Zend\Expressive\Router\FastRouteRouter::class,
            App\Action\PingAction::class => App\Action\PingAction::class,
        ],
        'factories' => [
            App\Action\HomePageAction::class => App\Action\HomePageFactory::class,

            App\Action\News\ListAction::class => App\Action\News\ListFactory::class,
            App\Action\News\AddAction::class => App\Action\News\AddFactory::class,
            App\Action\News\EditAction::class => App\Action\News\EditFactory::class,
            App\Action\News\DeleteAction::class => App\Action\News\DeleteFactory::class,

        ],
    ],

    'routes' => [
        [
            'name' => 'home',
            'path' => '/',
            'middleware' => App\Action\HomePageAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'api.ping',
            'path' => '/api/ping',
            'middleware' => App\Action\PingAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'news',
            'path' => '/news',
            'middleware' => App\Action\News\ListAction::class,
            'allowed_methods' => ['GET'],
        ],
        /*[
            'name' => 'news.add',
            'path' => '/news/add',
            'middleware' => App\Action\News\AddAction::class,
            'allowed_methods' => ['GET', 'POST'],
        ],
        [
            'name' => 'news.edit',
            'path' => '/news/edit',
            'middleware' => App\Action\News\EditAction::class,
            'allowed_methods' => ['GET', 'PUT'],
        ],
        [
            'name' => 'news.delete',
            'path' => '/news/delete',
            'middleware' => App\Action\News\DeleteAction::class,
            'allowed_methods' => ['DELETE'],
        ],*/
    ],
];
