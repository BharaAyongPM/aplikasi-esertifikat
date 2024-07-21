<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'certificate_number',
        'file',
        'phone_number',
        'qrcode',
        'id_kegiatan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'id_kegiatan');
    }
}
