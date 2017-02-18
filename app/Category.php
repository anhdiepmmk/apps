<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;

    public static function getChildCategories($id)
    {
        $categories = Category::where('parent_id','=',$id)->orderBy('ordering')->get();
        return $categories;
    }

    public function link()
    {
        return $this->hasOne('App\Link', 'cat_id');
    }

    public function getCatImage(){
        $app = App::where('cat_id', $this->id)->orderBy('numDownloads', 'desc')->first();
        if($app){
            $img = asset('storage/'.$app->path.'/60/'.$app->image);
        } else {
            $img = '';
        }

        return $img;
    }
}
