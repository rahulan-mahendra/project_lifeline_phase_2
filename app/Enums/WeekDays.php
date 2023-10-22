<?php

namespace App\Enums;

trait EnumToArray
{

  public static function names(): array
  {
    return array_column(self::cases(), 'name');
  }

  public static function values(): array
  {
    return array_column(self::cases(), 'value');
  }

  public static function array(): array
  {
    return array_combine(self::names(), self::values());
  }

}

enum WeekDays: int
{

    use EnumToArray;

    case monday = 1;
    case tuesday = 2;
    case wednesday = 3;
    case thursday = 4;
    case friday = 5;
    case saturday = 0;
    case sunday = 6;

}
