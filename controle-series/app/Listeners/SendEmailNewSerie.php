<?php

namespace App\Listeners;

use App\Events\NovaSerie;
use App\Mail\NewSerie;
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
     * @param NovaSerie $event
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

        $email->subject = 'Nova série sdicionada';

        Mail::to($user)->send($email);
    }
}
