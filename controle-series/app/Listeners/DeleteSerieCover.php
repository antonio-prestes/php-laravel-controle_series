<?php

namespace App\Listeners;

use App\Events\DeletedSerie;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;

class DeleteSerieCover
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
     * @param  \App\Events\DeletedSerie  $event
     * @return void
     */
    public function handle(DeletedSerie $event)
    {
        $serie = $event->serie;

        Storage::delete("serie/{$serie->cover_img}");
    }
}
