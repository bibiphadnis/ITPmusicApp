<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Track;
use App\Models\Artist;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\StatsEmail;

class StatsEmailSend implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $artists;
    protected $tracks;
    protected $playlists;
    

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $playlists = DB::table('playlists')->get();
        $this->playlists = $playlists;

        $artists = Artist::all();
        $this->artists = $artists;

        $tracks = DB::table('tracks')->sum('milliseconds');
        $this->tracks = $tracks;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $users = User::all();
        foreach ($users as $user) {
            if ($user->email) {
                Mail::to($user->email)->queue(new StatsEmail($this->artists, $this->tracks, $this->playlists));
            }
            else {
                throw new Exception("User {$user->id} is missing an email");
            }
            
        }
    }
}
