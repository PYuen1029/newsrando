<?php

namespace App\Services;

use App\NewsSource;
use Intervention\Image\Facades\Image as InterventionImage;
use mikehaertl\wkhtmlto\Image;

class WebsiteImageService
{
	public function create(NewsSource $newsSource)
	{
		$websiteImagePath = $this->scrape($newsSource);

		$image = InterventionImage::make($websiteImagePath)
				->crop(1000, 724, null, 0)
				->save();

		return $websiteImagePath;
	}

	public function scrape($newsSource)
	{
		$image = new Image([
			// Explicitly tell wkhtmltopdf that we're using an X environment
			'use-xserver',

    		// Enable built in Xvfb support in the command
			'commandOptions' => [
				'enableXvfb' => true,
			],
			'tmpDir' => '/var/tmp'
		]);

		$image->setPage($newsSource->url);
		
		$filepath = public_path() . '/img/WebsiteImages/' . $newsSource->base_name . '.png';

		if (!$image->saveAs($filepath)) {
		    echo $image->getError();
		    die();
		}

		return $filepath;
	}
}
