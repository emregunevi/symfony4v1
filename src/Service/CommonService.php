<?php
/**
 * Created by PhpStorm.
 * User: Emre
 * Date: 5.09.2018
 * Time: 13:56
 */

namespace App\Service;




class CommonService
{
 /**
     * @param $array
     * @param bool $exit
     * @param string $type
     */
    public function printR($array,$exit=true,$type="p"){

        echo "<pre>";

        if($type=="p"){
            print_r($array);
        }else{
            var_dump($array);
        }

        if($exit) {
            exit;
        }
    }


}