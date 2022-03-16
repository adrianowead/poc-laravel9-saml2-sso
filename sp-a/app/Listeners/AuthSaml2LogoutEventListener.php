<?php

namespace App\Listeners;

use Aacotroneo\Saml2\Events\Saml2LogoutEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthSaml2LogoutEventListener
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
    public function handle(Saml2LogoutEvent $event)
    {
        Auth::logout();
        Session::save();
    }
}
