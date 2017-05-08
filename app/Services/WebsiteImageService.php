<?php

namespace App\Services;

use App\NewsSource;
use Intervention\Image\Facades\Image as InterventionImage;
use mikehaertl\wkhtmlto\Image;

class WebsiteImageService
{
	public function create(NewsSource $newsSource)
	{
		$filepath = public_path() . '/img/WebsiteImages/' . $newsSource->base_name . '.png';

		$websiteImagePath = $this->scrape($newsSource, $filepath);

		return $websiteImagePath;
	}

	public function scrape($newsSource, $filepath)
	{
		$cropType1 = ['economist.com'];

		// economist is weird so treat it weird
		if (in_array($newsSource->base_name, $cropType1)) {

			$command = "xvfb-run -a /usr/bin/wkhtmltoimage --javascript-delay 40 --width 1400 --height 1700 --load-error-handling ignore  --custom-header User-Agent 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36' --custom-header Referer https://www.google.com/ {$newsSource->url} $filepath";
		// otherwise do it regular
		} else {

			$command = "xvfb-run -a /usr/bin/wkhtmltoimage --javascript-delay 40 --load-error-handling ignore --width 1024 --height 1700 --custom-header User-Agent 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36' --custom-header Referer https://www.google.com/ {$newsSource->url} $filepath";
		}

		// shell command using wkhtmltoimage through xvfb, with a bunch of possibly useless headers

		$res = shell_exec($command);

		if ($res != NULL) {
			return $filepath;
		}

	}

	public function update(NewsSource $newsSource)
	{
		$filepathOrig = public_path() . '/img/WebsiteImages/' . $newsSource->base_name . '.png';
		$filepath = public_path() . '/img/WebsiteImages/' . $newsSource->base_name . '_tmp.png';

		$filepath = $this->scrape($newsSource, $filepath);

		// overwrite original filepath with the image
		rename($filepath, $filepathOrig);

		return $filepathOrig;
	}
}


// use https://github.com/wkhtmltopdf/wkhtmltopdf/issues/2037#issuecomment-62019521
// and /usr/bin/wkhtmltoimage
// use shell_exec commands over lameass mikehaertl package