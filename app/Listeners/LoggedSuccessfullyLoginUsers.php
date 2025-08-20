<?php

namespace App\Listeners;

use App\Models\LoginActivity;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LoggedSuccessfullyLoginUsers
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
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $ipAddress = \Request::ip();
        $userLocation = \Location::get($ipAddress);

        // LoginActivity::create([
        //     'user_id' => auth()->user()->id,
        //     'user_agent' => \Request::header('User-Agent'),
        //     'ip_address' => $ipAddress,
        //     'location'  => $userLocation ? $userLocation->cityName.', '.$userLocation->countryName : NULL,
        //     'status' => auth()->user() ? true : false,
        // ]);
    }
}
