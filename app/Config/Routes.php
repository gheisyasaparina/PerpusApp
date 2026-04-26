<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// --- CONFIG & FILTERS ---
$authFilter = ['filter' => 'auth'];
$intRole    = ['filter' => 'role:admin,petugas'];
$allRole    = ['filter' => 'role:admin,petugas,anggota'];

$routes->setAutoRoute(true);

// --- AUTH ---
$routes->get('/login', 'Auth::login');
$routes->post('/proses-login', 'Auth::prosesLogin');
$routes->get('/logout', 'Auth::logout');

// --- DASHBOARD ---
$routes->get('/', 'Home::index', $authFilter);
$routes->get('/dashboard', 'Home::index', $authFilter);

// --- MENU USERS ---
// Mengarahkan ke Controller Users (Bukan Home) agar fitur lengkap
$routes->group('users', $authFilter, function($routes) use ($intRole, $allRole) {
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

// --- MENU BUKU & MASTER DATA ---
$routes->group('buku', $authFilter, function($routes) {
    $routes->get('/', 'Buku::index');
    $routes->get('create', 'Buku::create');
    $routes->post('store', 'Buku::store');
    $routes->get('edit/(:num)', 'Buku::edit/$1');
    $routes->post('update/(:num)', 'Buku::update/$1');
    $routes->get('delete/(:num)', 'Buku::delete/$1');
    $routes->get('detail/(:num)', 'Buku::detail/$1');
    $routes->get('katalog', 'Buku::katalog');
});

// --- MASTER DATA SIMPLE ---
$routes->get('anggota', 'Anggota::index', $authFilter);
$routes->get('kategori', 'Kategori::index', $authFilter);
$routes->get('penulis', 'Penulis::index', $authFilter);

// --- MENU RAK ---
$routes->group('rak', $authFilter, function($routes) {
    $routes->get('/', 'Rak::index');
    $routes->get('create', 'Rak::create');
    $routes->post('store', 'Rak::store');
    $routes->get('edit/(:num)', 'Rak::edit/$1');
    $routes->post('update/(:num)', 'Rak::update/$1');
    $routes->get('delete/(:num)', 'Rak::delete/$1');
});

// --- TRANSAKSI PEMINJAMAN ---
$routes->group('peminjaman', $authFilter, function($routes) {
    $routes->get('/', 'Peminjaman::index');
    $routes->get('create', 'Peminjaman::create');
    $routes->post('store', 'Peminjaman::store');
    $routes->post('save', 'Peminjaman::save');
    $routes->get('delete/(:num)', 'Peminjaman::delete/$1');
    $routes->get('kembali/(:num)', 'Peminjaman::kembali/$1');
    $routes->get('detail/(:num)', 'Peminjaman::detail/$1');
    $routes->get('bayar/(:num)', 'Peminjaman::bayar/$1');
    $routes->get('pinjamLangsung/(:num)', 'Peminjaman::pinjamLangsung/$1');
});

// --- TRANSAKSI PENGEMBALIAN ---
$routes->group('pengembalian', $authFilter, function($routes) {
    $routes->get('/', 'Pengembalian::index');
    $routes->get('create', 'Pengembalian::create');
    $routes->post('proses/(:num)', 'Pengembalian::proses/$1');
    $routes->get('proses/(:num)', 'Pengembalian::proses/$1');
    $routes->post('save', 'Pengembalian::save');
    $routes->get('delete/(:num)', 'Pengembalian::delete/$1');
    $routes->get('form/(:num)', 'Pengembalian::form/$1');
});

// --- LAPORAN & SETTING ---
$routes->get('laporan', 'Laporan::index', $authFilter); // Diarahkan ke LaporanController
$routes->get('setting', 'Home::getSetting', $authFilter); // Diarahkan ke Home::getSetting

// --- BACKUP & RESTORE ---
$routes->get('/backup', 'Backup::index', $authFilter);
$routes->group('restore', $authFilter, function($routes) {
    $routes->get('/', 'Restore::index');
    $routes->post('auth', 'Restore::auth');
    $routes->get('form', 'Restore::form');
    $routes->post('process', 'Restore::process');
});