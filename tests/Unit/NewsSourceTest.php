<?php

namespace Tests\Unit;

use App\NewsSource;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class NewsSourceTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function test_duplicate_news_sources_arent_created()
    {
    	$data = [
    		'url' => 'www.google.com',
    	];

    	$news_source = NewsSource::selfCreate($data);

    	$this->assertEquals(37, $news_source->id);
    }
}
