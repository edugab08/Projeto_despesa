<?php

namespace App\Strategies;

use App\Models\Transacao;
use Carbon\Carbon;

class CalculoAnualStrategy implements CalculoSaldoStrategy
{
    public function calcular(): float
    {
        $inicioAno = Carbon::now()->startOfYear();
        $fimAno = Carbon::now()->endOfYear();

        return Transacao::whereBetween('created_at', [$inicioAno, $fimAno])->sum('valor');
    }
}

