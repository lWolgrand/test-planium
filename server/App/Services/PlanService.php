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

    public function createProposal(): array
    {
        $proposal = [];
        $sol = $this->solicitation;
        $plan = array_filter($this->plans, function ($plan) use ($sol): bool {
            return $plan["registro"] == $sol["plan_register"];
        });
        $plan = $plan[0];
        $price = array_filter($this->prices,function($p) use ($sol,$plan): bool {
            return $p["codigo"] = $plan["codigo"] && $p["minimo_vidas"] <= $sol["beneficiary_amount"];
        });
        $proposal["plan_name"] = $plan["nome"];
//        $proposal[] = explode();

        return $this->calcPrice($sol["beneficiaries"], $price);

    }

    public function calcPrice($beneficiaries, $prices): array
    {
        $ben = array_map(function ($b) use ($prices){
            $b["beneficiary_age"]*2;
//           if( $b["beneficiary_age"] <= 17){
//               $b["beneficiary_price"] = $prices["faixa1"];
//           }else if ($b["beneficiary_age"] <= 40){
//               $b["beneficiary_price"] = $prices["faixa2"];
//           } else {
//               $b["beneficiary_price"] = $prices["faixa3"];
//           }
        }, $beneficiaries);
        $totalCalc = array_reduce($beneficiaries, function ($total, $b){
            $total +=  $b["beneficiary_price"];
            return $total;
        });
        return $beneficiaries;
//        return [
//            "total_price" =>$totalCalc,
//            "beneficiaries" => $beneficiaries
//        ];
    }

}