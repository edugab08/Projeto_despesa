<?php

namespace App\Services;

use App\Strategies\CalculoSaldoStrategy;

class CalculadoraDeSaldo
{
    private CalculoSaldoStrategy $strategy;

    public function __construct(CalculoSaldoStrategy $strategy)
    {
        $this->strategy = $strategy;
    }

    public function calcular(): float
    {
        return $this->strategy->calcular();
    }
}

