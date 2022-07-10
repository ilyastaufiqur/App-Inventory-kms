<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array
     */
    public $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'filterAdmin' => \App\Filters\FilterAdmin::class,
        'filterTim' => \App\Filters\FilterTim::class,
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array
     */
    public $globals = [
        'before' => [
            'filterAdmin' => [
                'except' => ['login/*', 'login', '/']
            ],
            'filterTim' => [
                'except' => ['login/*', 'login', '/']
            ],
        ],
        'after' => [
            'filterAdmin' => [
                'except' => [
                    'main/*', 'satuan/*', 'kategori/*', 'barang/*', 'barangmasuk/*', 'barangkeluar/*', 'pelanggan/*', 'suplier/*', 'laporan/*',
                    'backupdb/*', 'users/*', 'konsultasi/*', 'chat/*'
                ]
            ],
            'filterTim' => [
                'except' => ['main/*', 'pelanggan/*', 'suplier/*', 'barangmasuk/*', 'barangkeluar/*', 'backupdb/*', 'chat/*']
            ],
            'toolbar',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['csrf', 'throttle']
     *
     * @var array
     */
    public $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     *
     * @var array
     */
    public $filters = [];
}
