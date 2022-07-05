<?php

namespace App\Services\Map;

enum RegionHex: int
{
    case DeadLandsHex = 3;
    case CallahansPassageHex = 4;
    case MarbanHollow = 5;
    case UmbralWildwoodHex = 6;
    case MooringCountyHex = 7;
    case HeartlandsHex = 8;
    case LochMorHex = 9;
    case LinnMercyHex = 10;
    case ReachingTrailHex = 11;
    case StonecradleHex = 12;
    case FarranacCoastHex = 13;
    case WestgateHex = 14;
    case FishermansRowHex = 15;
    case OarbreakerHex = 16;
    case GreatMarchHex = 17;
    case TempestIslandHex = 18;
    case GodcroftsHex = 19;
    case EndlessShoreHex = 20;
    case AllodsBightHex = 21;
    case WeatheredExpanseHex = 22;
    case DrownedValeHex = 23;
    case ShackledChasmHex = 24;
    case ViperPitHex = 25;
    case NevishLineHex = 29;
    case AcrithiaHex = 30;
    case RedRiverHex = 31;
    case CallumsCapeHex = 32;
    case SpeakingWoodsHex = 33;
    case BasinSionnachHex = 34;
    case HowlCountyHex = 35;
    case ClansheadValleyHex = 36;
    case MorgensCrossingHex = 37;
    case TheFingersHex = 38;
    case TerminusHex = 39;
    case KalokaiHex = 40;
    case AshFieldsHex = 41;
    case OriginHex = 42;

    public function getYScalar(): string
    {
        return match ($this) {
            RegionHex::DeadLandsHex => 0,
            RegionHex::CallahansPassageHex => 1,
            RegionHex::MarbanHollow => 0.5,
            RegionHex::UmbralWildwoodHex => -1,
            RegionHex::MooringCountyHex => 1.5,
            RegionHex::HeartlandsHex => -1.5,
            RegionHex::LochMorHex => -0.5,
            RegionHex::LinnMercyHex => 0.5,
            RegionHex::ReachingTrailHex => 2,
            RegionHex::StonecradleHex => 1,
            RegionHex::FarranacCoastHex => 0,
            RegionHex::WestgateHex => -1,
            RegionHex::FishermansRowHex => -0.5,
            RegionHex::OarbreakerHex => 0.5,
            RegionHex::GreatMarchHex => -2,
            RegionHex::TempestIslandHex => -0.5,
            RegionHex::GodcroftsHex => 0.5,
            RegionHex::EndlessShoreHex => 0,
            RegionHex::AllodsBightHex => -1,
            RegionHex::WeatheredExpanseHex => 1,
            RegionHex::DrownedValeHex => -0.5,
            RegionHex::ShackledChasmHex => -1.5,
            RegionHex::ViperPitHex => 1.5,
            RegionHex::NevishLineHex => 1.5,
            RegionHex::AcrithiaHex => -2.5,
            RegionHex::RedRiverHex => -2.5,
            RegionHex::CallumsCapeHex => 2,
            RegionHex::SpeakingWoodsHex => 2.5,
            RegionHex::BasinSionnachHex => 3,
            RegionHex::HowlCountyHex => 2.5,
            RegionHex::ClansheadValleyHex => 2,
            RegionHex::MorgensCrossingHex => 1.5,
            RegionHex::TheFingersHex => -1.5,
            RegionHex::TerminusHex => -2,
            RegionHex::KalokaiHex => -3,
            RegionHex::AshFieldsHex => -2,
            RegionHex::OriginHex => -1.5,
        };
    }

    public function getXScalar(): string
    {
        return match ($this) {
            RegionHex::DeadLandsHex => 0,
            RegionHex::CallahansPassageHex => 0,
            RegionHex::MarbanHollow => 0.75,
            RegionHex::UmbralWildwoodHex => 0,
            RegionHex::MooringCountyHex => -0.75,
            RegionHex::HeartlandsHex => -0.75,
            RegionHex::LochMorHex => -0.75,
            RegionHex::LinnMercyHex => -0.75,
            RegionHex::ReachingTrailHex => 0,
            RegionHex::StonecradleHex => -1.5,
            RegionHex::FarranacCoastHex => -1.5,
            RegionHex::WestgateHex => -1.5,
            RegionHex::FishermansRowHex => -2.25,
            RegionHex::OarbreakerHex => -2.25,
            RegionHex::GreatMarchHex => 0,
            RegionHex::TempestIslandHex => 2.25,
            RegionHex::GodcroftsHex => 2.25,
            RegionHex::EndlessShoreHex => 1.5,
            RegionHex::AllodsBightHex => 1.5,
            RegionHex::WeatheredExpanseHex => 1.5,
            RegionHex::DrownedValeHex => 0.75,
            RegionHex::ShackledChasmHex => 0.75,
            RegionHex::ViperPitHex => 0.75,
            RegionHex::NevishLineHex => -2.25,
            RegionHex::AcrithiaHex => 0.75,
            RegionHex::RedRiverHex => -0.75,
            RegionHex::CallumsCapeHex => -1.5,
            RegionHex::SpeakingWoodsHex => -0.75,
            RegionHex::BasinSionnachHex => 0,
            RegionHex::HowlCountyHex => 0.75,
            RegionHex::ClansheadValleyHex => 1.5,
            RegionHex::MorgensCrossingHex => 2.25,
            RegionHex::TheFingersHex => 2.25,
            RegionHex::TerminusHex => 1.5,
            RegionHex::KalokaiHex => 0,
            RegionHex::AshFieldsHex => -1.5,
            RegionHex::OriginHex => -2.25,
        };
    }
}
