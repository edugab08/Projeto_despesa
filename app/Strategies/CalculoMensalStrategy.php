<?php

namespace App\Strategies;

use App\Models\Transacao;
use Carbon\Carbon;

class CalculoMensalStrategy implements CalculoSaldoStrategy
{
    public function calcular(): float
    {
        $inicioMes = Carbon::now()->startOfMonth();
        $fimMes = Carbon::now()->endOfMonth();

        return Transacao::whereBetween('created_at', [$inicioMes, $fimMes])->sum('valor');
    }
}

