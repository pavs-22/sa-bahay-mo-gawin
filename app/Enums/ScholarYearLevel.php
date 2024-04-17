<?php

namespace App\Enums;

enum ScholarYearLevel: string

{

    case GRADE_7 ='GRADE 7';
    case GRADE_8 ='GRADE 8';
    case GRADE_9 ='GRADE 9';
    case GRADE_10 ='GRADE 10';
    case GRADE_11 ='GRADE 11';
    case GRADE_12 ='GRADE 12';
    case FIRST_YEAR ='FIRST YEAR';
    case SECOND_YEAR ='SECOND YEAR';
    case THIRD_YEAR ='THIRD YEAR';
    case FOURTH_YEAR ='FOURTH YEAR';
    case FIFTH_YEAR ='FIFTH YEAR';
    
    
   

    public static function values(): array {
        return array_column(self::class->cases, 'value');
    }
}