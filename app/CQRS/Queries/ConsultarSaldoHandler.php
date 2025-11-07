<?php

namespace App\CQRS\Queries;

use App\Services\CalculadoraDeSaldo;
use App\Strategies\CalculoMensalStrategy;
use App\Strategies\CalculoAnualStrategy;
use App\Strategies\CalculoGastosFuturosStrategy;

class ConsultarSaldoHandler
{
    public function handle(ConsultarSaldoQuery $query): float
    {
        switch ($query->periodo) {
            case 'anual':
                $strategy = new CalculoAnualStrategy();
                break;
            case 'futuro':
                $strategy = new CalculoGastosFuturosStrategy();
                break;
            default:
                $strategy = new CalculoMensalStrategy();
        }

        $calculadora = new CalculadoraDeSaldo($strategy);
        return $calculadora->calcular();
    }
}

