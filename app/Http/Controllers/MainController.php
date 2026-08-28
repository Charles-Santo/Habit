<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anuncio;

class MainController extends Controller
{
     private array $regras = [
        'titulo' => 'required|string|max:50',
        'email' => 'nullable|email|max:50',
        'preco' => 'required|numeric|min:0',
        'area' => 'required|numeric|min:0',
        'telefone' => 'required|string|max:20',
        'descricao' => 'required|string',
    ];

    /**
     * Home: lista todos os anúncios.
     */
    public function index()
    {
        $anuncios = Anuncio::latest()->get();

        return view('homepage', compact('anuncios'));
    }

    /**
     * Formulário de cadastro de um novo anúncio.
     */
    public function createAnuncio()
    {
        return view('createanuncio');
    }

    /**
     * Salva um novo anúncio no banco.
     */
    public function storeAnuncio(Request $request)
    {
        $dados = $request->validate($this->regras);

        Anuncio::create($dados);

        return redirect('/')->with('sucesso', 'Anúncio cadastrado com sucesso!');
    }

    /**
     * Formulário de edição de um anúncio existente.
     */
    public function editAnuncio(Anuncio $anuncio)
    {
        return view('editanuncio', compact('anuncio'));
    }

    /**
     * Atualiza um anúncio existente.
     */
    public function updateAnuncio(Request $request, Anuncio $anuncio)
    {
        $dados = $request->validate($this->regras);

        $anuncio->update($dados);

        return redirect('/')->with('sucesso', 'Anúncio atualizado com sucesso!');
    }

    /**
     * Remove um anúncio (soft delete, por causa do ->softDeletes() na migration).
     */
    public function deleteAnuncio(Anuncio $anuncio)
    {
        $anuncio->delete();

        return redirect('/')->with('sucesso', 'Anúncio removido com sucesso!');
    }
}
