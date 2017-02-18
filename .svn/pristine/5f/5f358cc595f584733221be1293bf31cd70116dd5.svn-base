<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ApiController extends AdminController
{

    public function postPublish(Request $request)
    {
        $table = $request->table;
        $field = $request->field;
        $id = $request->id;
        $status = $request->status;
        if($status == 0){
            $pub = 1;
        }else{
            $pub = 0;
        }

        DB::table($table)->where('id', $id)->update([$field => $pub]);

        $data["published"] =  icon_active("'$table'","'$field'",$id,$pub);
        return json_encode($data);
    }

}