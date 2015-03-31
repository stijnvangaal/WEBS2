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
//      Webshop functions
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
        $data['SearchString'] = "";
        $data['AllCars'] = auto::get();
        $data['Types'] = "<div id='ShopTypeTree'>" . $this->nested2ul($SortedTypes) . "</div>";
        return view('Webshop', $data);
    }

    public function WebshopSelection($selection){
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
        foreach($AllTypes as $type){
            if($type['Naam'] == $selection){
                $selectedType = $type;
                break;
            }
        }
        $data['SearchString'] = "";
        $allCars = array();
        $selectedType['children'] = $this->getChildren($selectedType->ID, $AllTypes);
        $data['AllCars'] = $this->getChildrenCars($selectedType, $allCars);
        $data['Types'] = "<div id='ShopTypeTree'>" . $this->nested2ul($SortedTypes) . "</div>";
        return view('Webshop', $data);
    }

    public function WebshopSearch(){
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
        $data['Search'] = "";
        $data['AllCars'] = auto::get();
        $data['Types'] = "<div id='ShopTypeTree'>" . $this->nested2ul($SortedTypes) . "</div>";
        return view('WebsSearch', $data);
    }

    public function WebshopDoSearch(Request $request){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $crit =  $request['SearchCrit'];
        $data['Search'] = $crit;

        $data['AllCars'] = auto::where('Naam', 'LIKE', '%'.$crit.'%')
            ->orwhere('BeschrijvingKort', 'LIKE', '%'.$crit.'%')
            ->orwhere('BeschrijvingLang', 'LIKE', '%'.$crit.'%')
            ->orwhere('Kleur', 'LIKE', '%'.$crit.'%')
            ->orwhere('Merk', 'LIKE', '%'.$crit.'%')
            ->get();
        foreach($data['AllCars'] as $Car){
            $Car->Type = Type::find($Car['Types_ID'])['Naam'];
        }

        return view('WebsSearch', $data);
    }

    public function getChildrenCars($Type, $allCars){
        $theseCars = auto::where('Types_ID', '=', $Type['ID'])->get();
        foreach($theseCars as $car) {
            array_push($allCars, $car);
        }
        $childs = $Type['children'];
            foreach ($childs as $child) {
                $allCars = $this->getChildrenCars($child, $allCars);
            }

        return $allCars;
    }

//    get the children for the type tree
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
//    set the type tree into one string to echo
    public function nested2ul($data) {
        $result = array();

        if (sizeof($data) > 0) {

            $result[] = "<ul>";
            foreach ($data as $entry) {
                $result[] = sprintf(
                    $entry['Naam'] .
                    "<li>%s %s</li>",
                    $entry['Naam'],
                    $this->nested2ul($entry['children'])
                );
            }
            $result[] = '</ul>';
        }

        return implode('_',$result);
    }

//    cart buy stuff
    public function Cart(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $AllCars = array();
        $data['TotalPrice'] = 0;
        if(array_key_exists('CartItems',$_SESSION) && !empty($_SESSION['CartItems'])) {
            $AllCarsTemp = $_SESSION['CartItems'];
            if(count($AllCarsTemp) > 0) {
                foreach ($AllCarsTemp as $Car) {
                    $id = $Car->Auto_ID;
                    $amount = $Car->Aantal;
                    $tempCar = auto::find($id);
                    $data['TotalPrice'] += $tempCar->Prijs * $amount;
                    $tempCar->Amount = $amount;
                    array_push($AllCars, $tempCar);
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
        $add = new bestelling;
        $add->Auto_ID = $ToAdd;
        $add->Aantal = 1;
        $_SESSION['CartItems'][] = $add;
        return redirect()->to('Cart');
    }

    public function DeleteFromCart($toDelete){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        foreach($_SESSION['CartItems'] as $item){
            if($item->Auto_ID == $toDelete){
                $x = array_search($item, $_SESSION['CartItems']);
                unset($_SESSION['CartItems'][$x]);
            }
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

        $AllCarslist = array();
        $data['TotalPrice'] = 0;
        if(array_key_exists('CartItems',$_SESSION) && !empty($_SESSION['CartItems'])) {
            $AllCars = $_SESSION['CartItems'];
            foreach($AllCars as $tempCar){
                $id = $tempCar->Auto_ID;
                $Car = auto::find($id);
                $Car->Aantal = $tempCar->Aantal;
                $data['TotalPrice'] += $Car->Prijs * $Car->Aantal;
                array_push($AllCarslist,$Car);
            }
        }
        $data['AllCars'] = $AllCarslist;
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
            $temp->Auto_ID = $Car->Auto_ID;
            $temp->User_ID = $user->ID;
            $temp->Datum = date('Y-m-d H:i:s');
            $temp->Aantal = $Car->Aantal;
            $temp->timestamps=false;
            $temp->Save();
        }
        $_SESSION['CartItems'] = NULL;

        return redirect()->to('User');
    }

    public function ChangeCartAmount(Request $request){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if($request['Amount']!= null){
            foreach($_SESSION['CartItems'] as $item){
                if($item->Auto_ID == $request['ID']){
                    $x = array_search($item, $_SESSION['CartItems']);
                    unset($_SESSION['CartItems'][$x]);
                    $add = new bestelling;
                    $add->Auto_ID = $item->Auto_ID;
                    $add->Aantal = $request['Amount'];
                    $_SESSION['CartItems'][] = $add;
                }
            }
        }
        return redirect()->to('Cart');
    }

//    user stuff
    public function Login(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if(array_key_exists('CurrentUser',$_SESSION) && !empty($_SESSION['CurrentUser'])){
            return redirect()->to('User');
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
                $userPass = $user['Wachtwoord'];
                $typedPass = $request['Password'];
                $salt = $user['Salt'];
                if( hash('sha256', $typedPass . $salt)== $userPass) {
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
        if(!array_key_exists('CurrentUser',$_SESSION) || empty($_SESSION['CurrentUser'])){
            return redirect()->to('Login');
        }
        $data['User'] = $_SESSION['CurrentUser'];
        $data['Buys'] = Bestelling::where('User_ID', '=', $data['User']['ID'])->orderBy("Datum", "desc")->get();
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
        if(array_key_exists('CurrentUser',$_SESSION) && !empty($_SESSION['CurrentUser'])){
            return redirect()->to('User');
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
                    $salt = $this->generateRandomString();
                    $new->Wachtwoord = hash( 'sha256', $request['Password'].$salt);
                    $new->Salt = $salt;
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

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!./,';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}