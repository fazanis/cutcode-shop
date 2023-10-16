<?php

namespace App\Faker;

use Faker\Provider\Base;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImagesFaker extends Base
{
    public function unicImage(string $dir='',$width=500,$height=500):string
    {
        $name = $dir.'/'.Str::random(6).'.jpg';
        Storage::put(
            $name,
            file_get_contents("https://loremflickr.com/$width/$height")
        );

        return '/storage/'.$name;
    }
}
