@extends('layouts.main_layout')

@section('titulo', 'Editar Anúncio')

@section('conteudo')
    <h1>Editar Anúncio</h1>

    <form class="form-basico" action="{{ route('anuncios.update', $anuncio) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="titulo">Título</label>
        <input type="text" id="titulo" name="titulo" maxlength="50" value="{{ old('titulo', $anuncio->titulo) }}" required>

        <label for="email">E-mail (opcional)</label>
        <input type="email" id="email" name="email" maxlength="50" value="{{ old('email', $anuncio->email) }}">

        <label for="preco">Preço (R$)</label>
        <input type="number" step="0.01" min="0" id="preco" name="preco" value="{{ old('preco', $anuncio->preco) }}" required>

        <label for="area">Área (m²)</label>
        <input type="number" step="0.01" min="0" id="area" name="area" value="{{ old('area', $anuncio->area) }}" required>

        <label for="telefone">Telefone</label>
        <input type="tel" id="telefone" name="telefone" maxlength="20" value="{{ old('telefone', $anuncio->telefone) }}" required>

        <label for="descricao">Descrição</label>
        <textarea id="descricao" name="descricao" rows="5" required>{{ old('descricao', $anuncio->descricao) }}</textarea>

        <button type="submit">Salvar alterações</button>
    </form>
@endsection
