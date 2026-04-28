<?php

namespace App\Controllers;

use App\Models\PenulisModel;

class Penulis extends BaseController
{
    protected $penulis;

    public function __construct()
    {
        $this->penulis = new PenulisModel();
    }

    public function index()
    {
        $data['penulis'] = $this->penulis->findAll();
        return view('penulis/index', $data);
    }

    // 🔥 TAMBAH INI
    public function create()
    {
        return view('penulis/create');
    }

    public function store()
    {
        $this->penulis->save([
            'nama_penulis' => $this->request->getPost('nama_penulis')
        ]);

        return redirect()->to('/penulis');
    }
}