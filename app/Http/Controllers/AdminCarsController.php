<?php
namespace App\Http\Controllers;

use App\auto;
use App\Type;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminCarsController extends Controller
{
	protected $auto;
	
	public function __construct(Auto $auto)
	{
		$this->auto = $auto;
	}
	
	public function index()
	{
    if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

    $action = $this->AdminCheck();
    if($action != null){return $action;}

		$autos = $this->auto->all();
		
		return view::make('Admin.CarIndex', compact('autos'));
	}

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

    $action = $this->AdminCheck();
    if($action != null){return $action;}

    $AllTypes = Type::get();
    $SortedTypes = array();

    foreach($AllTypes as $type){
      if($type['ParentId'] != NULL || $type['ParentId'] != 0)
      {
          array_push($SortedTypes, $type);
      }
    }

    return view::make('Admin.CarCreate', $SortedTypes);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */

  public function store(Request $request)
  {
    if (session_status() == PHP_SESSION_NONE) {
            session_start();
    }

    $action = $this->AdminCheck();
    if($action != null){return $action;}

    //Image uploader

    $success = 0;

    $target_dir = "Images/";
    $filename = basename($_FILES["fileToUpload"]["name"]);
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) 
    {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    
    // Check if file already exists
    if (file_exists($target_file)) 
    {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) 
    {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) 
    {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) 
    {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } 
    else 
    {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
        {
            $success = 1;
        } 
        else 
        {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    //End Image uploader
  
    if($success == 1)
    {
      $correctInput = 1;
      //$input = Input::all();
    
      //$inputAuto = array($input);

      $newAuto = new auto;

      $newAuto->Naam = $request['Naam'];
      $newAuto->BeschrijvingKort = $request['BeschrijvingKort'];
      $newAuto->BeschrijvingLang = $request['BeschrijvingLang'];
      
      if(is_numeric($request['Prijs']))
      {
        $newAuto->Prijs = $request['Prijs'];
      }
      else
      {
        $correctInput = 0;
      }
      
      if(is_numeric($request['Topsnelheid']))
      {
        $newAuto->Topsnelheid = $request['Topsnelheid'];
      }
      else
      {
        $correctInput = 0;
      }
      
      $newAuto->Kleur = $request['Kleur'];
      $newAuto->Merk = $request['Merk'];

      if(is_numeric($request['Kilometerstand']))
      {
        $newAuto->Bouwjaar = $request['Bouwjaar'];
      }
      else
      {
        $correctInput = 0;
      }

      if(is_numeric($request['Kilometerstand']))
      {
        $newAuto->Kilometerstand = $request['Kilometerstand'];
      }
      else
      {
        $correctInput = 0;
      }
      
      $newAuto->Types_ID = $request['Types_ID'];
      $newAuto->ImageUrl = $filename;

      if($correctInput == 1)
      {
        $newAuto->save();
      }
      else
      {
        return Redirect::to('Admin/AddCar')
        ->withErrors('input incorrect!');
      }

      return Redirect::to('Admin/Cars');
    }
    else
    {
      echo "Sorry, there was an error uploading your file.";
      return Redirect::to('Admin/AddCar')
        ->withErrors('Image upload failed');
    }
    

  	

	//$v = Validator::make('$input', auto::$rules);
	
	//if($v->passes())
	//{
	//	$this->auto->create(array($input));
		
  //  
	//}
	
	
  }


  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit(Request $request)
  {
    if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

    $action = $this->AdminCheck();
    if($action != null){return $action;}

    

    $editCar = auto::where('ID', '=', $request['SelectedCar']);

    if($request['SelectedCar'] != null)
    {
      return View::make('Admin.CarEdit', ['carID' => $request['SelectedCar']]);
    }
    else
    {
      return redirect()->to('Admin/Cars')
        -> withErrors('Car does not exist');
    }
  }
	

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request)
  {
    if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

    $correctInput = 1;

    if(!is_numeric($request['Prijs']))
    {
      $correctInput = 0;
    }

    if(!is_numeric($request['Topsnelheid']))
    {
      $correctInput = 0;
    }

    if(!is_numeric($request['Bouwjaar']))
    {
      $correctInput = 0;
    }

    if(!is_numeric($request['Kilometerstand']))
    {
      $correctInput = 0;
    }

    if($correctInput == 0)
    {
      return View::make('Admin.CarEdit', ['carID' => $request['ID']])
        ->withErrors('input incorrect!');
    }

    $action = $this->AdminCheck();
    if($action != null){return $action;}

    auto::where('ID', '=', $request['ID'])->update(array('Naam' => $request['Naam'], 'BeschrijvingKort' => $request['BeschrijvingKort'],
    'BeschrijvingLang' => $request['BeschrijvingLang'], 'Prijs' => $request['Prijs'], 'Topsnelheid' => $request['Topsnelheid'],
    'Kleur' => $request['Kleur'], 'Bouwjaar' => $request['Bouwjaar'], 'Kilometerstand' => $request['Kilometerstand'], 'Types_ID' => $request['Types_ID'] ));

    //Image uploader
    if(basename($_FILES["fileToUpload"]["name"]) != null)
    {
      $success = 0;

      $target_dir = "Images/";
      $filename = basename($_FILES["fileToUpload"]["name"]);
      $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
      $uploadOk = 1;
      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
      
      // Check if image file is a actual image or fake image
      if(isset($_POST["submit"])) 
      {
          $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
          if($check !== false) {
              echo "File is an image - " . $check["mime"] . ".";
              $uploadOk = 1;
          } else {
              echo "File is not an image.";
              $uploadOk = 0;
          }
      }
      
      // Check if file already exists
      if (file_exists($target_file)) 
      {
          echo "Sorry, file already exists.";
          $uploadOk = 0;
      }
      
      // Check file size
      if ($_FILES["fileToUpload"]["size"] > 500000) 
      {
          echo "Sorry, your file is too large.";
          $uploadOk = 0;
      }
      
      // Allow certain file formats
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif" ) 
      {
          echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          $uploadOk = 0;
      }
      
      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0) 
      {
          echo "Sorry, your file was not uploaded.";
      // if everything is ok, try to upload file
      } 
      else 
      {
          if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
          {
              $success = 1;
          } 
          else 
          {
              echo "Sorry, there was an error uploading your file.";
          }
      }

      auto::where('ID', '=', $request['ID'])->update(array('ImageUrl' => $filename));
    }
    //End Image uploader

    return redirect()->to('Admin/Cars');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function delete(Request $request)
  {
    if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

    $action = $this->AdminCheck();
    if($action != null){return $action;}
    
      if($request['SelectedCar'] != null)
      {
        auto::where('ID', '=', $request['SelectedCar'])->delete();
        return redirect()->to('Admin/Cars');
      }
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