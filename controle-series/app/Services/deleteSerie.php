<?php

namespace App\Services;

use App\Models\Serie;
use Illuminate\Support\Facades\DB;

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
