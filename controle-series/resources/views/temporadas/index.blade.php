@extends('layout')

@section('title')
    {{$serie->nome}}
@endsection()

@section('content')
    <ul @class('list-group')>

        <div class="row mt-4">
            <div class="col-md-3">
                @if($serie->cover_img)
                    <img src="{{Storage::url($serie->cover_img)}}" alt="cover"
                         class="img-thumbnail" height="400px" width="300px">
                @else
                    <img src="{{Storage::url('not-found.png')}}" alt="cover" class="img-thumbnail"
                         height="100px" width="60px">
                @endif
            </div>
            <div class="col-md-9">
                <h4>Descrição</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci autem commodi corporis eligendi eveniet expedita
                    labore libero odit pariatur placeat, quasi reprehenderit sapiente similique soluta voluptate! Assumenda consectetur
                    minima pariatur!</p>
                @foreach($temporadas as $temporada)
                    <li @class('list-group-item d-flex justify-content-between align-items-center')>
                        <a href="/temporadas/{{$temporada->id}}/episodios"> Temporada {{$temporada->numero}}</a>
                        <span
                            class="badge bg-secondary">{{$temporada->getEpChecked()->count()}} / {{$temporada->episodios->count()}} </span>
                    </li>
                @endforeach
            </div>
        </div>
@endsection()
