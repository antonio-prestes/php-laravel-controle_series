<?php

namespace App\Services;

use App\Models\Serie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class createSerie
{
    public function CriarSerie(string $nomeSerie, int $qdTemporadas, int $epPorTemporada, int $userId): Serie
    {
        DB::beginTransaction();
        $serie = Serie::create(['nome' => $nomeSerie, 'user_id'=>$userId]);

        $this->CriarTemporada($qdTemporadas, $serie, $epPorTemporada);
        DB::commit();

        return $serie;
    }

    /**
     * @param int $qdTemporadas
     * @param $serie
     * @param int $epPorTemporada
     */
    private function CriarTemporada(int $qdTemporadas, $serie, int $epPorTemporada): void
    {
        for ($i = 1; $i <= $qdTemporadas; $i++) {
            $temporada = $serie->temporadas()->create(['numero' => $i]);

            $this->CriarEpisodio($epPorTemporada, $temporada);
        }
    }

    /**
     * @param int $epPorTemporada
     * @param $temporada
     */
    private function CriarEpisodio(int $epPorTemporada, $temporada): void
    {
        for ($j = 1; $j <= $epPorTemporada; $j++) {
            $temporada->episodios()->create(['numero' => $j]);
        }
    }
}
