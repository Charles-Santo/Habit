<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anuncio;
use App\Services\Operations;

class MainController extends Controller
{
    private array $regras = [
        'titulo' => 'required|string|max:50',
        'email' => 'nullable|email|max:50',
        'preco' => 'required|numeric|min:0|max:9999999999',
        'area' => 'required|numeric|min:0|max:999999',
        'telefone' => 'required|string|max:20',
        'descricao' => 'required|string',
    ];

    private array $mensagens = [
        'titulo.required' => 'O campo título é obrigatório.',
        'titulo.max' => 'O título não pode ter mais de 50 caracteres.',
        'email.email' => 'Insira um endereço de e-mail válido.',
        'preco.required' => 'Informe o preço do imóvel.',
        'preco.numeric' => 'O preço precisa ser um número válido.',
        'preco.min' => 'O preço não pode ser negativo.',
        'preco.max' => 'O valor do imóvel excede o limite permitido. até 8 caracretéres',
        'area.required' => 'A área do imóvel é obrigatória.',
        'area.numeric' => 'A área precisa ser um número válido.',
        'area.max' => 'A área informada é grande demais. até 6 caracteres',
        'telefone.required' => 'O telefone para contato é obrigatório.',
        'descricao.required' => 'Escreva uma breve descrição sobre o imóvel.',
    ];

    public function index()
    {
        $anuncios = Anuncio::latest()->get();
        return view('homepage', compact('anuncios'));
    }

    public function meusAnuncios()
    {
        $userId = session('user')['id'];

        $anuncios = Anuncio::where('user_id', $userId)->get();

        return view('meus_anuncios', compact('anuncios'));
    }

    public function createAnuncio()
    {
        return view('create_anuncio');
    }

    public function storeAnuncio(Request $request)
    {
        $dados = $request->validate($this->regras, $this->mensagens);
        $dados['user_id'] = session('user')['id'];

        Anuncio::create($dados);

        return redirect()->route('home')->with('sucesso', 'Anúncio cadastrado com sucesso!');
    }

    public function editAnuncio($id)
    {
        $decrypted_id = Operations::decryptId($id);
        $anuncio = Anuncio::find($decrypted_id);

        if (!$anuncio) {
            return redirect()->route('home');
        }

        return view('edit_anuncio', compact('anuncio'));
    }

    public function updateAnuncio(Request $request)
    {
        if ($request->anuncio_id === null) {
            return redirect()->route('home');
        }

        $decrypted_id = Operations::decryptId($request->anuncio_id);
        $anuncio = Anuncio::find($decrypted_id);

        if (!$anuncio) {
            return redirect()->route('home');
        }

        $dados = $request->validate($this->regras, $this->mensagens);
        $anuncio->update($dados);

        return redirect()->route('home')->with('sucesso', 'Anúncio atualizado com sucesso!');
    }

    public function deleteAnuncio(Request $request)
    {
        if ($request->anuncio_id === null) {
            return redirect()->route('home');
        }

        $decrypted_id = Operations::decryptId($request->anuncio_id);
        $anuncio = Anuncio::find($decrypted_id);

        if ($anuncio) {
            $anuncio->delete();
        }

        return redirect()->route('home')->with('sucesso', 'Anúncio removido com sucesso!');
    }

    public function mostrar($id)
    {
        $idDescriptografado = Operations::decryptId($id);

        $anuncio = Anuncio::with('user')->findOrFail($idDescriptografado);

        return view('mostrar_anuncio', compact('anuncio'));
    }
}