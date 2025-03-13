<?php
    return [
        '' => [
            'controller' => 'AdminCategoryController',
            'method' => 'index' 
        ],
        'categories' => [
            'controller' => 'AdminCategoryController',
            'method' => 'index'
        ],
        'categories/add' => [
            'controller' => 'AdminCategoryController',
            'method' => 'showAdd'
        ],
        'categories/add/handle' => [
            'controller' => 'AdminCategoryController',
            'method' => 'handleAdd'
        ],
        'categories/edit/:id' => [
            'controller' => 'AdminCategoryController',
            'method' => 'showEdit'
        ],
        'categories/edit/:id/handle' => [
            'controller' => 'AdminCategoryController',
            'method' => 'handleEdit'
        ],
        'categories/delete/:id' => [
            'controller' => 'AdminCategoryController',
            'method' => 'handleDelete'
        ],
        'products' => [
            'controller' => 'AdminProductController',
            'method' => 'index'
        ],
        'products/add' => [
            'controller' => 'AdminProductController',
            'method' => 'showAdd'
        ],
        'products/add/handle' => [
            'controller' => 'AdminProductController',
            'method' => 'handleAdd'
        ],
        'products/edit/:id' => [
            'controller' => 'AdminProductController',
            'method' => 'showEdit'
        ],
        'products/edit/:id/handle' => [
            'controller' => 'AdminProductController',
            'method' => 'handleEdit'
        ],
        'products/delete/:id' => [
            'controller' => 'AdminProductController',
            'method' => 'handleDelete'
        ],
        'products/variants' => [
            'controller' => 'AdminProductVariantsController',
            'method' => 'index'
        ],
        'products/variants/add' => [
            'controller' => 'AdminProductVariantsController',
            'method' => 'showAdd'
        ],
        'products/variants/add/handle' => [
            'controller' => 'AdminProductVariantsController',
            'method' => 'handleAdd'
        ],
        'products/variants/edit/:id' => [
            'controller' => 'AdminProductVariantsController',
            'method' => 'showEdit'
        ],
        'products/variants/edit/:id/handle' => [
            'controller' => 'AdminProductVariantsController',
            'method' => 'handleEdit'
        ],
        'products/variants/delete/:id' => [
            'controller' => 'AdminProductVariantsController',
            'method' => 'handleDelete'
        ],
        'news' => [
            'controller' => 'AdminNewsController',
            'method' => 'index'
        ],
        'news/add' => [
            'controller' => 'AdminNewsController',
            'method' => 'showAdd'
        ],
        'news/add/handle' => [
            'controller' => 'AdminNewsController',
            'method' => 'handleAdd'
        ],
        'news/edit/:id' => [
            'controller' => 'AdminNewsController',
            'method' => 'showEdit'
        ],
        'news/edit/:id/handle' => [
            'controller' => 'AdminNewsController',
            'method' => 'handleEdit'
        ],
        'news/delete/:id' => [
            'controller' => 'AdminNewsController',
            'method' => 'handleDelete'
        ],
        'users' => [
            'controller' => 'AdminUserController',
            'method' => 'index'
        ],
        'users/edit/:id' => [
            'controller' => 'AdminUserController',
            'method' => 'showEdit'
        ],
        'users/edit/:id/handle' => [
            'controller' => 'AdminUserController',
            'method' => 'handleEdit'
        ],
        'users/delete/:id' => [
            'controller' => 'AdminUserController',
            'method' => 'handleDelete'
        ],
        'orders' => [
            'controller' => 'AdminOrderController',
            'method' => 'index'
        ],
        'orders/edit/:id' => [
            'controller' => 'AdminOrderController',
            'method' => 'showEdit'
        ],
        'orders/edit/:id/handle' => [
            'controller' => 'AdminOrderController',
            'method' => 'handleEdit'
        ],
        'vouchers' => [
            'controller' => 'AdminVoucherController',
            'method' => 'index'
        ],
        'vouchers/add' => [
            'controller' => 'AdminVoucherController',
            'method' => 'showAdd'
        ],
        'vouchers/add/handle' => [
            'controller' => 'AdminVoucherController',
            'method' => 'handleAdd'
        ],
        'vouchers/edit/:id' => [
            'controller' => 'AdminVoucherController',
            'method' => 'showEdit'
        ],
        'vouchers/edit/:id/handle' => [
            'controller' => 'AdminVoucherController',
            'method' => 'handleEdit'
        ],
        'vouchers/delete/:id' => [
            'controller' => 'AdminVoucherController',
            'method' => 'handleDelete'
        ]
    ];
?>

