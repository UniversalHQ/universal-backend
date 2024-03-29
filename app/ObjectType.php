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
    case COAL_FIELD = 61;
    case OIL_FIELD = 62;

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
                self::COAL_FIELD,
                self::OIL_FIELD,
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

    public static function categoryForCase(ObjectType $objectType)
    {
        return match ($objectType) {
            self::TOWN_BASE_ONE,
            self::TOWN_BASE_TWO,
            self::TOWN_BASE_THREE,
            self::RELIC_BASE_ONE,
            self::RELIC_BASE_TWO,
            self::RELIC_BASE_THREE,
            self::GARRISON_STATION => 'bases',

            self::HOSPITAL,
            self::VEHICLE_FACTORY,
            self::REFINERY,
            self::SHIPYARD,
            self::ENGINEERING_CENTER,
            self::STORAGE_FACILITY,
            self::FACTORY,
            self::CONSTRUCTION_YARD,
            self::MASS_PRODUCTION_FACTORY,
            self::SEAPORT => 'industry',

            self::SALVAGE_FIELD,
            self::COMPONENT_FIELD,
            self::SULFUR_FIELD,
            self::SULFUR_MINE,
            self::SALVAGE_MINE,
            self::COAL_FIELD,
            self::OIL_FIELD,
            self::COMPONENT_MINE => 'resources',

            self::SPECIAL_BASE,
            self::OBSERVATION_TOWER,
            self::ROCKET_SITE,
            self::COASTAL_GUN,
            self::STORM_CANNON,
            self::INTEL_CENTER => 'strategic',
        };
    }

    public static function getAssetName(ObjectType $objectType, string $team)
    {
        return 'MapIcon' . self::getBaseName($objectType) . self::getTeamName($team);
    }

    protected static function getBaseName(ObjectType $objectType)
    {
        return match ($objectType) {
            // bases
            self::TOWN_BASE_ONE => 'TownBaseTier1',
            self::TOWN_BASE_TWO => 'TownBaseTier2',
            self::TOWN_BASE_THREE => 'TownBaseTier3',
            self::RELIC_BASE_ONE => 'RelicBase',
            self::RELIC_BASE_TWO => 'RelicBase',
            self::RELIC_BASE_THREE => 'RelicBase',
            self::GARRISON_STATION => 'Safehouse',

            // industry
            self::HOSPITAL => 'Medical',
            self::VEHICLE_FACTORY => 'Vehicle',
            self::REFINERY => 'Manufacturing',
            self::SHIPYARD => 'Shipyard',
            self::ENGINEERING_CENTER => 'TechCenter',
            self::STORAGE_FACILITY => 'StorageFacility',
            self::FACTORY => 'Factory',
            self::CONSTRUCTION_YARD => 'ConstructionYard',
            self::MASS_PRODUCTION_FACTORY => 'MassProductionFactory',
            self::SEAPORT => 'Seaport',

            // resources
            self::SALVAGE_FIELD => 'SalvageColor',
            self::COMPONENT_FIELD => 'ComponentsColor',
            self::COMPONENT_MINE => 'ComponentMineColor',
            self::SULFUR_FIELD => 'SulfurColor',
            self::SULFUR_MINE => 'SulfurMineColor',
            self::SALVAGE_MINE => 'SalvageMineColor',
            self::COAL_FIELD => 'CoalFieldColor',
            self::OIL_FIELD => 'OilFieldColor',
            self::OIL_WELL => 'OilFieldColor',

            // strategic
            self::SPECIAL_BASE => 'FortKeep',
            self::OBSERVATION_TOWER => 'ObservationTower',
            self::ROCKET_SITE => 'RocketSite',
            self::COASTAL_GUN => 'CoastalGun',
            self::STORM_CANNON => 'StormCannon',
            self::INTEL_CENTER => 'IntelCenter',
        };
    }

    public static function getRanges($objectType): array
    {
        return match ($objectType) {
            // bases
            self::TOWN_BASE_ONE => [
                [
                    'range' => 150,
                    'type'  => 'ai'
                ]
            ],
            self::TOWN_BASE_TWO => [
                [
                    'range' => 150,
                    'type'  => 'ai'
                ]
            ],
            self::TOWN_BASE_THREE => [
                [
                    'range' => 150,
                    'type'  => 'ai'
                ]
            ],
            self::RELIC_BASE_ONE => [
                [
                    'range' => 150,
                    'type'  => 'ai'
                ]
            ],
            self::RELIC_BASE_TWO => [
                [
                    'range' => 150,
                    'type'  => 'ai'
                ]
            ],
            self::RELIC_BASE_THREE => [
                [
                    'range' => 150,
                    'type'  => 'ai'
                ]
            ],
            self::GARRISON_STATION => [
                [
                    'range' => 100,
                    'type'  => 'ai'
                ]
            ],

            // strategic
            self::SPECIAL_BASE => [
                [
                    'range' => 80,
                    'type'  => 'ai'
                ]
            ],
            self::OBSERVATION_TOWER => [
                [
                    'range' => 240,
                    'type'  => 'intel'
                ],
            ],
            self::COASTAL_GUN => [
                [
                    'range' => 100,
                    'type'  => 'arty'
                ],
                [
                    'range' => 150,
                    'type'  => 'arty'
                ],
            ],
            self::STORM_CANNON => [
                [
                    'range' => 100,
                    'type'  => 'arty'
                ],
                [
                    'range' => 400,
                    'type'  => 'arty'
                ],
                [
                    'range' => 1000,
                    'type'  => 'arty'
                ],
                [
                    'range' => 1300,
                    'type'  => 'arty'
                ],
            ],
            self::INTEL_CENTER => [
                [
                    'range' => 500,
                    'type'  => 'intel'
                ],
                [
                    'range' => 2000,
                    'type'  => 'intel'
                ],
            ],
            default => []
        };
    }

    protected static function getTeamName(string $teamName): string
    {
        return match ($teamName) {
            'COLONIALS' => 'Colonial',
            'WARDENS' => 'Warden',
            'NONE' => '',
        };
    }
}
