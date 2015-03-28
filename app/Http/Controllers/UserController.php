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
use App\Type;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class UserController extends Controller{

    public function Webshop(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $AllTypes = Type::get();
        $SortedTypes = array();
        foreach($AllTypes as $type){
            if($type['ParentId'] == NULL || $type['ParentId'] == 0){
                $type['children'] = $this->getChildren($type->ID, $AllTypes);
                array_push($SortedTypes, $type);
            }
        }
        $data['Types'] = $this->nested2ul($SortedTypes);
        return view('Webshop', $data);
    }

    public function getChildren($parentID, $fullList){
        $children = array();
        foreach($fullList as $type){
            if($type['ParentId'] == $parentID){
                array_push($children, $type);
                $type['children'] = $this->getChildren($type->ID, $fullList);
            }
        }
        return $children;
    }

    public function nested2ul($data) {
        $result = array();

        if (sizeof($data) > 0) {
            $result[] = '<ul>';
            foreach ($data as $entry) {
                $result[] = sprintf(
                    '<li>%s %s</li>',
                    $entry['Naam'],
                    $this->nested2ul($entry['children'])
                );
            }
            $result[] = '</ul>';
        }

        return implode($result);
    }

//    cart buy stuff
    public function Cart(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $AllCars = array();
        $data['TotalPrice'] = 0;
        if(array_key_exists('CartItems',$_SESSION) && !empty($_SESSION['CartItems'])) {
            $AllCarsID = $_SESSION['CartItems'];
            if(count($AllCarsID) > 0) {
                foreach ($AllCarsID as $CarID) {
                    $Car = auto::find($CarID);
                    $data['TotalPrice'] += $Car->Prijs;
                    array_push($AllCars, $Car);
                }
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

    public function Order(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if(!array_key_exists('CurrentUser',$_SESSION) || empty($_SESSION['CurrentUser'])){
            return redirect()->to('Login');
        }
        $data['User'] = $_SESSION['CurrentUser'];

        $AllCars = array();
        $data['TotalPrice'] = 0;
        if(array_key_exists('CartItems',$_SESSION) && !empty($_SESSION['CartItems'])) {
            $AllCarsID = $_SESSION['CartItems'];
            foreach($AllCarsID as $CarID){
                $Car = auto::find($CarID);
                $data['TotalPrice'] += $Car->Prijs;
                array_push($AllCars,$Car);
            }
        }
        $data['AllCars'] = $AllCars;
        return view('Order', $data);
    }

    public function DoCheckOut(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $user = $_SESSION['CurrentUser'];
        $AllCars = $_SESSION['CartItems'];
        foreach($AllCars as $Car){
            $temp = new Bestelling;
            $temp->Auto_ID = $Car;
            $temp->User_ID = $user->ID;
            $temp->Datum = date('Y-m-d H:i:s');
            $temp->Aantal = 1;
            $temp->timestamps=false;
            $temp->Save();
        }
        $_SESSION['CartItems'] = NULL;

        return redirect()->to('User');
    }

//    user stuff
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

    public Function Register(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        return view('Register');
    }

    public Function DoRegister(Request $request){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $user = Gebruiker::Where('Naam', '=', $request['UserName'])->get()->first();
        if($user == NULL) {
            if($request['Password'] == $request['TestPassword']){
                if(strlen($request['UserName']) >= 4 && strlen($request['UserName']) < 17){
                    $new = new gebruiker;
                    $new->Naam = $request['UserName'];
                    $new->Wachtwoord = $request['Password'];
                    $new->timestamps=false;
                    $new->Rol='Gebruiker';
                    $new->Save();
                    $user = Gebruiker::Where('Naam', '=', $request['UserName'])->get()->first();
                    $_SESSION['CurrentUser'] = $user;
                    return redirect()->to('User');
                }
                else{$Error = "De grootte van je gebruikersnaam is niet toegstaan";}
            }
            else{ $Error = "De wachtwoorden komen niet overheen";}
        }
        else{ $Error = "Deze gebruikers naam bestaat al"; }
        return redirect()->back()->withErrors([$Error, 'msg']);
    }
}