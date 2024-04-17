<?php

namespace App\Enums;

enum ScholarAccount: string

{

    case true ='true';
    case false ='false';
   
    
   

    public static function values(): array {
        return array_column(self::class->cases, 'value');
    }
}