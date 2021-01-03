<?php

namespace TrackerTest;

class TrackableTest extends TestCase
{

    /** @test * */
    public function has_tracked(){
        config()->set('tracker.with_country', false);
        $this->article->track();
        $this->assertTrue($this->article->hasTracked());
    }

    /** @test * */
    public function tracked_with_unknown_country()
    {
        config()->set('tracker.with_country', true);
        $tracked = $this->article->track();
        $this->assertEquals($tracked->country, 'Unknown');
    }

}