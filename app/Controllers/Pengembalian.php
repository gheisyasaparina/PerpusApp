<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;
use App\Models\PengembalianModel;
use App\Models\DetailPeminjamanModel;
use App\Models\BukuModel;

class Pengembalian extends BaseController
{
    protected $peminjaman;
    protected $pengembalian;
    protected $detail;
    protected $buku;
    protected $db;

    public function __construct()
    {
        $this->peminjaman   = new PeminjamanModel();
        $this->pengembalian = new PengembalianModel();
        $this->detail       = new DetailPeminjamanModel();
        $this->buku         = new BukuModel();
        $this->db           = \Config\Database::connect();
    }

    // ================= INDEX =================
    public function index()
    {
        $data['pengembalian'] = $this->db->table('pengembalian')
            ->select('pengembalian.*, anggota.nama, buku.judul, peminjaman.tanggal_pinjam') 
            ->join('peminjaman', 'peminjaman.id_peminjaman = pengembalian.id_peminjaman')
            ->join('anggota', 'anggota.id_anggota = peminjaman.id_anggota')
            ->join('buku', 'buku.id_buku = peminjaman.id_buku')
            ->get()->getResultArray();

        return view('pengembalian/index', $data);
    }

    // ================= CREATE =================
    public function create()
    {
        // Ambil data peminjaman yang statusnya masih 'dipinjam'
        $data['peminjaman'] = $this->db->table('peminjaman')
            ->select('peminjaman.*, anggota.nama, buku.judul')
            ->join('anggota', 'anggota.id_anggota = peminjaman.id_anggota')
            ->join('buku', 'buku.id_buku = peminjaman.id_buku')
            ->where('peminjaman.status', 'dipinjam')
            ->get()
            ->getResultArray();

        return view('pengembalian/create', $data);
    }

    // ================= PROSES KEMBALI =================
    public function proses($id_peminjaman)
    {
        $this->db->transStart();

        // 1. Catat ke tabel pengembalian
        $this->pengembalian->insert([
            'id_peminjaman' => $id_peminjaman,
            'tanggal_kembali' => date('Y-m-d') // Sesuaikan nama kolom di DB mu
        ]);

        $id_pengembalian = $this->pengembalian->getInsertID();
        $pinjam = $this->peminjaman->find($id_peminjaman);

        // 2. Hitung Denda (Batas 3 hari)
        $denda = 0;
        $tgl_pinjam = strtotime($pinjam['tanggal_pinjam']);
        $batas = strtotime('+3 days', $tgl_pinjam);
        $now = time();

        if ($now > $batas) {
            $hari_telat = ceil(($now - $batas) / 86400);
            $denda = $hari_telat * 2000;
        }

        // 3. Jika ada denda, masukkan ke tabel denda
        if ($denda > 0) {
            $this->db->table('denda')->insert([
                'id_pengembalian' => $id_pengembalian,
                'jumlah_denda'    => $denda,
                'status'          => 'belum_bayar'
            ]);
        }

        // 4. Update Status Peminjaman
        $this->peminjaman->update($id_peminjaman, [
            'status' => 'kembali'
        ]);

        // 5. Update Stok Buku (Tambah 1)
        $this->db->table('buku')
                 ->where('id_buku', $pinjam['id_buku'])
                 ->increment('tersedia');

        $this->db->transComplete();

        return redirect()->to('/pengembalian')
            ->with('success', $denda > 0 
                ? "Buku dikembalikan. Denda: Rp " . number_format($denda,0,',','.') 
                : "Buku dikembalikan tepat waktu.");
    }
}