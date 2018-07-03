<?php

namespace App\Enum;

use InvalidArgumentException;

class AccommodationTypeEnum
{
    const HOUSE = 'house';
    const APARTMENT = 'apartment';

    private static $accommodationNames = [
        self::HOUSE => 'house.title',
        self::APARTMENT => 'apartment.title'
    ];

    /**
     * @param $type
     * @return string
     */
    public static function getTypeName($type) {
        if(!isset(self::$accommodationNames[$type])) {
            throw new InvalidArgumentException('Unknown accommodation type');
        }
        return self::$accommodationNames[$type];
    }

    /**
     * @return string[]
     */
    public static function getAvailableTypes()
    {
        return [
            self::HOUSE,
            self::APARTMENT
        ];
    }
}