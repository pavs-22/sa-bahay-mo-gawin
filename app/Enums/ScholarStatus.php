<?php

namespace App\Enums;

enum ScholarStatus: string

{

    case ACTIVE ='ACTIVE';
    case INACTIVE ='INACTIVE';
    case TOTALLY_CANCELLED ='TOTALLY_CANCELLED';
    case GRADUATED ='GRADUATED';
    case END_OF_CONTRACT ='END_OF_CONTRACT';


    public static function values(): array {
        return array_column(self::class->cases, 'value');
    }
}