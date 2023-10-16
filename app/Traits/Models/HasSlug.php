<?php

namespace App\Traits\Models;

use Illuminate\Database\Eloquent\Model;

trait HasSlug
{
    protected static function bootHasSlug()
    {
        static::creating(function (Model $item){
            $item->slug = $item->slug ??
                self::validateSlug(str($item->{self::slugFrom()})
                    ->slug());
        });
    }

    public static function slugFrom()
    {
        return 'title';
    }

    public static function validateSlug(string $slug)
    {
        $i = static::query()->where('slug','like',$slug.'%')->count();

        if ($i>0){
            return $slug.'-'.$i++;
        }
        return $slug;
    }
}
