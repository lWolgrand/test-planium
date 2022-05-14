<?php

namespace App\Http\Controllers;

class PlanController extends BaseController
{

    public function get()
    {
        $plan = file_get_contents('App/Entity/plan.json');
        $plan = json_decode($plan);
        // echo json_encode($plan);
        foreach($plan as $key => $value){
           echo $value->registro . ' - ' . $value->nome . ' - ' . $value->codigo . PHP_EOL . ' <br> ';
        }
        
    }    

}