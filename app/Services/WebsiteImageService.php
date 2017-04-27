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

		$cropType1 = ['economist.com'];

		// economist is weird so treat it weird
		if (in_array($newsSource->base_name, $cropType1)) {
			$image = InterventionImage::make($websiteImagePath)
			->crop(1400, 1700, 1280, 0)
			->save();
		// otherwise do it regular
		} else {
			$image = InterventionImage::make($websiteImagePath)
            ->crop(1024, 1700, null, 0)
            ->save();			
		}

		return $websiteImagePath;
	}

	public function scrape($newsSource)
	{
		$filepath = public_path() . '/img/WebsiteImages/' . $newsSource->base_name . '.png';

		// shell command using wkhtmltoimage through xvfb, with a bunch of possibly useless headers
		$command = "xvfb-run -- /usr/bin/wkhtmltoimage --javascript-delay 40 --load-error-handling ignore  --custom-header User-Agent 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36' --custom-header Referer https://www.google.com/ {$newsSource->url} $filepath";

		$res = shell_exec($command);

		if ($res != NULL) {
			return $filepath;
		}

	}
}


// use https://github.com/wkhtmltopdf/wkhtmltopdf/issues/2037#issuecomment-62019521
// and /usr/bin/wkhtmltoimage
// use shell_exec commands over lameass mikehaertl package