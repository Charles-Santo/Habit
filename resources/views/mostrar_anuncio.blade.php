@extends('layouts.main_layout')

@section('titulo', 'Habit - ' . $anuncio->titulo)

@section('conteudo')
    @include('top_bar')
    
    <div class="container py-5">


        <div class="card bg-white border border-dark rounded-4 p-4 p-md-5 shadow-sm">
            <div class="row g-5">
                
                <div class="col-md-7">
                    <div class="mb-4">
                        <span class="badge bg-dark text-white rounded-pill px-3 py-2 mb-3">Imóvel</span>
                        <h2 class="text-dark fw-bold mb-2">{{ $anuncio->titulo }}</h2>
                        <h3 class="text-dark fw-bolder mb-4">R$ {{ number_format($anuncio->preco, 2, ',', '.') }}</h3>
                    </div>
                    
                    <h5 class="fw-bold border-bottom border-dark pb-2 mb-3">Descrição</h5>
                    <p class="text-dark mb-4" style="white-space: pre-line;">{{ $anuncio->descricao }}</p>

                    <h5 class="fw-bold border-bottom border-dark pb-2 mb-3">Detalhes</h5>
                    <ul class="list-unstyled text-dark mb-0">
                        <li class="mb-2 d-flex align-items-center gap-2">
                            <strong>Área Total:</strong> {{ number_format($anuncio->area, 2, ',', '.') }} m²
                        </li>
                    </ul>
                </div>

                <div class="col-md-5">
                    <div class="p-4 border border-dark rounded-4 bg-light shadow-sm h-100 d-flex flex-column">
                        
                        <h5 class="fw-bold mb-3 border-bottom border-dark pb-2">Informações do Anunciante</h5>
                        
                        <div class="mb-4">
                            <p class="mb-2"><strong>Anunciante:</strong> {{ $anuncio->user->name ?? 'Não informado' }}</p>
                            
                            @if($anuncio->user && $anuncio->user->is_anunciante)
                                <p class="mb-2"><strong>Corretora:</strong> {{ $anuncio->user->nome_corretora ?? 'Não informado' }}</p>
                                <p class="mb-2"><strong>CNPJ:</strong> {{ $anuncio->user->cnpj_corretora ?? 'Não informado' }}</p>
                            @endif
                        </div>
                        <h5 class="fw-bold mt-auto mb-3 border-bottom border-dark pb-2">Entre em contato</h5>
                        <div class="d-flex flex-column gap-2">
                                 {{ $anuncio->telefone }}
                            
                            @if ($anuncio->email)
                                    ✉️ {{ $anuncio->email }}
                            @endif
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection