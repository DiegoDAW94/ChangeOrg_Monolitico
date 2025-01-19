<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    public function peticiones(){
        return $this->belongsTo('App\Models\Peticione');
    }
}
