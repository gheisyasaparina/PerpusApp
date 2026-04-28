<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// =====================
// CONFIG & FILTERS
// =====================
$authFilter = ['filter' => 'auth'];
$intRole    = ['filter' => 'role:admin,petugas'];
$allRole    = ['filter' => 'role:admin,petugas,anggota'];

$routes->setAutoRoute(false);

// =====================
// AUTH
// =====================
$routes->get('/login', 'Auth::login');
$routes->post('/proses-login', 'Auth::prosesLogin');
$routes->get('/logout', 'Auth::logout');

// =====================
// DASHBOARD
// =====================
$routes->get('/', 'Home::index', $authFilter);
$routes->get('/dashboard', 'Home::index', $authFilter);

// =====================
// USERS
// =====================
$routes->group('users', $authFilter, function ($routes) use ($intRole, $allRole) {
    $routes->get('/', 'Users::index', $intRole);
    $routes->get('create', 'Users::create', $intRole);
    $routes->post('store', 'Users::store', $intRole);

    $routes->get('edit/(:num)', 'Users::edit/$1', $allRole);
    $routes->post('update/(:num)', 'Users::update/$1', $allRole);
    $routes->get('delete/(:num)', 'Users::delete/$1', $intRole);

    $routes->get('detail/(:num)', 'Users::detail/$1', $allRole);
    $routes->get('print', 'Users::print', $intRole);
    $routes->get('wa/(:num)', 'Users::wa/$1', $intRole);
});

// =====================
// BUKU
// =====================
$routes->group('buku', $authFilter, function ($routes) {
    $routes->get('/', 'Buku::index');
    $routes->get('create', 'Buku::create');
    $routes->post('store', 'Buku::store');

    $routes->get('edit/(:num)', 'Buku::edit/$1');
    $routes->post('update/(:num)', 'Buku::update/$1');
    $routes->get('delete/(:num)', 'Buku::delete/$1');

    $routes->get('detail/(:num)', 'Buku::detail/$1');
    $routes->get('katalog', 'Buku::katalog');
});

// =====================
// MASTER DATA
// =====================
$routes->get('anggota', 'Anggota::index', $authFilter);
$routes->get('kategori', 'Kategori::index', $authFilter);

// =====================
// PENULIS
// =====================
$routes->group('penulis', $authFilter, function ($routes) {
    $routes->get('/', 'Penulis::index');
    $routes->get('create', 'Penulis::create');
    $routes->post('store', 'Penulis::store');
});

// =====================
// RAK
// =====================
$routes->group('rak', $authFilter, function ($routes) {
    $routes->get('/', 'Rak::index');
    $routes->get('create', 'Rak::create');
    $routes->post('store', 'Rak::store');

    $routes->get('edit/(:num)', 'Rak::edit/$1');
    $routes->post('update/(:num)', 'Rak::update/$1');
    $routes->get('delete/(:num)', 'Rak::delete/$1');
});

// =====================
// PEMINJAMAN (CLEAN FIXED)
// =====================
$routes->group('peminjaman', $authFilter, function ($routes) {

    $routes->get('/', 'Peminjaman::index');

    $routes->get('create', 'Peminjaman::create');
    $routes->post('store', 'Peminjaman::store');
    $routes->post('save', 'Peminjaman::save');

    $routes->get('edit/(:num)', 'Peminjaman::edit/$1');
    $routes->post('update/(:num)', 'Peminjaman::update/$1');

    $routes->get('delete/(:num)', 'Peminjaman::delete/$1');

    $routes->get('kembali/(:num)', 'Peminjaman::kembali/$1');
    $routes->get('bayar/(:num)', 'Peminjaman::bayar/$1');
    $routes->get('detail/(:num)', 'Peminjaman::detail/$1');
    $routes->get('pinjamLangsung/(:num)', 'Peminjaman::pinjamLangsung/$1');
});

// =====================
// PENGEMBALIAN
// =====================
$routes->group('pengembalian', $authFilter, function ($routes) {
    $routes->get('/', 'Pengembalian::index');
    $routes->get('create', 'Pengembalian::create');

    $routes->get('proses/(:num)', 'Pengembalian::proses/$1');
    $routes->post('proses/(:num)', 'Pengembalian::proses/$1');

    $routes->post('save', 'Pengembalian::save');
    $routes->get('delete/(:num)', 'Pengembalian::delete/$1');
    $routes->get('form/(:num)', 'Pengembalian::form/$1');
});

// =====================
// LAPORAN & SETTING
// =====================
$routes->get('laporan', 'Laporan::index', $authFilter);
$routes->get('setting', 'Home::index', $authFilter);

// =====================
// BACKUP & RESTORE
// =====================
$routes->get('/backup', 'Backup::index', $authFilter);

$routes->group('restore', $authFilter, function ($routes) {
    $routes->get('/', 'Restore::index');
    $routes->post('auth', 'Restore::auth');
    $routes->get('form', 'Restore::form');
    $routes->post('process', 'Restore::process');
});

// =====================
// DENDA
// =====================
$routes->get('denda', 'Denda::index');
$routes->get('denda', 'Denda::index');
$routes->get('denda/create', 'Denda::create');
$routes->post('denda/store', 'Denda::store');
$routes->get('denda/edit/(:num)', 'Denda::edit/$1');
$routes->post('denda/update/(:num)', 'Denda::update/$1');
$routes->get('denda/delete/(:num)', 'Denda::delete/$1');
$routes->get('/restore', 'Backup::restore');
$routes->post('/restore/proses', 'Backup::prosesRestore');
