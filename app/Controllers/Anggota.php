<?php

namespace App\Controllers;

use App\Models\AnggotaModel;

class Anggota extends BaseController
{
    protected $anggota;

    public function __construct()
    {
        $this->anggota = new AnggotaModel();
    }

    public function index()
    {
        $data['anggota'] = $this->anggota->findAll();
        return view('anggota/index', $data);
    }
}