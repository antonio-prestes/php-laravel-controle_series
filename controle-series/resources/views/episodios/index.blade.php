@extends('layout')

@section('title')
    Episódios de {{$serie->nome}}
@endsection()

@section('content')

    @include('mensagens',['messageSucess'=>$messageSucess])

    <form action="/temporadas/{{$temporada}}/episodios/assistir" method="post">
        @csrf
        <ul @class('list-group')>
            @foreach($episodios as $episodio)
                <li @class('list-group-item d-flex justify-content-between align-items-center')>
                    Episódio {{$episodio->numero}}
                    <input type="checkbox" name="episodios[]"
                           value="{{$episodio->id}}"{{$episodio->assistido ? 'checked' : ''}}>
                </li>
            @endforeach
        </ul>
        <div class="d-flex justify-content-end">
            <button class="btn btn-primary mt-2">Salvar</button>
        </div>
    </form>

@endsection()
