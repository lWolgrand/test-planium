<?php

namespace App\Services;

class PlanService
{
    private array $solicitation;
    private array $plans;
    private array $prices;    
    
    public function __construct(Array $solicitation)
    {
        $this->fillTableOfPrices();
        $this->solicitation = $solicitation;
    }

    private function fillTableOfPrices()
    {
        $planTable = file_get_contents('App/Storage/plan.json');
        $this->plan = json_decode($planTable, true); 
        
        $priceTable = file_get_contents('App/Storage/prices.json');
        $this->prices = json_decode($priceTable, true); 
        
    }
    
    public function createProposal()
    {
        
       return sizeof($this->solicitation);        
        
    }
}