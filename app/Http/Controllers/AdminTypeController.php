<?php
namespace App\Http\Controllers;
use App\auto;
use App\Gebruiker;
use App\Bestelling;
use App\Type;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
class AdminTypeController extends Controller{

    public function TypeIndex(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $action = $this->AdminCheck();
        if($action != null){return $action;}

        $AllTypes = Type::get();
        $SortedTypes = array();
        foreach($AllTypes as $type){
            if($type['ParentId'] == NULL || $type['ParentId'] == 0){
                $type['children'] = $this->getChildren($type->ID, $AllTypes);
                array_push($SortedTypes, $type);
            }
        }
        $data['Types'] = $this->nested2ul($SortedTypes);

        return view('Admin.EditType', $data);
    }

    public function AddType(Request $request){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $action = $this->AdminCheck();
        if($action != null){return $action;}

        if($request['SelectedType'] != null){
            if($request['NewType'] != null){
                if(strlen($request['NewType']) > 0) {
                    $new = new Type;
                    $new->Naam = $request['NewType'];
                    $new->timestamps=false;
                    if($request['SelectedType'] != '!!!'){
                        $new->ParentId = $request['SelectedType'];
                    }
                    $new->save();
                    return redirect()->to('Admin/Types');
                }else{$error = "Geen naam voor nieuwe type gedefinieerd";}
            }else{$error = "Geen naam voor nieuwe type gedefinieerd";}
        }else{$error = "Geen type geselecteerd";}
        return redirect()->back()->withErrors([$error, 'msg']);
    }

    public function DeleteType(Request $request)
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $action = $this->AdminCheck();
        if($action != null){return $action;}

        if ($request['SelectedType'] != null) {
            if ($request['SelectedType'] != '!!!') {
                $DelType = Type::where('ID', '=', $request['SelectedType'])->get()->first();
                Type::where('ParentId', '=', $request['SelectedType'])->update(array('ParentId' => $DelType->ParentId));
                Auto::where('Types_Id', '=', $request['SelectedType'])->update(array('Types_Id' =>$DelType->ParentId));
                Type::where('ID', '=', $request['SelectedType'])->delete();
                return redirect()->to('Admin/Types');
            } else {
                $error = "Null is niet te verwijderen";
            }
        } else {
            $error = "Geen type geselecteerd";
        }
        return redirect()->back()->withErrors([$error, 'msg']);
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
                    '<li><input type="radio" name="SelectedType" value="%s">%s %s</li>',
                    $entry['ID'],
                    $entry['Naam'],
                    $this->nested2ul($entry['children'])
                );
            }
            $result[] = '</ul>';
        }

        return implode('',$result);
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