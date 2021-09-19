<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $appLogo = DB::table('media')->where('custom_properties->uuid', setting('app_logo'))->first();
        if($appLogo){
            $app_logo = '/admin/main/storage/app/public/'.$appLogo->id.'/'.$appLogo->file_name;
        }else{
            $app_logo = '/images/logo.png';
        }
        View::share('app_logo', $app_logo);
    }

    
}
