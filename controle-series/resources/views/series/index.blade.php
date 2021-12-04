@extends('layout')

@section('title','Listar Séries')

@section('content')

    <a href="{{ route('series.create') }}" @class(' btn btn-dark mb-3')>Adicionar</a>

    @include('mensagens',['messageSucess'=>$messageSucess,'messageDelete'=>$messageDelete])

    <ul @class('list-group')>
        @foreach($series as $serie)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span id="nome-serie-{{$serie->id}}">{{$serie->nome}}</span>

                <div class="input-group w-50" hidden id="input-nome-serie-{{$serie->id}}">
                    <input type="text" class="form-control" value="{{$serie->nome}}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" onclick="editarSerie({{$serie->id}})">
                            <i class="bi bi-check-square"></i>
                        </button>
                        @csrf
                    </div>
                </div>

                <span class="d-flex">
                    <button class="btn btn-primary me-1" onclick="toggleInput({{$serie->id}})">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                    <a href="/series/{{$serie->id}}/temporadas" class="btn btn-info me-1">
                        <i class="bi bi-arrow-up-right-square"></i>
                    </a>
                    <form method="post" action="/remover/{{$serie->id}}">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger" type="submit"><i class="bi bi-trash"></i></button>
                    </form>
                </span>
            </li>

        @endforeach
    </ul>
    {{ $series->onEachSide(5)->links() }}

    <script>
        function toggleInput(serieId) {

            const nomeSerieEl = document.getElementById(`nome-serie-${serieId}`)
            const inputNomeSerieEl = document.getElementById(`input-nome-serie-${serieId}`)

            if (nomeSerieEl.hasAttribute('hidden')) {
                nomeSerieEl.removeAttribute('hidden')
                inputNomeSerieEl.hidden = true;
            } else {
                inputNomeSerieEl.removeAttribute('hidden')
                nomeSerieEl.hidden = true;
            }
        }

        function editarSerie(serieId) {

            let formData = new FormData();
            const nome = document.querySelector(`#input-nome-serie-${serieId} > input`).value;

            const token = document.querySelector('input[name="_token"]').value;


            formData.append('nome', nome);
            formData.append('_token', token)


            const url = `/series/${serieId}/edit`;

            fetch(url, {
                body: formData,
                method: 'POST'
            }).then(() => {
                toggleInput(serieId);
                document.getElementById(`nome-serie-${serieId}`).textContent = nome;
            })
        }
    </script>
@endsection()
