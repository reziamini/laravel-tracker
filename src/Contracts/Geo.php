<?php

namespace Tracker\Contracts;

use Illuminate\Support\Facades\Facade;

/**
 * Class Geo
 * @package Tracker\Contracts
 * @method static getCountry($ip)
 */
class Geo extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'geo';
    }
}