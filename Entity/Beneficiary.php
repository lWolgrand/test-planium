<?php

declare(strict_types=1);

namespace Src\Entity\Beneficiary;

use Doctrine\ORM\Mapping as ORM;

#[Entity]
#[Table('Beneficiaries')]
class Beneficiary {
    #[Id]
    #[Column, GeneratedValue]    
    private int $id;

    #[Column( name: 'name' )]
    private string $name;

    #[Column(name: 'age')]
    private Collection $age;
    
    #[OneToMany(targetEntity: Price::class, mappedBy: 'beneficiary')]
    private int $plan;

    public function __construct() 
    {
        $this->age = new ArrayCollection();
    }

    public function gedId(): int {
        return $this->id;
    }    

    public function setName(string $name): Beneficiary {
        $this->name = $name;
        return $this;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setAge(int $age): Beneficiary {
        $this->age = $age;
        return $this;
    }

    public function getAge(): int {
        return $this->age;
    }

    public function setPlan(int $plan): Beneficiary {
        $this->plan = $plan;
        return $plan;
    }

    public function getPlan(): int {
        return $this->plan;
    }

    public function __toJson(): array {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'age' => $this->age,
            'plan' => $this->plan
        ];
    }    

}
