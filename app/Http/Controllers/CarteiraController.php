<?php

namespace App\Http\Controllers;

use App\Models\Carteira;
use Illuminate\Http\Request;
use App\Services\CalculadoraDeSaldo;
use App\Strategies\CalculoMensalStrategy;
use App\Strategies\CalculoAnualStrategy;
use App\Strategies\CalculoGastosFuturosStrategy;
use App\Http\Controller\auth;
class CarteiraController extends Controller
{
    public function index()
    {
        return Carteira::where('usuario_id', auth()->id())->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'saldo_inicial' => 'required|numeric',
            'tipo' => 'required|string|max:50',
        ]);

        $data['usuario_id'] = auth()->id();

        return Carteira::create($data);
    }

    public function show(Carteira $carteira)
    {
        $this->authorizeUser($carteira);
        return $carteira;
    }

    public function update(Request $request, Carteira $carteira)
    {
        $this->authorizeUser($carteira);

        $data = $request->validate([
            'nome' => 'sometimes|required|string|max:255',
            'saldo_inicial' => 'sometimes|required|numeric',
            'tipo' => 'sometimes|required|string|max:50',
        ]);

        $carteira->update($data);
        return $carteira;
    }

    public function destroy(Carteira $carteira)
    {
        $this->authorizeUser($carteira);
        $carteira->delete();
        return response()->noContent();
    }

    private function authorizeUser(Carteira $carteira)
    {
        if ($carteira->usuario_id !== auth()->id()) {
            abort(403, 'Acesso negado');
        }
    }



public function mostrarSaldo(Request $request)
{
    $tipo = $request->query('tipo', 'mensal');

    switch ($tipo) {
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
    $saldo = $calculadora->calcular();

    return view('carteira.saldo', compact('saldo', 'tipo'));
}

}