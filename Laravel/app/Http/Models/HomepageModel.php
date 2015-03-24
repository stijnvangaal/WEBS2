<?php
/**
 * Created by PhpStorm.
 * User: stijn
 * Date: 23-3-2015
 * Time: 13:10
 */
namespace App\Http\Models;


use database\Database;

class HomepageModel{

    function getContent(){
        /*$db = new \database\Database();
        $data['SaleCar'] = $db->get_sale_car();
        $data['AllCars'] = $db->get_all_cars();*/
        $data['SaleCar'] = Database::get_saleCar();
        return $data;
    }
}