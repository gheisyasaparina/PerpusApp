<?php

namespace App\Models;

use CodeIgniter\Model;

class DendaModel extends Model
{
    protected $table = 'denda';
    protected $primaryKey = 'id_denda';

    protected $allowedFields = [
        'id_anggota',
        'jumlah_denda',
        'status',
        'keterangan'
    ];
}