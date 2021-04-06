<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use App\Models\Artist;
use App\Models\Track;

class StatsEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $artists;
    public $tracks;
    public $playlists;
    

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($artists, $tracks, $playlists)
    {
        $playlists = DB::table('playlists')->get();
        $this->playlists = $playlists;

        $artists = Artist::all();
        $this->artists = $artists;

        $tracks = DB::table('tracks')->sum('milliseconds');
        $this->tracks = $tracks;


    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Stats')
            ->view('email.new-stats');
    }
}
