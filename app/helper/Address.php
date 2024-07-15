<?php

namespace App\helper;

use App\District;
use App\Division;
use App\Thana;

class Address
{
    public static function division($id) {
        return Division::find($id)->name ?? false;
    }

    public static function district($id) {
        return District::find($id)->name ?? false;
    }

    public static function thana($id) {
        return Thana::find($id)->name ?? false;
    }
}
