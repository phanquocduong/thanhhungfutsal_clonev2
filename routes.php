<?php
    return [
        '' => [
            'controller' => 'HomeController',
            'method' => 'index'
        ],
        'about' => [
            'controller' => 'HomeController',
            'method' => 'about'
        ],
        'contact' => [
            'controller' => 'ContactController',
            'method' => 'index'
        ],
        'register' => [
            'controller' => 'UserController',
            'method' => 'showRegister'
        ],
        'register/handle' => [
            'controller' => 'UserController',
            'method' => 'handleRegister'
        ],
        'login' => [
            'controller' => 'UserController',
            'method' => 'showLogin'
        ],
        'login/handle' => [
            'controller' => 'UserController',
            'method' => 'handleLogin'
        ],
        'logout' => [
            'controller' => 'UserController',
            'method' => 'logout'
        ],
        'verify/:code' => [
            'controller' => 'UserController',
            'method' => 'verify'
        ],
        'collection' => [
            'controller' => 'ProductController',
            'method' => 'collection'
        ],
        'collection/:id' => [
            'controller' => 'ProductController',
            'method' => 'collection'
        ],
        'products/:id' => [
            'controller' => 'ProductController',
            'method' => 'detail'
        ],
        'news' => [
            'controller' => 'NewsController',
            'method' => 'showList'
        ],
        'news/:id' => [
            'controller' => 'NewsController',
            'method' => 'detail'
        ],
        'cart' => [
            'controller' => 'CartController',
            'method' => 'index'
        ],
        'add-to-cart' => [
            'controller' => 'CartController',
            'method' => 'handleAddToCart'
        ],
        'update-cart' => [
            'controller' => 'CartController',
            'method' => 'handleUpdateCart'
        ],
        'delete-cart/:index' => [
            'controller' => 'CartController',
            'method' => 'handleDeleteCart'
        ],
        'payment' => [
            'controller' => 'PaymentController',
            'method' => 'index'
        ],
        'payment/handle' => [
            'controller' => 'PaymentController',
            'method' => 'handlePayment'
        ],
        'get-districts/:provinceid' => [
            'controller' => 'PaymentController',
            'method' => 'getDistricts'
        ],
        'get-wards/:districtid' => [
            'controller' => 'PaymentController',
            'method' => 'getWards'
        ],
        'apply-discount' => [
            'controller' => 'PaymentController',
            'method' => 'handleApplyDiscount'
        ]
    ];
?>

