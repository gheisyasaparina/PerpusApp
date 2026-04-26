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
}