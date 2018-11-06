<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    public $table = 'photos';

    public function album()
    {
        return $this->belongsTo('App\Album');
    }
}
