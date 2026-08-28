@extends('layouts.main_layout')

@section('titulo', 'Anúncios')

@section('conteudo')
    <h1>Anúncios disponíveis</h1>

    <a href="{{ url('/') }}" class="logo">Imobiliária</a>
    <br></br>
    <a href="{{ route('anuncios.create') }}" class="btn">+ Novo Anúncio</a>

    @forelse ($anuncios as $anuncio)
        <div class="card">
            <h2>{{ $anuncio->titulo }}</h2>
            <div class="preco">R$ {{ number_format($anuncio->preco, 2, ',', '.') }}</div>
            <div class="info">Área: {{ number_format($anuncio->area, 2, ',', '.') }} m²</div>
            <div class="info">Telefone: {{ $anuncio->telefone }}</div>
            @if ($anuncio->email)
                <div class="info">E-mail: {{ $anuncio->email }}</div>
            @endif
            <p>{{ $anuncio->descricao }}</p>

            <div class="acoes">
                <a href="{{ route('anuncios.edit', $anuncio) }}" class="btn-editar">Editar</a>

                <form action="{{ route('anuncios.destroy', $anuncio) }}" method="POST" style="display:inline"
                      onsubmit="return confirm('Excluir este anúncio?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-excluir">Excluir</button>
                </form>
            </div>
        </div>
    @empty
        <p>Nenhum anúncio cadastrado ainda.</p>
    @endforelse
@endsection
