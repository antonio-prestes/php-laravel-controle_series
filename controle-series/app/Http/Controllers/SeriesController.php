<?php

namespace App\Http\Controllers;

use App\Events\NovaSerie;
use App\Http\Requests\SeriesformRequest;
use App\Models\Serie;
use App\Services\createSerie;
use App\Services\deleteSerie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\NewSerie;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;



class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $userId = auth()->id();

        $series = Serie::query()->where('user_id', $userId)->orderBy('nome')->paginate(5);

        $messageSucess = $request->session()->get('messageSucess');
        $messageDelete = $request->session()->get('messageDelete');

        return view('series.index', ['series' => $series, 'messageSucess' => $messageSucess, 'messageDelete' => $messageDelete, 'user' => $user]);
    }

    public function create()
    {
        $user = Auth::user();
        return view('series.create', ['user' => $user]);
    }

    public function store(SeriesformRequest $request, createSerie $createSerie): \Illuminate\Http\RedirectResponse
    {
        $userId = auth()->id();

        $imgName = null;

        if ($request->hasFile('cover') && $request->file('cover')->isValid()) {

            $request->file('cover')->store('serie');

            $imgName = $request->cover->hashName();
        }

        $serie = $createSerie->criarSerie(
            $request->nome,
            $request->qtd_temporadas,
            $request->qtd_episodios,
            $userId,
            $imgName);

        $request->session()
            ->flash('messageSucess', "Série {$serie->nome} id {$serie->id} criada com sucesso!");

        $eventNewSerie = new NovaSerie(
            $request->nome,
            $request->qtd_temporadas,
            $request->qtd_episodios,
            $userId);

        event($eventNewSerie);

        return redirect()->route('series.index');
    }

    public function destroy(Request $request, deleteSerie $deleteSerie)
    {
        $nomeSerie = $deleteSerie->deletarSerie($request->id);

        $request->session()
            ->flash('messageDelete', "Série {$nomeSerie} deletada com sucesso");

        return redirect()->route('series.index');
    }

    public function edit(int $id, Request $request)
    {
        $newName = $request->nome;
        $serie = Serie::find($id);
        $serie->nome = $newName;
        $serie->save();
    }
}
