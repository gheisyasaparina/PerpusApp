<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        // kalau belum login
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        return view('dashboard');
    }
}
