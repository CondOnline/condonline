<?php


namespace App\Traits;


use Jenssegers\Agent\Agent;

trait UserAgente
{

    public function createAgent($session)
    {
        return tap(new Agent, function ($agent) use ($session) {
            $agent->setUserAgent($session->user_agent);
        });
    }

}
