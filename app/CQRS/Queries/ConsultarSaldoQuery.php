<?php

namespace App\CQRS\Queries;

class ConsultarSaldoQuery
{
    public string $periodo;

    public function __construct(string $periodo = 'mensal')
    {
        $this->periodo = $periodo;
    }
}

