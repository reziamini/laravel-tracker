# Laravel Tracker
A package to track your model data and monitor model data

## Installation
First you should install package with composer :
```bash
composer require rezaamini-ir/laravel-tracker
```

Next publish dependencies :
```bash
php artisan tracker:install
```

Now you can run migration to create tracker tables:
```bash
php artisan migrate
```

There we go, We have installed package, Let's use it.

## Usage
To use from package you must use from tracker trait in model which you want to track 
```php
use Tracker\Traits\Trackable;

class Article extends Model{
    use Trackable;
}
```
Now you can use `track()` method to track in your Article Single page controller 

```php
class ArticleContoller extends Controller
{
    public function show(Article $article){
        $article->track();
        //..
    }
}
```

It will be tracked after every seen by users.
You can set `track_mode` in config in choose what kind of tracker should be used in your project.

In your stats page you can use `tracks()` and `trackCount()` method to get tracked data.
For example :

```php
class StatsContoller extends Controller
{
    public function getStats(Article $article){
        $article->trackCount(); // An integer of tracked count
        $article->tracks; // A collection of tracked data 
        $article->trackBetween(now()->subDays(7), now()); // Tracked data between range of date since last week 
    }
}
```
