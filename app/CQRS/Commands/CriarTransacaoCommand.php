<?php

namespace App\CQRS\Commands;

class CriarTransacaoCommand
{
    public string $tipo;
    public float $valor;
    public string $descricao;
    public int $categoriaId;

    public function __construct(string $tipo, float $valor, string $descricao, int $categoriaId)
    {
        $this->tipo = $tipo;
        $this->valor = $valor;
        $this->descricao = $descricao;
        $this->categoriaId = $categoriaId;
    }
}

