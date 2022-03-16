<?php

namespace App\Listeners;

use Aacotroneo\Saml2\Events\Saml2LoginEvent;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthSaml2LoginEventListener
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
     * @param  object  $event
     * @return void
     */
    public function handle(Saml2LoginEvent $event)
    {
        $user = $event->getSaml2User();

        $userData = [
            'id' => $user->getUserId(),
            'email' => $user->getAttributes()['email'][0],
        ];

        // a partir desse ponto, seguir com auth local
        User::createAndGet($userData)->where($userData)
        ->update([
            'last_login' => Carbon::now()
        ]);

        Auth::login(User::createAndGet($userData));
        Session::save();
    }
}
