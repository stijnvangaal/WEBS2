<?php
namespace Database;

class Database
{
    private $link;
    static $database;

    function __construct()
    {

        $this->link = mysqli_connect("localhost", "root", "")
        or die ("Can't connect to MySQL Server!");
        $db = mysqli_select_db($this->link, "webs2autodb") or die("Kan database niet selecteren!");
    }

//get car functions
    FUNCTION get_sale_car()
    {
        $query = "SELECT * FROM auto LIMIT 1";
        $result = mysqli_query($this->link, $query);

        return mysqli_fetch_array($result);
    }

    FUNCTION get_all_cars()
    {
        $query = "SELECT * FROM auto";
        return mysqli_query($this->link, $query);
    }

    static function getDatabase(){
        if(Database::$database == null){
            Database::$database = new Database();
        }
        return Database::$database;
    }
}

FUNCTION get_sale_car()
{
    $query = "SELECT * FROM auto LIMIT 1";
    $result = mysqli_query($this->link, $query);

    return mysqli_fetch_array($result);
}