<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewSerie extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $nome;
    public $qtdTemporadas;
    public $qtdEpisodios;


    public function __construct($nome, $qtdTemporadas, $qtdEpisodios)
    {
        $this->nome = $nome;
        $this->qtdTemporadas = $qtdTemporadas;
        $this->qtdEpisodios = $qtdEpisodios;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.serie.new-serie');
    }
}
