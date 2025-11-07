<?php

namespace App\Http\Controllers;
use App\CQRS\Commands\CriarTransacaoCommand;
use App\CQRS\Commands\CriarTransacaoHandler;
use App\CQRS\Queries\ConsultarSaldoQuery;
use App\CQRS\Queries\ConsultarSaldoHandler;
use App\Models\Transacao;
use App\Http\Requests\TransacaoRequest;
use App\Factories\TransacaoFactory;
use App\Http\Controller\view;
class TransacaoController extends Controller
{
    public function index()
    {
        return Transacao::with('categoria')->where('user_id', auth()->id())->get();
    }

    public function store(TransacaoRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        $transacao = Transacao::create($data);
        return $transacao->load('categoria');
    }

    public function show(Transacao $transacao)
    {
        $this->authorizeUser($transacao);
        return $transacao->load('categoria');
    }

    public function update(TransacaoRequest $request, Transacao $transacao)
    {
        $this->authorizeUser($transacao);
        $transacao->update($request->validated());
        return $transacao->load('categoria');
    }

    public function destroy(Transacao $transacao)
    {
        $this->authorizeUser($transacao);
        $transacao->delete();
        return response()->noContent();
    }

    private function authorizeUser(Transacao $transacao)
    {
        if ($transacao->user_id !== auth()->id()) {
            abort(403, 'Acesso negado');
        }
    }




public function store(Request $request)
{
    $validated = $request->validate([
        'tipo' => 'required|string',
        'valor' => 'required|numeric',
        'descricao' => 'required|string',
        'categoria_id' => 'required|integer|exists:categoria,id',
    ]);

    $transacao = TransacaoFactory::criar(
        $validated['tipo'],
        $validated['valor'],
        $validated['descricao'],
        $validated['categoria_id']
    );

    $transacao->save();

    return redirect()->route('transacoes.index')->with('success', 'Transação criada com sucesso!');
}





public function store(Request $request)
{
    $validated = $request->validate([
        'tipo' => 'required|string',
        'valor' => 'required|numeric',
        'descricao' => 'required|string',
        'categoria_id' => 'required|integer|exists:categoria,id',
    ]);

    $command = new CriarTransacaoCommand(
        $validated['tipo'],
        $validated['valor'],
        $validated['descricao'],
        $validated['categoria_id']
    );

    $handler = new CriarTransacaoHandler();
    $handler->handle($command);

    return redirect()->route('transacoes.index')->with('success', 'Transação criada com sucesso!');
}

public function saldo(Request $request)
{
    $periodo = $request->query('periodo', 'mensal');

    $query = new ConsultarSaldoQuery($periodo);
    $handler = new ConsultarSaldoHandler();
    $saldo = $handler->handle($query);

    return view('transacoes.saldo', compact('saldo', 'periodo'));
}

};