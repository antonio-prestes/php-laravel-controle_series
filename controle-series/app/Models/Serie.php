<?php

namespace App\Models;

use App\Http\Requests\SeriesformRequest;
use http\Env\Request;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    protected $fillable = ['nome', 'user_id', 'cover_img'];



    public function temporadas()
    {

        return $this->hasMany(Temporada::class);
    }
}

