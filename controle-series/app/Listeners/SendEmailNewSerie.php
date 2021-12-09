<?php

namespace App\Listeners;

use App\Events\NovaSerie;
use App\Mail\NewSerie;
use http\Env\Request;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SendEmailNewSerie
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param \App\Events\NovaSerie $event
     * @return void
     */
    public function handle(NovaSerie $event)
    {
        $user = Auth::user();

        $nomeSerie = $event->nomeSerie;
        $qtdTemporadas = $event->qtdTemporadas;
        $qtdEpisodios = $event->qtdEpisodios;

        $email = new NewSerie(
            $nomeSerie,
            $qtdTemporadas,
            $qtdEpisodios
        );

        $email->subject = 'Nova Série Adicionada';

        Mail::to($user)->send($email);
    }
}
