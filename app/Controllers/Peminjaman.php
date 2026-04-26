<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;
use App\Models\AnggotaModel;
use App\Models\BukuModel;
use App\Models\PetugasModel;

class Peminjaman extends BaseController
{
    protected $peminjamanModel;

    public function __construct()
    {
        $this->peminjamanModel = new PeminjamanModel();
    }

    // =====================
    // INDEX
    // =====================
    public function index()
    {
        $data['peminjaman'] = $this->peminjamanModel->findAll();
        return view('peminjaman/index', $data);
    }

    // =====================
    // CREATE
    // =====================
    public function create()
    {
        $anggota = new AnggotaModel();
        $buku    = new BukuModel();
        $petugas = new PetugasModel();

        $data = [
            'anggota' => $anggota->findAll(),
            'buku'    => $buku->findAll(),
            'petugas' => $petugas->findAll(),
        ];

        return view('peminjaman/create', $data);


    return view('peminjaman/create', $data);
}

    // =====================
    // STORE
    // =====================
    public function store()
    {
        $id_buku = $this->request->getPost('id_buku');

        // ambil cover buku
        $bukuModel = new BukuModel();
        $buku = $bukuModel->find($id_buku);

        $tanggal_pinjam  = $this->request->getPost('tanggal_pinjam');
        $tanggal_kembali = $this->request->getPost('tanggal_kembali');

        $today = date('Y-m-d');

        $status = 'Dipinjam';
        $denda = 0;

        if ($tanggal_kembali < $today) {
            $selisih = (strtotime($today) - strtotime($tanggal_kembali)) / 86400;
            $denda = $selisih * 1000;
            $status = 'Terlambat';
        }

        $this->peminjamanModel->save([
            'id_petugas'      => $this->request->getPost('id_petugas'),
            'id_anggota'      => $this->request->getPost('id_anggota'),
            'id_buku'         => $id_buku,
            'tanggal_pinjam'  => $tanggal_pinjam,
            'tanggal_kembali' => $tanggal_kembali,
            'status'          => $status,
            'denda'           => $denda,
            'status_bayar'    => ($denda > 0 ? 'belum' : 'lunas'),
            'cover'           => $buku['cover']
        ]);

        return redirect()->to('/peminjaman');
    }

    // =====================
    // BAYAR DENDA
    // =====================
    public function bayar($id)
{
    $this->peminjamanModel->update($id, [
        'status_bayar' => 'lunas'
    ]);

    return redirect()->to('/peminjaman');
}

    // =====================
    // DELETE
    // =====================
    public function delete($id)
    {
        $this->peminjamanModel->delete($id);
        return redirect()->to('/peminjaman');
    }
    public function kembalikan($id)
{
    $db = db_connect();
    
    // 1. Ambil data peminjaman
    $pinjam = $db->table('peminjaman')->where('id_peminjaman', $id)->get()->getRowArray();
    
    if ($pinjam) {
        $tgl_kembali_seharusnya = strtotime($pinjam['tanggal_kembali']);
        $tgl_sekarang = time(); // Hari ini
        
        // 2. Hitung Denda (Misal: 1000 per hari jika terlambat)
        $denda = 0;
        if ($tgl_sekarang > $tgl_kembali_seharusnya) {
            $selisih = floor(($tgl_sekarang - $tgl_kembali_seharusnya) / (60 * 60 * 24));
            $denda = $selisih * 1000;
        }

        // 3. Simpan ke tabel pengembalian
        $db->table('pengembalian')->insert([
            'id_peminjaman'   => $id,
            'tanggal_kembali' => date('Y-m-d'),
            'denda'           => $denda
        ]);

        // 4. Update stok buku (Tambah 1 karena buku balik)
        $db->table('buku')->where('id_buku', $pinjam['id_buku'])->increment('tersedia');

        // 5. Hapus atau update status di tabel peminjaman (opsional)
        // $db->table('peminjaman')->delete(['id_peminjaman' => $id]);

        return redirect()->to('/pengembalian')->with('success', 'Buku berhasil dikembalikan!');
    }
}public function pinjamLangsung($id_buku)
{
    // 1. Ambil ID Anggota dari session login
    $id_anggota = session()->get('id_anggota');

    if (!$id_anggota) {
        return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu');
    }

    // 2. Cek apakah stok buku masih ada
    $buku = $this->db->table('buku')->where('id_buku', $id_buku)->get()->getRowArray();
    if ($buku['tersedia'] <= 0) {
        return redirect()->back()->with('error', 'Maaf, stok buku sedang habis!');
    }

    // 3. Proses Transaksi
    $this->db->transStart();

    // Simpan ke tabel peminjaman
    $this->db->table('peminjaman')->insert([
        'id_anggota'      => $id_anggota,
        'id_buku'         => $id_buku,
        'tanggal_pinjam'  => date('Y-m-d'),
        'tanggal_kembali' => date('Y-m-d', strtotime('+3 days')), // Pinjam 3 hari
        'status'          => 'dipinjam'
    ]);

    // Kurangi stok buku
    $this->db->table('buku')->where('id_buku', $id_buku)->decrement('tersedia');

    $this->db->transComplete();

    return redirect()->to('/peminjaman')->with('success', 'Buku berhasil dipinjam! Silakan ambil di perpustakaan.');
}
}