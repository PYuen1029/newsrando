<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class NewsSource extends Model
{
	protected $fillable = ['url'];

	public function users()
	{
		return $this->belongsToMany('App\User');
	}

	public function frontpage()
	{
		return $this->hasOne('App\Frontpage');
	}

	static public function selfCreate($data)
	{
		$newsSource = new NewsSource(['url' => $data['newsSourceUrl']]);
		$newsSource->base_name = STATIC::getBaseName($newsSource->url);

		$newsSource->save();
		
		// handle user-newsSource relationship
		Auth::user()->newsSources()->attach($newsSource);

		// handle frontpage-newsSource relationship
		$frontpage = Frontpage::selfCreate($newsSource);

		return $newsSource;
	}

	static private function getBaseName($url)
	{
		$host = @parse_url($url, PHP_URL_HOST);
    	// If the URL can't be parsed, use the original URL
    	// Change to "return false" if you don't want that
		if (!$host)
			$host = $url;
    	// The "www." prefix isn't really needed if you're just using
    	// this to display the domain to the user
		if (substr($host, 0, 4) == "www.")
			$host = substr($host, 4);
    	// You might also want to limit the length if screen space is limited
		if (strlen($host) > 50)
			$host = substr($host, 0, 47) . '...';
		return $host;
	}
}
