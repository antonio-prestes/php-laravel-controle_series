@component('mail::message')

    <h1>Nova Série adicionada com Sucesso!</h1>
    <div class="mb-4 text-sm text-gray-600 mt-2">
        Nome da Série: {{$nome}} <br>
        Quantidade Temporadas:{{$qtdTemporadas}} <br>
        Quantidade Episódios:{{$qtdEpisodios}}
    </div>

@endcomponent
