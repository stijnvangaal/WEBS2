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
        $db = Database::getDatabase();
        $data['SaleCar'] = $db->get_sale_car();
        $data['AllCars'] = $db->get_all_cars();
        return $data;
    }
}