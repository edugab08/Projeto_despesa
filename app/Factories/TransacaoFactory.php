<?php

namespace App\Factories;

use App\Models\Transacao;
use App\Models\Categoria;

class TransacaoFactory
{
    public static function criar(string $tipo, float $valor, string $descricao, int $categoriaId): Transacao
    {
        switch ($tipo) {
            case 'despesa':
                return new Transacao([
                    'tipo' => 'despesa',
                    'valor' => $valor,
                    'descricao' => $descricao,
                    'categoria_id' => $categoriaId,
                ]);

            case 'receita':
                return new Transacao([
                    'tipo' => 'receita',
                    'valor' => $valor,
                    'descricao' => $descricao,
                    'categoria_id' => $categoriaId,
                ]);

            case 'investimento':
                return new Transacao([
                    'tipo' => 'investimento',
                    'valor' => $valor,
                    'descricao' => $descricao,
                    'categoria_id' => $categoriaId,
                ]);

            default:
                throw new \InvalidArgumentException("Tipo de transação inválido: {$tipo}");
        }
    }
}

