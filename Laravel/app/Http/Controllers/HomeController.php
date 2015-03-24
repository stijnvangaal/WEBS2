<?php
/**
 * Created by PhpStorm.
 * User: stijn
 * Date: 23-3-2015
 * Time: 13:41
 */
 
namespace App\Http\Controllers;

use App\auto;
use App\Type;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{


    public function index(){
        $model['SaleCar'] = auto::find(1);
        $model['AllCars'] = auto::get();
        $model['Type'] = type::find(1);

        return view('index', $model);
    }
}