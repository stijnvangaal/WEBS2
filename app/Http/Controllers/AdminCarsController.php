<?php
namespace App\Http\Controllers;

use App\auto;
use App\Type;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;

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

    return view::make('Admin.CarCreate');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store()
  {
    if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

	$input = Input::all();
	
	$v = Validate::make('$input', auto::$rules);
	
	if($v->passes())
	{
		$this->autos->create($input);
		
		return Redirect::route('Admin.CarIndex');
	}
	
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
  public function destroy($id)
  {
    if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

    $this->auto->find($id)->delete();

    return Redirect::route('Admin.CarIndex');
  }
}