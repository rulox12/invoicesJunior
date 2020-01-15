<?php


return [
    'types' => [
        0 => [
            'name' => "Customer",
            'import' => 'App\Imports\CustomersImport',
            'route' => 'customers.index',
        ],
        1 => [
            'name' => "Seller",
            'import' => 'App\Imports\SellersImport',
            'route' => 'sellers.index',
        ],
        2 => [
            'name' => "Invoice",
            'import' => 'App\Imports\InvoicesImport',
            'route' => 'invoices.index',
        ],
    ]
];
