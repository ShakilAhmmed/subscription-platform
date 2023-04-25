<?php

namespace App\Services;

use App\Models\Subscriber;
use Illuminate\Database\Eloquent\Collection;

class SubscriberService
{
    /**
     * @param $webSite
     * @return Collection|array
     */
    public function getAllSubscribers($webSite): \Illuminate\Database\Eloquent\Collection|array
    {
        return Subscriber::query()->select('user_id')->where('website_id', $webSite)->get();
    }
}
