<?php


namespace TrackerTest;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Tracker\TrackerServiceProvider;
use TrackerTest\Dependencies\ArticleModel;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    use RefreshDatabase;

    protected $article;

    protected function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__.'/../database/2020_09_20_150118_create_trackers_table.php');
        $this->loadMigrationsFrom(__DIR__.'/Dependencies/database/2020_09_20_150118_create_articles_table.php');

        $this->article = ArticleModel::query()->create([
            'title' => 'test'
        ]);

    }

    protected function getPackageProviders($app)
    {
        return [
            TrackerServiceProvider::class
        ];
    }

}