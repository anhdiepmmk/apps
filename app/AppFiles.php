<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppFiles extends Model
{
    protected $table = "appfiles";

    protected $dates = ['lasted_download','created_at', 'updated_at'];

    public function appversion()
    {
        return $this->belongsTo('App\AppVersion','version_id');
    }
}
