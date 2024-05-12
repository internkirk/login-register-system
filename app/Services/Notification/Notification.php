<?php

namespace App\Services\Notification;

use App\Services\Notification\Contracts\Provider;
use Exception;


/**
 * @method public sendEmail(User $user, Mailable $mailable);
 * @method public sendSms(User $user, String $text);
 */

class Notification
{
    public function __call($name, $arguments)
    {
        $providerPath = __NAMESPACE__ . '\Providers\\' . substr($name, 4) . "Provider";

        if (!class_exists($providerPath))
            throw new Exception('Provider does not exist');

        $providerInstance = new $providerPath( ... $arguments);

        if (!is_subclass_of($providerInstance, Provider::class))
            throw new Exception('your class must implement \App\Services\Notification\Contracts\Provider');


        $providerInstance->send();
    }
}
