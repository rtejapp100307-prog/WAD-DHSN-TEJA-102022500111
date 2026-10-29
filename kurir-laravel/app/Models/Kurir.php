<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kurir extends Model
{
    protected $table = 'kurir';

    protected $primaryKey = 'id_kurir';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'id_kurir',
        'nama_kurir',
        'no_hp',
        'jasa_pengiriman',
        'jenis_layanan',
    ];
}

