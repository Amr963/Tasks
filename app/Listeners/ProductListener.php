<?php

namespace App\Listeners;

use App\Events\ProductEvent;
use App\Mail\ProductCreatedMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProductListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ProductEvent $event): void
    {
        Mail::to($event->user->email)->send(new ProductCreatedMail($event->user, $event->product));
    }
}
