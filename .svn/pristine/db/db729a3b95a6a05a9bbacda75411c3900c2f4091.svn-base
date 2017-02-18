<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    public function app()
    {
        return $this->belongsTo('App\App','app_id');
    }

    public function appversion()
    {
        return $this->belongsTo('App\AppVersion','version_id');
    }
}
