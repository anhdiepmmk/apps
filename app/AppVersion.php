<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppVersion extends Model
{
    public $timestamps = false;

    protected $table = "appversions";

    protected $dates = ['version_updated','publish_at', 'report_at'];

    public function appfiles()
    {
        return $this->hasOne('App\AppFiles','version_id');
    }

    public function app()
    {
        return $this->belongsTo('App\App','app_id');
    }
}
