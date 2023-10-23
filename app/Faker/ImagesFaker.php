<?php

namespace App\Faker;

use Faker\Provider\Base;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImagesFaker extends Base
{
    public function unicImage(string $fromDir):string
    {
        if (!Storage::exists($fromDir)){
            Storage::makeDirectory($fromDir);
        }
        $file = $this->generator->file(
            base_path("/tests/Fixtures/images/$fromDir"),
            Storage::path($fromDir),
            false
        );
        return '/storage/'.trim($fromDir,'/').'/'.$file;
    }
}
