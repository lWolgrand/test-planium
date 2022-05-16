<?php

namespace App\Services;

class PlanService
{
    public array $solicitation;
    private array $plans;
    private array $prices;

    public function __construct(array $solicitation)
    {
        $this->fillTableOfPrices();
        $this->solicitation = $solicitation;
    }

    private function fillTableOfPrices()
    {
        $planTable = file_get_contents('App/Storage/plan.json');
        $this->plans = json_decode($planTable, true);

        $priceTable = file_get_contents('App/Storage/prices.json');
        $this->prices = json_decode($priceTable, true);

    }

    public function createProposal()
    {
        $proposal = [];
        $sol = $this->solicitation; 
              
        $plan = array_filter($this->plans, function ($plan) use ($sol): bool {
            return $plan["registro"] == $sol["plan_register"];
        });        
        $plan = reset($plan);                 
        $price = array_filter($this->prices,function($p) use ($sol,$plan): bool {
            return (int)$p["codigo"] == (int)$plan["codigo"] && (int)$p["minimo_vidas"] <= (int)$sol["beneficiary_amount"];
        });
        $proposal["plan_name"] = $plan["nome"];
        $proposal = array_merge($proposal, $this->calcPrice($sol["beneficiaries"], end($price)));
        $this->saveProposal($proposal);

        return $proposal;
    }

    public function calcPrice($beneficiaries, $prices)
    {        
        $ben = array_map(function ($b) use ($prices)
        {
            $age = (int)$b["beneficiary_age"];            
          if($age <= 17){
              return array_merge($b, array("beneficiary_price" => $prices["faixa1"]));
          }else if ($age <= 40){ 
              return array_merge($b, array("beneficiary_price" => $prices["faixa2"]));
          } 
          return array_merge($b, array("beneficiary_price" => $prices["faixa3"]));
        },$beneficiaries);        
        $totalCalc = array_reduce($ben, function ($total, $b){
            $total  +=  $b["beneficiary_price"];
            return $total;
        });        
        return [
            "total_price" =>$totalCalc,
            "beneficiaries" => $ben
        ];       
    }

    public function saveProposal($proposal)
    {
        $proposalTable = file_get_contents('App/Storage/proposal.json');
        $proposals = json_decode($proposalTable, true);

        $proposals["proposals"][] = $proposal;       
        
        file_put_contents('App/Storage/proposal.json', json_encode($proposals));
        
    }
}









// $file = fopen('App/Storage/proposal.json', 'x+');
// fwrite($file, json_encode($proposal));
// fclose($file);    

