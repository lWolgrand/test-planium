<?php

namespace Src\Entity\Plan;

use Doctrine\ORM\Mapping as ORM;

#[Entity]
#[Table('Plans')]
class Plan {
    #[Id]
    #[Column, GeneratedValue]
    private int $id;

    #[Column(name: 'register')]
    private string $register;

    #[Column( name: 'name' )]
    private string $name;

    #[Column(name: 'code')]
    private string $price_id;
}