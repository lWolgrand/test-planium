<?php

namespace App\Http\Controllers;

class PricesController extends BaseController
{

    public function get()
    {
        $prices = file_get_contents('App/Entity/prices.json');
        $prices = json_decode($prices);
        // echo json_encode($prices);
        foreach($prices as $key => $value){
           echo $value->codigo . ' - ' . $value->minimo_vidas . ' - ' . $value->faixa1 . ' - ' . $value->faixa2 . ' - ' . $value->faixa3 . PHP_EOL . ' <br> ';
        }
        
    }    

}
