<?php
/**
 * Created by PhpStorm.
 * User: stijn
 * Date: 23-3-2015
 * Time: 13:41
 */
 
namespace App\Http\Controllers;

use App\auto;
use App\Nieuwsbericht;
use App\Type;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{


    public function index(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $SaleCar = auto::where('IsSale', '=' , '1')->get()->first();
        $model['SaleCar'] = $SaleCar;
        $AllCars = auto::get();
        $i = 0;
        $model['AllCars'] = array();
        foreach($AllCars as $Car){
            if($i != 4){
                array_push($model['AllCars'], $Car);
            }
            else{
                break;
            }
            $i++;
        }

        return view('index', $model);
    }

    public function about(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $about['Tekst'] = Nieuwsbericht::where('Titel', '=', 'About')->get()->first()['Bericht'];

        return view('about', $about);
    }

    public function Car($ID){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $Car = auto::find($ID);
        $model['Car'] = $Car;
        $model['Type'] = type::find($Car->Types_ID);
        return view('Car', $model);
    }

    public function BigPicture(Request $request){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $data['Image'] = $request['ImageUrl'];
        $data['Prev'] = $request['PrevUrl'];
        return view('BigPicture', $data);
    }

    public function AdminHome(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $action = $this->AdminCheck();
        if($action != null){return $action;}

        return view('Admin.AdminHome');
    }

    public function AdminAbout(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $action = $this->AdminCheck();
        if($action != null){return $action;}

        $about['Tekst'] = Nieuwsbericht::where('Titel', '=', 'About')->get()->first()['Bericht'];

        return view('Admin.AboutEdit', $about);
    }

    public function UpdateAbout(Request $request){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $action = $this->AdminCheck();
        if($action != null){return $action;}

        $about['Tekst'] = Nieuwsbericht::where('Titel', '=', 'About')->get()->first()['Bericht'];
        if($about['Tekst'] != null){
            Nieuwsbericht::where('Titel', '=', 'About')->update(Array('Bericht' => $request['About']));
        }
        else{
            $new = new Nieuwsbericht;
            $new->Titel = 'About';
            $new->Bericht = $request['About'];
            $new->timestamps=false;
            $new->save();
        }
        return redirect()->to('Admin/');
    }

    public function AdminCheck(){
        if(array_key_exists('CurrentUser',$_SESSION) && !empty($_SESSION['CurrentUser'])){
            if($_SESSION['CurrentUser']['Rol'] != 'Admin'){
                return redirect()->to('Login');
            }
            else{return null;}
        }
        else{
            return redirect()->to('Login');
        }
    }
}