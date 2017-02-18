<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    protected $casts = [
            'thumbs' => 'array',
        ];

    public function category()
    {
        return $this->belongsTo('App\Category','cat_id');
    }

    public function versions(){
        return $this->hasMany('App\AppVersion', 'app_id');
    }

    public function developer()
    {
        return $this->belongsTo('App\Developer','developer_id');
    }

    public function getLastVersion()
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');
        $last = AppVersion::where('app_id', $this->id)->orderBy('version_updated','desc')->with('appfiles')->first();
        //$last = AppVersion::where('app_id', $this->id)->where('publish_at','<',$now)->orderBy('version_updated','desc')->with('appfiles')->first();

        //$last = AppVersion::where('app_id', $this->id)->orderBy('publish_at','desc')->first();
        return $last;
    }

}
