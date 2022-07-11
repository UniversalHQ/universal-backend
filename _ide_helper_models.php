<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{

    use Eloquent;
    use Illuminate\Database\Eloquent\Builder;

    /**
 * Class Map
 *
 * @package App\Models
 * @mixin IdeHelperMap
 * @property int $id
 * @property string $report_e_tag
 * @property string $static_e_tag
 * @property string $dynamic_e_tag
 * @property string $dynamic_timestamp
 * @property string $name
 * @property string $hex_name
 * @property string $region_id
 * @property int $active
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $colonial_casualties
 * @property-read mixed $day_of_war
 * @property-read mixed $total_enlistments
 * @property-read mixed $version
 * @property-read mixed $warden_casualties
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MapItem[] $mapItems
 * @property-read int|null $map_items_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MapObject[] $mapObjects
 * @property-read int|null $map_objects_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MapTextItem[] $mapTextItems
 * @property-read int|null $map_text_items_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MapWarReport[] $mapWarReports
 * @property-read int|null $map_war_reports_count
 * @property-read \App\Models\MapWarReport|null $warReport
 * @method static Builder|Map active()
 * @method static Builder|Map newModelQuery()
 * @method static Builder|Map newQuery()
 * @method static Builder|Map query()
 * @method static Builder|Map whereActive($value)
 * @method static Builder|Map whereCreatedAt($value)
 * @method static Builder|Map whereDeletedAt($value)
 * @method static Builder|Map whereDynamicETag($value)
 * @method static Builder|Map whereDynamicTimestamp($value)
 * @method static Builder|Map whereHexName($value)
 * @method static Builder|Map whereId($value)
 * @method static Builder|Map whereName($value)
 * @method static Builder|Map whereRegionId($value)
 * @method static Builder|Map whereReportETag($value)
 * @method static Builder|Map whereStaticETag($value)
 * @method static Builder|Map whereUpdatedAt($value)
 */
	class IdeHelperMap extends Eloquent {}

    /**
 * Class MapItem
 *
 * @package App\Models
 * @mixin IdeHelperMapItem
 * @property int $id
 * @property int $map_id
 * @property int|null $map_object_id
 * @property string $team_id
 * @property int $icon_type
 * @property int $flags
 * @property string $x
 * @property string $y
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Map $map
 * @property-read \App\Models\MapObject|null $mapObject
 * @method static Builder|MapItem newModelQuery()
 * @method static Builder|MapItem newQuery()
 * @method static Builder|MapItem query()
 * @method static Builder|MapItem whereCreatedAt($value)
 * @method static Builder|MapItem whereFlags($value)
 * @method static Builder|MapItem whereIconType($value)
 * @method static Builder|MapItem whereId($value)
 * @method static Builder|MapItem whereMapId($value)
 * @method static Builder|MapItem whereMapObjectId($value)
 * @method static Builder|MapItem whereTeamId($value)
 * @method static Builder|MapItem whereUpdatedAt($value)
 * @method static Builder|MapItem whereX($value)
 * @method static Builder|MapItem whereY($value)
 */
	class IdeHelperMapItem extends Eloquent {}

    /**
 * Class MapObject
 *
 * @package App\Models
 * @mixin IdeHelperMapObject
 * @property int $id
 * @property int $map_id
 * @property int $war_id
 * @property string $team_id
 * @property string $text
 * @property string $object_type
 * @property int $icon_type
 * @property bool $is_scorched
 * @property bool $is_victory_base
 * @property bool $is_build_site
 * @property string $x
 * @property string $y
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Map $map
 * @property-read \App\Models\MapItem|null $mapItem
 * @property-read \App\Models\MapTextItem|null $mapTextItem
 * @method static Builder|MapObject newModelQuery()
 * @method static Builder|MapObject newQuery()
 * @method static Builder|MapObject query()
 * @method static Builder|MapObject whereCreatedAt($value)
 * @method static Builder|MapObject whereIconType($value)
 * @method static Builder|MapObject whereId($value)
 * @method static Builder|MapObject whereIsBuildSite($value)
 * @method static Builder|MapObject whereIsScorched($value)
 * @method static Builder|MapObject whereIsVictoryBase($value)
 * @method static Builder|MapObject whereMapId($value)
 * @method static Builder|MapObject whereObjectType($value)
 * @method static Builder|MapObject whereTeamId($value)
 * @method static Builder|MapObject whereText($value)
 * @method static Builder|MapObject whereUpdatedAt($value)
 * @method static Builder|MapObject whereWarId($value)
 * @method static Builder|MapObject whereX($value)
 * @method static Builder|MapObject whereY($value)
 */
	class IdeHelperMapObject extends Eloquent {}

    /**
 * App\Models\MapObjectUpdate
 *
 * @mixin IdeHelperMapObjectUpdate
 * @property int $id
 * @property int $map_object_id
 * @property string|null $team_id
 * @property int|null $icon_type
 * @property string|null $object_type
 * @property int|null $is_scorched
 * @property int|null $is_victory_base
 * @property int|null $is_build_site
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static Builder|MapObjectUpdate newModelQuery()
 * @method static Builder|MapObjectUpdate newQuery()
 * @method static Builder|MapObjectUpdate query()
 * @method static Builder|MapObjectUpdate whereCreatedAt($value)
 * @method static Builder|MapObjectUpdate whereIconType($value)
 * @method static Builder|MapObjectUpdate whereId($value)
 * @method static Builder|MapObjectUpdate whereIsBuildSite($value)
 * @method static Builder|MapObjectUpdate whereIsScorched($value)
 * @method static Builder|MapObjectUpdate whereIsVictoryBase($value)
 * @method static Builder|MapObjectUpdate whereMapObjectId($value)
 * @method static Builder|MapObjectUpdate whereObjectType($value)
 * @method static Builder|MapObjectUpdate whereTeamId($value)
 * @method static Builder|MapObjectUpdate whereUpdatedAt($value)
 */
	class IdeHelperMapObjectUpdate extends Eloquent {}

    /**
 * Class MapTextItem
 *
 * @package App\Models
 * @mixin IdeHelperMapTextItem
 * @property int $id
 * @property int $map_id
 * @property int|null $map_object_id
 * @property string $text
 * @property string $map_marker_type
 * @property string $x
 * @property string $y
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Map $map
 * @property-read \App\Models\MapObject|null $mapObject
 * @method static Builder|MapTextItem newModelQuery()
 * @method static Builder|MapTextItem newQuery()
 * @method static Builder|MapTextItem query()
 * @method static Builder|MapTextItem whereCreatedAt($value)
 * @method static Builder|MapTextItem whereId($value)
 * @method static Builder|MapTextItem whereMapId($value)
 * @method static Builder|MapTextItem whereMapMarkerType($value)
 * @method static Builder|MapTextItem whereMapObjectId($value)
 * @method static Builder|MapTextItem whereText($value)
 * @method static Builder|MapTextItem whereUpdatedAt($value)
 * @method static Builder|MapTextItem whereX($value)
 * @method static Builder|MapTextItem whereY($value)
 */
	class IdeHelperMapTextItem extends Eloquent {}

    /**
 * Class MapWarReport
 *
 * @package App\Models
 * @mixin IdeHelperMapWarReport
 * @property int $id
 * @property int $map_id
 * @property int $war_id
 * @property string $name
 * @property int $totalEnlistments
 * @property int $colonialCasualties
 * @property int $wardenCasualties
 * @property int $dayOfWar
 * @property int $version
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Map $map
 * @property-read \App\Models\War $war
 * @method static Builder|MapWarReport newModelQuery()
 * @method static Builder|MapWarReport newQuery()
 * @method static Builder|MapWarReport query()
 * @method static Builder|MapWarReport whereColonialCasualties($value)
 * @method static Builder|MapWarReport whereCreatedAt($value)
 * @method static Builder|MapWarReport whereDayOfWar($value)
 * @method static Builder|MapWarReport whereDeletedAt($value)
 * @method static Builder|MapWarReport whereId($value)
 * @method static Builder|MapWarReport whereMapId($value)
 * @method static Builder|MapWarReport whereName($value)
 * @method static Builder|MapWarReport whereTotalEnlistments($value)
 * @method static Builder|MapWarReport whereUpdatedAt($value)
 * @method static Builder|MapWarReport whereVersion($value)
 * @method static Builder|MapWarReport whereWarId($value)
 * @method static Builder|MapWarReport whereWardenCasualties($value)
 */
	class IdeHelperMapWarReport extends Eloquent {}

    /**
 * App\Models\User
 *
 * @mixin IdeHelperUser
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereUpdatedAt($value)
 */
	class IdeHelperUser extends Eloquent {}

    /**
 * Class WarData
 *
 * @package App\Models
 * @mixin IdeHelperWar
 * @property int $id
 * @property string $war_id
 * @property int $war_number
 * @property int $required_victory_towns
 * @property string|null $winner
 * @property int $conquest_start_time
 * @property string|null $started_at
 * @property int|null $conquest_end_time
 * @property string|null $ended_at
 * @property int|null $resistance_start_time
 * @property string|null $resistance_at
 * @property string|null $active_tiles_string
 * @property string|null $active_resistance_tiles_string
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MapWarReport[] $mapWarReports
 * @property-read int|null $map_war_reports_count
 * @method static Builder|War newModelQuery()
 * @method static Builder|War newQuery()
 * @method static Builder|War query()
 * @method static Builder|War whereActiveResistanceTilesString($value)
 * @method static Builder|War whereActiveTilesString($value)
 * @method static Builder|War whereConquestEndTime($value)
 * @method static Builder|War whereConquestStartTime($value)
 * @method static Builder|War whereCreatedAt($value)
 * @method static Builder|War whereDeletedAt($value)
 * @method static Builder|War whereEndedAt($value)
 * @method static Builder|War whereId($value)
 * @method static Builder|War whereRequiredVictoryTowns($value)
 * @method static Builder|War whereResistanceAt($value)
 * @method static Builder|War whereResistanceStartTime($value)
 * @method static Builder|War whereStartedAt($value)
 * @method static Builder|War whereUpdatedAt($value)
 * @method static Builder|War whereWarId($value)
 * @method static Builder|War whereWarNumber($value)
 * @method static Builder|War whereWinner($value)
 */
	class IdeHelperWar extends Eloquent {}
}

