<?php

namespace App;

enum ObjectType: int
{
    case STATIC_BASE_ONE = 5; // deprecate
    case STATIC_BASE_TWO = 6; // deprecate
    case STATIC_BASE_THREE = 7; // deprecate
    case FORWARD_BASE_ONE = 8; // inactive ?
    case FORWARD_BASE_TWO = 9; // inactive ?
    case FORWARD_BASE_THREE = 10; // inactive ?
    case HOSPITAL = 11;
    case VEHICLE_FACTORY = 12;
    case ARMORY = 13; // inactive?
    case SUPPLY_STATION = 14; // inactive?
    case WORKSHOP = 15; // inactive?
    case MANUFACTURING_PLANT = 16; // inactive?
    case REFINERY = 17;
    case SHIPYARD = 18;
    case ENGINEERING_CENTER = 19;
    case SALVAGE_FIELD = 20;
    case COMPONENT_FIELD = 21;
    case FUEL_FIELD = 22; // inactive ?
    case SULFUR_FIELD = 23;
    case WORLD_MAP_TENT = 24; // inactive ?
    case TRAVEL_TENT = 25; // inactive ?
    case TRAINING_AREA = 26; // inactive ?
    case SPECIAL_BASE = 27;
    case OBSERVATION_TOWER = 28;
    case FORT = 29; // inactive ?
    case TROOP_SHIP = 30; // inactive ?
    case SULFUR_MINE = 32;
    case STORAGE_FACILITY = 33;
    case FACTORY = 34;
    case GARRISON_STATION = 35;
    case AMMO_FACTORY = 36; // disabled ?
    case ROCKET_SITE = 37;
    case SALVAGE_MINE = 38;
    case CONSTRUCTION_YARD = 39;
    case COMPONENT_MINE = 40;
    case OIL_WELL = 41;
    case CURSED_FORT = 44; // diabled ?
    case RELIC_BASE_ONE = 45;
    case RELIC_BASE_TWO = 46;
    case RELIC_BASE_THREE = 47;
    case MASS_PRODUCTION_FACTORY = 51;
    case SEAPORT = 52;
    case COASTAL_GUN = 53;
    case SOUL_FACTORY = 54; // disabled ?
    case TOWN_BASE_ONE = 56;
    case TOWN_BASE_TWO = 57;
    case TOWN_BASE_THREE = 58;
    case STORM_CANNON = 59;
    case INTEL_CENTER = 60;

    public static function casesForCategory($category)
    {
        return match ($category) {
            'bases' => [
                self::TOWN_BASE_ONE,
                self::TOWN_BASE_TWO,
                self::TOWN_BASE_THREE,
                self::RELIC_BASE_ONE,
                self::RELIC_BASE_TWO,
                self::RELIC_BASE_THREE,
                self::GARRISON_STATION,
            ],
            'industry' => [
                self::HOSPITAL,
                self::VEHICLE_FACTORY,
                self::REFINERY,
                self::SHIPYARD,
                self::ENGINEERING_CENTER,
                self::STORAGE_FACILITY,
                self::FACTORY,
                self::CONSTRUCTION_YARD,
                self::MASS_PRODUCTION_FACTORY,
                self::SEAPORT,
            ],
            'resources' => [
                self::SALVAGE_FIELD,
                self::COMPONENT_FIELD,
                self::SULFUR_FIELD,
                self::SULFUR_MINE,
                self::SALVAGE_MINE,
                self::OIL_WELL,
                self::COMPONENT_MINE,
            ],
            'strategic' => [
                self::SPECIAL_BASE,
                self::OBSERVATION_TOWER,
                self::ROCKET_SITE,
                self::COASTAL_GUN,
                self::STORM_CANNON,
                self::INTEL_CENTER,
            ]
        };
    }

    public static function getAssetName(ObjectType $objectType)
    {
        return match ($objectType) {
            // bases
            self::TOWN_BASE_ONE => 'townbasetier1',
            self::TOWN_BASE_TWO => 'townbasetier2',
            self::TOWN_BASE_THREE => 'townbasetier2',
            self::RELIC_BASE_ONE => 'relicbase',
            self::RELIC_BASE_TWO => 'relicbase',
            self::RELIC_BASE_THREE => 'relicbase',
            self::GARRISON_STATION => 'safehouse',

            // industry
            self::HOSPITAL => 'hospital',
            self::VEHICLE_FACTORY => 'vehicle',
            self::REFINERY => 'manufacturing',
            self::SHIPYARD => 'shipyard',
            self::ENGINEERING_CENTER => 'techcenter',
            self::STORAGE_FACILITY => 'storagefacility',
            self::FACTORY => 'factory',
            self::CONSTRUCTION_YARD => 'constructionyard',
            self::MASS_PRODUCTION_FACTORY => 'massproductionfactory',
            self::SEAPORT => 'seaport',

            // resources
            self::SALVAGE_FIELD => 'salvage',
            self::COMPONENT_FIELD => 'components',
            self::SULFUR_FIELD => 'sulfur',
            self::SULFUR_MINE => 'sulfurmine',
            self::SALVAGE_MINE => 'scrapmine',
            self::OIL_WELL => 'fuel',
            self::COMPONENT_MINE => 'componentmine',

            // strategic
            self::SPECIAL_BASE => 'skeep',
            self::OBSERVATION_TOWER => 'observationtower',
            self::ROCKET_SITE => 'rocketfacility',
            self::COASTAL_GUN => 'coastalgun',
            self::STORM_CANNON => 'stormcannon',
            self::INTEL_CENTER => 'intelcenter',
        };
    }
}
