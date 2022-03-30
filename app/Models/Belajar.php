<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Belajar extends Model
{
    use HasFactory;

     protected $fillable = [
        'kd_pengajar',
        'nama',
        'email',
        'alamat',
    ];

   public function datajoin(){
      return $this->belongsTo(Pengajar::class, 'id');
   }
}
