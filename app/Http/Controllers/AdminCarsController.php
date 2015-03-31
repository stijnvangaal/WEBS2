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

	$input = Input::all();
	
  $inputAuto = array($input);

  $newAuto = new auto;

  $newAuto->Naam = $request['Naam'];
  $newAuto->BeschrijvingKort = $request['BeschrijvingKort'];
  $newAuto->BeschrijvingLang = $request['BeschrijvingLang'];
  $newAuto->Prijs = $request['Prijs'];
  $newAuto->Topsnelheid = $request['Topsnelheid'];
  $newAuto->Kleur = $request['Kleur'];
  $newAuto->Merk = $request['Merk'];
  $newAuto->Bouwjaar = $request['Bouwjaar'];
  $newAuto->Kilometerstand = $request['Kilometerstand'];
  $newAuto->Types_ID = $request['Types_ID'];

  $newAuto->save();

  return Redirect::to('AdminCars');

	//$v = Validator::make('$input', auto::$rules);
	
	//if($v->passes())
	//{
	//	$this->auto->create(array($input));
		
  //  
	//}
	
	return Redirect::route('Admin.CarCreate')
		->withInput()
		->withErrors($v)
		->with('message', 'There were validation errors');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

    $auto = $this->auto->findOrFail($id);
	
	return View::make('Admin.CarShow', compact('auto'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

    $auto = $this->auto->find($id);
	
	if(is_null($auto))
	{
		return Redirect::route('Admin.CarIndex');
	}
	
	return View::make('Admin.CarEdit', compact('auto'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
    if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

    $input = array_except(Input::all(), '_method');
	   $v = Validator::make($input, auto::$rules);


	   if ($v->passes())
     {
        $auto = $this->auto->find($id);
        $auto->update($input);

        return View::make('Admin.CarShow');
     }

     return Redirect::route('Admin.CarEdit', $id)
      ->withInput()
      ->withErrors($v)
      ->with('message', 'There were validation errors.');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function delete()
  {
    if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

    $id = Input::get('id');

    $this->auto->find($id)->delete();

    return Redirect::route('Admin.CarIndex');
  }
}