<?php
namespace App\Services\Notification\Providers;

use App\Jobs\sendEmail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Services\Notification\Contracts\Provider;
use Illuminate\Contracts\Mail\Mailable;

class EmailProvider implements Provider
{

    public function __construct(private User $user, private Mailable $mailable)
    {
    }

    public function send(){
      // return Mail::to($this->user)->send($this->mailable);
      sendEmail::dispatch($this->user, $this->mailable);
    }
}