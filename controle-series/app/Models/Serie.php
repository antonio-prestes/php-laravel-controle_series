<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
 protected $fillable = ['nome','user_id'];

 public function temporadas(){
     return $this->hasMany(Temporada::class);
 }
}

