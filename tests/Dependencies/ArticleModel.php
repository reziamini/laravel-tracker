<?php


namespace TrackerTest\Dependencies;


use Illuminate\Database\Eloquent\Model;
use Tracker\Traits\Trackable;

class ArticleModel extends Model
{
    use Trackable;

    protected $table = 'articles';
    protected $guarded = [];
}