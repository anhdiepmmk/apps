<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $casts = [
        'list_app' => 'array',
    ];

    public function get5apps()
    {
        $collection = Collection::find($this->id);
        $listapps = App::whereIn('id',$collection->list_app)->take(5)->get();
        return $listapps;
    }
}
