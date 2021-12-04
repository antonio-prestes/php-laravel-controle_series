@extends('layout',['user'=>$user])

@section('title','Adicionar Séries')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post">
        @csrf
        <div class="row">
            <div @class('col col-8')>
                <label for="nome">Nome da série</label>
                <input type="text" @class('form-control mt-2') name="nome" id="nome">

            </div>
            <div @class('col col-2')>
                <label for="qtd_temporadas">Temporadas</label>
                <input type="number" @class('form-control mt-2') name="qtd_temporadas" id="qtd_temporadas">
            </div>
            <div @class('col col-2')>
                <label for="qtd_episodios">Ep. por Temporada</label>
                <input type="number" @class('form-control mt-2') name="qtd_episodios" id="qtd_episodios">
            </div>
            <div class="d-flex justify-content-end">
                <button @class('btn btn-primary mt-2 ')>Adicionar</button>
            </div>
        </div>
    </form>

@endsection()

