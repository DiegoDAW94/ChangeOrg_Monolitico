<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Peticione;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function peticiones(){
        return $this->hasMany('App\Models\Peticione');
    }
}
