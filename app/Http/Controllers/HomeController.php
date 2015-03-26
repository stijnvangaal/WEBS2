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
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $SaleCar = auto::find(1);
        $model['SaleCar'] = $SaleCar;
        $model['AllCars'] = auto::get();
        $model['Type'] = type::find($SaleCar->ID);

        return view('index', $model);
    }

    public function about(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        return view('about');
    }

    public function Car($ID){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $Car = auto::find($ID);
        $model['Car'] = $Car;
        $model['Type'] = type::find($Car->ID);
        return view('Car', $model);
    }
}