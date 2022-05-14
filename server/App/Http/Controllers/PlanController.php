<?php

namespace App\Http\Controllers;
use App\Services\PlanService;

class PlanController extends BaseController
{

    public function post()
    {
        $planService = new PlanService($this->getPost());
        http_response_code(200);
        echo json_encode(["proposal" => $planService->createProposal()]);       
    } 
    
    public function get()
    {
        http_response_code(200);
        echo json_encode(['message' => 'Hello World!']);
    }

}