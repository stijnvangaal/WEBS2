<?php
/**
 * Created by PhpStorm.
 * User: stijn
 * Date: 23-3-2015
 * Time: 13:41
 */
namespace App\Http\Controllers;

class HomeController extends Controller{


    public function index(){
        $model = new \App\Http\Models\HomepageModel();
        $data = $model->getContent();

        return View::make('index', $data);
    }
}