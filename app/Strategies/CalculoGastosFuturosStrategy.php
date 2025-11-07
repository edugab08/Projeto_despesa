<?php

namespace App\Strategies;

use App\Models\GastoFuturo;

class CalculoGastosFuturosStrategy implements CalculoSaldoStrategy
{
    public function calcular(): float
    {
        return GastoFuturo::sum('valor_estimado');
    }
}

