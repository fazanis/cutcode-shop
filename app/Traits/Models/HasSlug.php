<?php

namespace App\Traits\Models;

use Illuminate\Database\Eloquent\Model;

trait HasSlug
{
    protected static function bootHasSlug()
    {
        static::creating(function (Model $item){
            $item->makeSlug();
        });
    }
    protected function makeSlug(){
        $slug = $this->validateSlug(
            str($this->{$this->slugFrom()})
                ->slug()
                ->value()
        );
       $this->{$this->slugColumn()} = $this->{$this->slugColumn()} ?? $slug;
    }

    public function slugColumn()
    {
        return 'slug';
    }
    public function slugFrom()
    {
        return 'title';
    }

    public function validateSlug(string $slug)
    {
        $originalSlug = 0;
        $i=0;

        while ($this->isSlugExists($slug)){
            $i++;
            $slug = $originalSlug.'-'.$i;
        }

        return $slug;
    }

    public function isSlugExists(string $slug)
    {
        $query = $this->newQuery()
            ->where(self::slugColumn(),$slug)
            ->where($this->getKeyName(),'!=',$this->getKey())
            ->withoutGlobalScopes();

        return $query->exists();
    }
}
