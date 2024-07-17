<?php

namespace App\utils;

use Carbon\Carbon;

class DateUtils{

    public static function getMonths(){
        $carbon = collect();

        $fecha = Carbon::parse("2019-01-01");
        for($i = 0; $i < 12 ; $i++){
            $carbon->push(ucfirst($fecha->localeMonth));
            $fecha = $fecha->addMonth(1);
        }

        return $carbon;
    }

}