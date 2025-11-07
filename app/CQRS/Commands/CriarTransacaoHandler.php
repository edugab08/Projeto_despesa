<?php

namespace App\CQRS\Commands;

use App\Factories\TransacaoFactory;

class CriarTransacaoHandler
{
    public function handle(CriarTransacaoCommand $command)
    {
        $transacao = TransacaoFactory::criar(
            $command->tipo,
            $command->valor,
            $command->descricao,
            $command->categoriaId
        );

        $transacao->save();

        return $transacao;
    }
}

