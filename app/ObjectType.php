<?php

namespace App;

enum ObjectType: int
{
    case STATIC_BASE_ONE = 5; // deprecate
    case STATIC_BASE_TWO = 6; // deprecate
    case STATIC_BASE_THREE = 7; // deprecate
    case FORWARD_BASE_ONE = 8;
    case FORWARD_BASE_TWO = 9;
    case FORWARD_BASE_THREE = 10;
    case HOSPITAL = 11;
    case VEHICLE_FACTORY = 12;
    case ARMORY = 13;
    case SUPPLY_STATION = 14;
    case WORKSHOP = 15;
    case MANUFACTURING_PLANT = 16;
    case REFINERY = 17;
    case SHIPYARD = 18;
    case TECH_CENTER = 19;
    case SALVAGE_FIELD = 20;
    case COMPONENT_FIELD = 21;
    case FUEL_FIELD = 22;
    case SULFUR_FIELD = 23;
    case WORLD_MAP_TENT = 24;
    case TRAVEL_TENT = 25;
    case TRAINING_AREA = 26;
    case SPECIAL_BASE = 27;
    case OBSERVATION_TOWER = 28;
    case FORT = 29;
    case TROOP_SHIP = 30;
    case SULFUR_MINE = 32;
    case STORAGE_FACILITY = 33;
    case FACTORY = 34;
    case GARRISON_STATION = 35;
    case AMMO_FACTORY = 36;
    case ROCKET_SITE = 37;
    case SALVAGE_MINE = 38;
    case CONSTRUCTION_YARD = 39;
    case COMPONENT_MINE = 40;
    case OIL_WELL = 41;
    case CURSED_FORT = 44;
    case RELIC_BASE_ONE = 45;
    case RELIC_BASE_TWO = 46;
    case RELIC_BASE_THREE = 47;
    case MASS_PRODUCTION_FACTORY = 51;
    case SEAPORT = 52;
    case COASTAL_GUN = 53;
    case SOUL_FACTORY = 54;
    case TOWN_BASE_ONE = 56;
    case TOWN_BASE_TWO = 57;
    case TOWN_BASE_THREE = 58;
    case STORM_CANNON = 59;
    case INTEL_CENTER = 60;
}
