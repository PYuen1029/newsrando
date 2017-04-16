<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Frontpage extends Model
{
    public function newsSources()
    {
        return $this->belongsTo('App\NewsSource');
    }
}
