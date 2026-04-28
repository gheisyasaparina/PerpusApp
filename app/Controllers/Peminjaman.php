<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;
use App\Models\AnggotaModel;
use App\Models\BukuModel;
use App\Models\PetugasModel;
use App\Models\DendaModel;

class Peminjaman extends BaseController
{
    protected $peminjamanModel;

    public function __construct()
    {
        $this->peminjamanModel = new PeminjamanModel();
    }

    // =====================
    // INDEX + AUTO DENDA + JOIN
    // =====================
    public function index()
    {
        $db = db_connect();

        $peminjaman = $db->table('peminjaman')
            ->select('peminjaman.*, anggota.nama as nama_anggota, buku.judul as nama_buku')
            ->join('anggota', 'anggota.id_anggota = peminjaman.id_anggota')
            ->join('buku', 'buku.id_buku = peminjaman.id_buku')
            ->get()
            ->getResultArray();

        $dendaModel = new DendaModel();

        foreach ($peminjaman as $p) {

            if ($p['status'] == 'dipinjam' && strtotime($p['tanggal_kembali']) < time()) {

                $telat = floor((time() - strtotime($p['tanggal_kembali'])) / (60*60*24));
                $jumlahDenda = $telat * 1000;

                $cek = $dendaModel
                    ->where('id_anggota', $p['id_anggota'])
                    ->first();

                if (!$cek) {
                    $dendaModel->save([
                        'id_anggota'   => $p['id_anggota'],
                        'jumlah_denda' => $jumlahDenda,
                        'status'       => 'belum'
                    ]);
                }
            }
        }

        $data['peminjaman'] = $peminjaman;
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
    }

    // =====================
    // STORE
    // =====================
    public function store()
    {
        $id_buku = $this->request->getPost('id_buku');

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

    public function bayar($id)
    {
        $this->peminjamanModel->update($id, [
            'status_bayar' => 'lunas'
        ]);

        return redirect()->to('/peminjaman');
    }

    public function edit($id)
    {
        $model = new PeminjamanModel();

        $data = [
            'peminjaman' => $model->find($id)
        ];

        return view('peminjaman/edit', $data);
    }

    public function update($id)
    {
        $this->peminjamanModel->update($id, [
            'id_anggota' => $this->request->getPost('id_anggota'),
            'id_buku'    => $this->request->getPost('id_buku')
        ]);

        return redirect()->to('/peminjaman');
    }

    public function delete($id)
    {
        $this->peminjamanModel->delete($id);
        return redirect()->to('/peminjaman');
    }

    public function kembalikan($id)
    {
        $db = db_connect();

        $pinjam = $db->table('peminjaman')
            ->where('id_peminjaman', $id)
            ->get()->getRowArray();

        if ($pinjam) {

            $tgl_kembali = strtotime($pinjam['tanggal_kembali']);
            $now = time();

            $denda = 0;
            if ($now > $tgl_kembali) {
                $selisih = floor(($now - $tgl_kembali) / 86400);
                $denda = $selisih * 1000;
            }

            $db->table('pengembalian')->insert([
                'id_peminjaman'   => $id,
                'tanggal_kembali' => date('Y-m-d'),
                'denda'           => $denda
            ]);

            $db->table('buku')
                ->where('id_buku', $pinjam['id_buku'])
                ->increment('tersedia');

            return redirect()->to('/pengembalian')
                ->with('success', 'Buku berhasil dikembalikan!');
        }
    }

    public function pinjamLangsung($id_buku)
    {
        $id_anggota = session()->get('id_anggota');

        if (!$id_anggota) {
            return redirect()->to('/login')
                ->with('error', 'Silakan login terlebih dahulu');
        }

        $buku = $this->db->table('buku')
            ->where('id_buku', $id_buku)
            ->get()->getRowArray();

        if ($buku['tersedia'] <= 0) {
            return redirect()->back()
                ->with('error', 'Stok buku habis!');
        }

        $this->db->transStart();

        $this->db->table('peminjaman')->insert([
            'id_anggota'      => $id_anggota,
            'id_buku'         => $id_buku,
            'tanggal_pinjam'  => date('Y-m-d'),
            'tanggal_kembali' => date('Y-m-d', strtotime('+3 days')),
            'status'          => 'dipinjam'
        ]);

        $this->db->table('buku')
            ->where('id_buku', $id_buku)
            ->decrement('tersedia');

        $this->db->transComplete();

        return redirect()->to('/peminjaman')
            ->with('success', 'Buku berhasil dipinjam!');
    }
}