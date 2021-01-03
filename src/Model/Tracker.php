<?php


namespace Tracker\Model;


use Illuminate\Database\Eloquent\Model;
use Tracker\Casts\SerializeCast;

class Tracker extends Model
{
    protected $guarded = [];

    protected $casts = [
        'request' => SerializeCast::class
    ];

    public function trackable()
    {
        return $this->morphTo();
    }

}
