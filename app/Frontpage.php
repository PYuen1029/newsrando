<?php

namespace App;

use App\NewsSource;
use App\Services\WebsiteImageService;
use Illuminate\Database\Eloquent\Model;

class Frontpage extends Model
{
    public function newsSource()
    {
        return $this->belongsTo('App\NewsSource');
    }

    public static function selfCreate(NewsSource $newsSource)
    {
    	$frontpage = new Frontpage();

    	$filepath = (new WebsiteImageService())->create($newsSource);

    	// trim or whatever is needed to make it publicly accessible
        $filepath = STATIC::trimPath($filepath);

    	$frontpage->filepath = $filepath;

        $frontpage->news_source_id = $newsSource->id;

        $frontpage->save();

        return $frontpage;
    }

    public static function trimPath($path)
    {
        ///home/vagrant/code/newsrando/src/Services/../../web/
        $needle = '/public';

        $offset = stripos($path, $needle);

        if ($offset === false) {
            throw new \Exception('WebsiteImageProvider::trimPath could not find specified needle');
        }
        
        $offset += strlen($needle);

        return substr($path, $offset);
    }

    public function updateImage()
    {
        $newsSource = $this->newsSource;

        $filepath = (new WebsiteImageService())->update($newsSource);

        // trim or whatever is needed to make it publicly accessible
        $filepath = STATIC::trimPath($filepath);

        $this->filepath = $filepath;

        $this->save();

        $newsSource->updated_at = date("Y-m-d H:i:s");

        $newsSource->save();

        return $this;
    }
}
