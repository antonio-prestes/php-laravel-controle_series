<?php

namespace App\Services;

use App\Events\DeletedSerie;
use App\Models\Serie;
use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class deleteSerie
{
    public function DeletarSerie(int $serieId): string
    {
        $nomeSerie = '';
        DB::transaction(function () use ($serieId, &$nomeSerie) {
            $serie = Serie::find($serieId);
            $nomeSerie = $serie->nome;
            $this->DeletarTemporada($serie);
            $serie->delete();

            $eventDeletedSerie = new DeletedSerie($serie);
            event($eventDeletedSerie);
        });

        return $nomeSerie;
    }

    /**
     * @param $serie
     */
    private function DeletarTemporada($serie): void
    {
        $serie->temporadas->each(function ($temporada) {
            $this->DeletarEpisodio($temporada);
            $temporada->delete();
        });

    }

    /**
     * @param $temporada
     */
    private function DeletarEpisodio($temporada): void
    {
        $temporada->episodios->each(function ($episodio) {
            $episodio->delete();
        });

    }
}
