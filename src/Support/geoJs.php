<?php

namespace Tracker\Support;

use Illuminate\Support\Facades\Http;

class geoJs
{
    public static function getCountry($ip)
    {
        $res = Http::get("https://get.geojs.io/v1/ip/country/$ip.json");

        return $res->json()['country'] ?? 'Unknown';
    }
}
