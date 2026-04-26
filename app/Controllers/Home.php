<?php

namespace App\Controllers;

class Home extends BaseController
{
    protected $db;

    public function __construct()
    {
        // Memuat database secara otomatis saat controller dipanggil
        $this->db = \Config\Database::connect();
    }

    // 1. Dashboard
    public function index() 
    {
        $data = [
            'total_buku'    => $this->db->table('buku')->countAllResults(),
            'total_anggota' => $this->db->table('anggota')->countAllResults(),
            'total_pinjam'  => $this->db->table('peminjaman')->where('status', 'dipinjam')->countAllResults(),
            'total_kembali' => $this->db->table('peminjaman')->where('status', 'kembali')->countAllResults(),
            'title'         => 'Dashboard'
        ];
        return view('layouts/dashboard', $data);
    }

    // 2. Users (Pastikan nama method ini dipanggil di Routes.php)
    public function getUsers() 
    {
        $data = [
            'users' => $this->db->table('users')->get()->getResultArray(),
            'title' => 'Data Users'
        ];
        return view('users/index', $data);
    }

    // 3. Anggota
    public function getAnggota() 
    {
        $data = [
            'anggota' => $this->db->table('anggota')->get()->getResultArray(),
            'title'   => 'Data Anggota'
        ];
        return view('anggota/index', $data);
    }

    // 4. Buku
    public function getBuku() 
    {
        $data = [
            'buku'  => $this->db->table('buku')->get()->getResultArray(),
            'title' => 'Data Buku'
        ];
        return view('buku/index', $data);
    }

    // 5. Rak
    public function getRak() 
    {
        $data = [
            'rak'   => $this->db->table('rak')->get()->getResultArray(),
            'title' => 'Data Rak'
        ];
        return view('rak/index', $data);
    }

    // 6. Kategori
    public function getKategori() 
    {
        $data = [
            'kategori' => $this->db->table('kategori')->get()->getResultArray(),
            'title'    => 'Data Kategori'
        ];
        return view('kategori/index', $data);
    }

    // 7. Laporan & Setting
    public function getLaporan() 
    { 
        $data['title'] = 'Laporan';
        return view('laporan/index', $data); 
    }

    public function getSetting() 
    { 
        $data['title'] = 'Setting';
        return view('setting/index', $data); 
    }
}