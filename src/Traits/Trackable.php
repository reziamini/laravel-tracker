<?php

namespace Tracker\Traits;

use Illuminate\Support\Str;
use Tracker\Model\Tracker;
use Tracker\Support\geoJs;

trait Trackable
{
    public function tracks()
    {
        return $this->morphMany(Tracker::class, 'trackable');
    }

    public function track()
    {
        if(!$this->handleTrackedStatus()) {
            $clientIP = \request()->getClientIp();

            $data = ['ip' => $clientIP, 'user_id' => auth()->id() ?? 0, 'request' => \request()->server()];

            $data = $this->setCountry($clientIP, $data);

            return $this->tracks()->create($data);
        }
    }

    public function hasTracked()
    {
        return $this->tracks()->exists();
    }

    public function hasTrackedUser()
    {
        return $this->tracks()->where('user_id', auth()->id())->exists();
    }

    public function hasTrackedIp()
    {
        return $this->tracks()->where('ip', request()->getClientIp())->exists();
    }

    public function trackCount()
    {
        return $this->tracks()->count();
    }

    public function trackBetween($from, $to)
    {
        return $this->tracks()->whereBetween('created_at', [$from, $to])->get();
    }


    private function setCountry($clientIP, array $data)
    {
        if (config('tracker.with_country')) {
            if (session()->has('tracker_county')) {
                $country = session()->get('tracker_county');
            } else {
                $country = geoJs::getCountry($clientIP);
                session()->put('tracker_county', $country);
            }
            $data['country'] = $country;
        }
        return $data;
    }

    private function handleTrackedStatus()
    {
        if(config('tracker.track_mode') == 'user' and !config('tracker.track_guest') and auth()->guest()){
            return true;
        }

        if(config('tracker.track_mode') != 'disable'){
            $method = 'hasTracked'.Str::ucfirst(config('tracker.track_mode'));
            return $this->{$method}();
        }

        return false;
    }

}
