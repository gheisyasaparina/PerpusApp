<?php

namespace App\Controllers;

use App\Models\DendaModel;
use App\Models\AnggotaModel; // ✅ TAMBAHAN

class Denda extends BaseController
{
    protected $denda;

    public function __construct()
    {
        $this->denda = new DendaModel();
    }

    public function index()
    {
        $db = db_connect();

        $data['denda'] = $db->table('denda')
            ->select('denda.*, anggota.nama as nama_anggota')
            ->join('anggota', 'anggota.id_anggota = denda.id_anggota', 'left')
            ->get()
            ->getResultArray();

        return view('denda/index', $data);
    }

    public function create()
    {
        $anggotaModel = new AnggotaModel(); // ✅ TAMBAHAN

        $data['anggota'] = $anggotaModel->findAll(); // ✅ TAMBAHAN

        return view('denda/create', $data); // ✅ FIX
    }

    public function store()
    {
        $this->denda->save([
            'id_anggota'   => $this->request->getPost('id_anggota'),
            'jumlah_denda' => $this->request->getPost('jumlah_denda'),
            'status'       => $this->request->getPost('status'),
            'keterangan'   => $this->request->getPost('keterangan'),
        ]);

        return redirect()->to('/denda')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data['denda'] = $this->denda->find($id);
        return view('denda/edit', $data);
    }

    public function update($id)
    {
        $this->denda->update($id, [
            'id_anggota'   => $this->request->getPost('id_anggota'),
            'jumlah_denda' => $this->request->getPost('jumlah_denda'),
            'status'       => $this->request->getPost('status'),
            'keterangan'   => $this->request->getPost('keterangan'),
        ]);

        return redirect()->to('/denda')->with('success', 'Data berhasil diupdate');
    }

    public function delete($id)
    {
        $this->denda->delete($id);
        return redirect()->to('/denda')->with('success', 'Data berhasil dihapus');
    }
}