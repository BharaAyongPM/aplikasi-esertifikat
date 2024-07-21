<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;
    protected $table = 'kegiatan';
    protected $fillable = [
        'nama',
        'penyelenggara',
        'deskripsi',
        'tanggal',
        'logo',
        'template',
        'id_user',
        'certificate_number'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        // Attributes that should be hidden when this model is converted to an array or JSON.
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal' => 'date',  // Casts the 'tanggal' field to a date object
    ];

    /**
     * Get the user who created the kegiatan.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    /**
     * Get all certificates associated with the kegiatan.
     */
    public function certificates()
    {
        return $this->hasMany(Certificate::class, 'id_kegiatan');
    }
}
