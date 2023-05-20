<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\City;
use App\Models\User;
use App\Traits\Menu;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    use Menu ;
    /***************** dashboard *****************/
    public function dashboard()
    {
        $countryArray   = $this->chartData(new Country);
        $cityArray      = $this->chartData(new City);
        $activeUsers    = User::where(['active' => true])->count() ; 
        $notActiveUsers = User::where(['active' => false])->count() ; 
        $menus          = $this->home() ;
        $colores        = ['info' , 'danger' , 'warning' , 'success' , 'primary'];
        
        return view('admin.dashboard.index' , compact('menus' ,'colores' , 'activeUsers' , 'notActiveUsers'  ,'countryArray' , 'cityArray' ));
    }


    public function chartData($model)
    {
        $users = $model::select('id', 'created_at')
        ->get()
        ->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('Y-m'); 
        });
        $usermcount = [];
        $userArr = [];

        foreach ($users as $key => $value) {
            $usermcount[$key] = count($value);
        }
        for($i = 1; $i <= 12; $i++){
            $d = ($i < 10 )? date('Y').'-0'.$i : date('Y').'-'.$i;
            if(!empty($usermcount[$d])){
                $userArr[] = $usermcount[$d];
            }else{
                $userArr[] = 0;
            }
        }
        return $userArr ; 

    }
}
