<?php
/**
 * Created by PhpStorm.
 * User: stijn
 * Date: 25-3-2015
 * Time: 15:54
 */
namespace App\Http\Controllers;
use App\auto;
use App\Gebruiker;
use App\Bestelling;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class UserController extends Controller{

    public function Cart(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if(!array_key_exists('CurrentUser',$_SESSION) || empty($_SESSION['CurrentUser'])){
            return redirect()->to('Login');
        }
        $data['User'] = $_SESSION['CurrentUser'];
        $AllCars = array();
        if(array_key_exists('CartItems',$_SESSION) && !empty($_SESSION['CurrentUser'])) {
            $AllCarsID = $_SESSION['CartItems'];
            foreach($AllCarsID as $CarID){
                array_push($AllCars,auto::find($CarID));
            }
        }
        $data['AllCars'] = $AllCars;
        return view('ShopCart', $data);
    }

    public function AddToCart($ToAdd){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['CartItems'][] = $ToAdd;
        return redirect()->to('Cart');
    }

    public function DeleteFromCart($toDelete){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if(($key = array_search($toDelete, $_SESSION['CartItems'])) !== false) {
            unset($_SESSION['CartItems'][$key]);
        }
        return redirect()->to('Cart');
    }

    public function Login(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        return view('Login');
    }

    public function DoLogin(Request $request){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $user = Gebruiker::Where('Naam', '=', $request['UserName'])->get()->first();
        if($user !=NULL){
            if($user['Naam'] == $request['UserName']){
                if($user['Wachtwoord'] == $request['Password']) {
                    $_SESSION['CurrentUser'] = $user;
                    return redirect()->to('User');
                }
                else{
                    $Error = "Onjuist wachtwoord";
                }
            }
            else{ $Error = "Deze gebruiker bestaat niet";}
        }
        else{$Error = "Deze gebruiker bestaat niet";}
        return redirect()->back()->withErrors([$Error, 'msg']);
    }

    public function DoLogOut(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['CurrentUser'] = NULL;

        return redirect()->to('/');
    }

    public function UserPage(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $data['User'] = $_SESSION['CurrentUser'];
        $data['Buys'] = Bestelling::where('User_ID', '=', $data['User']['ID'])->get();
        if($data['Buys'] != NULL){
//            $cars = array();
            foreach($data['Buys'] as $Car){
                $Car->Car = auto::where('ID', '=', $Car['Auto_ID'])->get()->first();
            }
//            $data['Buys'] = $cars;
        }
        return view('UserPage', $data);
    }
}