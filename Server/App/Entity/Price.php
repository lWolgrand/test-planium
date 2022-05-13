<?php

namespace Src\Entity\Price;


use Doctrine\ORM\Mapping as ORM;

#[Entity]
#[Table('Prices')]
class Price {
    #[Id]
    #[Column, GeneratedValue]    
    private int $id;

    #[Column( name: 'beneficiaryId' )]
    private int $beneficiaryId;

    #[Column(name: 'min_life')]
    private int $min_life;

    #[Column(name: 'belt1')]
    private int $belt1;

    #[Column(name: 'belt2')]
    private int $belt2;

    #[Column(name: 'belt3')]
    private int $belt3;

    #[ManyToOne(inversedBy: 'plan')]
    private Beneficiary $beneficiary;





}