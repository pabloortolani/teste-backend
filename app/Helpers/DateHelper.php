<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateHelper
{
    public static function convertDateBRtoUS(string $date): string
    {
        return Carbon::createFromFormat("d/m/Y", $date)->format("Y-m-d");
    }

    public static function convertDateUStoBR(string $date): string
    {
        return Carbon::createFromFormat("Y-m-d", $date)->format("d/m/Y");
    }
}
