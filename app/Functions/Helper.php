<?php

namespace App\Functions;

use Illuminate\Support\Str;

class   Helper
{
    public static function makeSlug($string, $model)
    {
        $slug = Str::slug($string, '-');
        $original_slug = $slug;
        $exixts = $model::where('slug', $slug)->first();
        $i = 1;
        while ($exixts) {
            $slug = $original_slug . '-' . $i;
            $exixts = $model::where('slug', $slug)->first();
            $i++;
        }
        return $slug;
    }
}
