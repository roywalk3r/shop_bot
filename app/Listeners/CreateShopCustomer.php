<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use App\Models\Shop\Customer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class CreateShopCustomer
{
    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $user = $event->user;
  
            $user = $event->user;
            $shopCustomer = new Customer([
                'name' => $user->name,
                'email' => $user->email,
                'user_id' => $user->id,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
             ]);
            $user->shopCustomer()->save($shopCustomer);
 
        // Check if the user is already a shop customer
     
    }}
 