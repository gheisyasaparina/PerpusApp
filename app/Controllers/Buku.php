<?php

namespace App\Controllers;

use App\Models\BukuModel;

class Buku extends BaseController
{
    protected $buku;
    protected $db;

    public function __construct()
    {
        $this->buku = new BukuModel();
        $this->db = db_connect();
    }

    // ================= INDEX =================
    public function index()
    {
        $keyword = $this->request->getGet('keyword');

        return view('buku/index', [
            'buku' => $this->buku->getBuku($keyword)
        ]);
    }

    // ================= CREATE =================
    public function create()
    {
        return view('buku/create', [
            'kategori' => $this->db->table('kategori')->get()->getResultArray(),
            'penulis'  => $this->db->table('penulis')->get()->getResultArray(),
            'penerbit' => $this->db->table('penerbit')->get()->getResultArray(),
            'rak'      => $this->db->table('rak')->get()->getResultArray(),
        ]);
    }

    // ================= STORE =================
    public function store()
    {
        // Logika upload file
        $file = $this->request->getFile('cover');
        $namaFile = '';
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $namaFile = $file->getRandomName();
            $file->move('uploads/buku', $namaFile);
        }

        // Simpan data ke database
        $this->buku->insert([
            'isbn'         => $this->request->getPost('isbn'),
            'judul'        => $this->request->getPost('judul'),
            'id_kategori'  => $this->request->getPost('id_kategori'),
            'id_penulis'   => $this->request->getPost('id_penulis'),
            'id_penerbit'  => $this->request->getPost('id_penerbit'),
            'id_rak'       => $this->request->getPost('id_rak'), 
            'tahun_terbit' => $this->request->getPost('tahun_terbit'),
            'jumlah'       => $this->request->getPost('jumlah'),
            'tersedia'     => $this->request->getPost('jumlah'),
            'deskripsi'    => $this->request->getPost('deskripsi'),
            'cover'        => $namaFile
        ]);

        return redirect()->to('/buku')->with('success', 'Data berhasil ditambahkan');
    }

    // ================= EDIT =================
    public function edit($id)
    {
        return view('buku/edit', [
            'buku' => $this->buku->find($id),
            'kategori' => $this->db->table('kategori')->get()->getResultArray(),
            'penulis'  => $this->db->table('penulis')->get()->getResultArray(),
            'penerbit' => $this->db->table('penerbit')->get()->getResultArray(),
            'rak'      => $this->db->table('rak')->get()->getResultArray(),
        ]);
    }

    // ================= UPDATE =================
    public function update($id)
    {
        $buku = $this->buku->find($id);

        $file = $this->request->getFile('cover');
        $namaFile = $buku['cover'];

        if ($file && $file->isValid() && !$file->hasMoved()) {
            if (!empty($namaFile) && file_exists(FCPATH . 'uploads/buku/' . $namaFile)) {
                unlink(FCPATH . 'uploads/buku/' . $namaFile);
            }

            $namaFile = $file->getRandomName();
            $file->move('uploads/buku', $namaFile);
        }

        $lama = (int)$buku['jumlah'];
        $baru = (int)$this->request->getPost('jumlah');

        $this->buku->update($id, [
            'isbn' => $this->request->getPost('isbn'),
            'judul' => $this->request->getPost('judul'),
            'id_kategori' => $this->request->getPost('id_kategori'),
            'id_penulis' => $this->request->getPost('id_penulis'),
            'id_penerbit' => $this->request->getPost('id_penerbit'),
            'id_rak' => $this->request->getPost('id_rak'), 
            'tahun_terbit' => $this->request->getPost('tahun_terbit'),
            'jumlah' => $baru,
            'tersedia' => $buku['tersedia'] + ($baru - $lama),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'cover' => $namaFile
        ]);

        return redirect()->to('/buku')->with('success', 'Data berhasil diupdate');
    }

    // ================= DELETE =================
    public function delete($id)
    {
        $buku = $this->buku->find($id);

        if (!empty($buku['cover'])) {
            $file = FCPATH . 'uploads/buku/' . $buku['cover'];
            if (file_exists($file)) {
                unlink($file);
            }
        }

        $this->buku->delete($id);

        return redirect()->to('/buku')->with('success', 'Data berhasil dihapus');
    }

    // ================= DETAIL =================
    public function detail($id)
    {
        $buku = $this->db->table('buku')
            ->select('buku.*, kategori.nama_kategori, penulis.nama_penulis, penerbit.nama_penerbit, rak.nama_rak')
            ->join('kategori', 'kategori.id_kategori = buku.id_kategori', 'left')
            ->join('penulis', 'penulis.id_penulis = buku.id_penulis', 'left')
            ->join('penerbit', 'penerbit.id_penerbit = buku.id_penerbit', 'left')
            ->join('rak', 'rak.id_rak = buku.id_rak', 'left') 
            ->where('buku.id_buku', $id)
            ->get()->getRowArray();

        return view('buku/detail', ['buku' => $buku]);
    }

    // ================= PRINT =================
    public function print()
    {
        return view('buku/print', [
            'buku' => $this->buku->getBuku()
        ]);
    }

    // ================= WA =================
    public function wa($id)
    {
        $b = $this->db->table('buku')
            ->select('buku.*, rak.nama_rak')
            ->join('rak', 'rak.id_rak = buku.id_rak', 'left') 
            ->where('buku.id_buku', $id)
            ->get()->getRowArray();

        $pesan = "DATA BUKU\n\n";
        $pesan .= "Judul: {$b['judul']}\n";
        $pesan .= "Rak: {$b['nama_rak']}\n";

        return redirect()->to("https://wa.me/6285175017991?text=" . urlencode($pesan));
    }public function katalog()
{
    $db = \Config\Database::connect();
    // Ambil semua buku yang stoknya masih ada
    $data['buku'] = $db->table('buku')->where('tersedia >', 0)->get()->getResultArray();
    
    return view('buku/katalog', $data);
}
}