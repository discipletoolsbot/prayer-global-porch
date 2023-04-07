<?php
if ( !defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly.

class PG_Stacker {

    public static $show_all = false;

    /**
     * More guided
     * @param $grid_id
     * @return array
     */
    public static function build_location_stack( $grid_id ) {
        $stack['list'] = [];
        $lists = [];

        // BUILD FACTS
        $stack = self::_stack_query( $grid_id );

        /**************************/
        // PRAYER CONCEPTS
        /**************************/
        PG_Stacker_Text::_for_extraordinary_prayer( $lists, $stack );
        PG_Stacker_Text::_for_intentional_movement_strategy( $lists, $stack );
        PG_Stacker_Text::_for_abundant_gospel_sowing( $lists, $stack );
        PG_Stacker_Text::_for_persons_of_peace( $lists, $stack );
        PG_Stacker_Text::_for_prioritizing_priesthood_of_believers( $lists, $stack );
        PG_Stacker_Text::_for_unleashing_simple_churches( $lists, $stack );
        PG_Stacker_Text::_for_bible_access( $lists, $stack );
        PG_Stacker_Text::_for_internet_gospel_access( $lists, $stack );
        PG_Stacker_Text::_for_safety( $lists, $stack );
//        PG_Stacker_Text::_for_political_stability( $lists, $stack );

        PG_Stacker_Text::_for_demographic_feature_total_population( $lists, $stack );
        PG_Stacker_Text::_for_demographic_feature_population_non_christians( $lists, $stack );
//        PG_Stacker_Text::_for_demographic_feature_population_christian_adherents( $lists, $stack );
//        PG_Stacker_Text::_for_demographic_feature_population_believers( $lists, $stack );
//        PG_Stacker_Text::_for_demographic_feature_primary_religion( $lists, $stack );
//        PG_Stacker_Text::_for_demographic_feature_primary_language( $lists, $stack );

//        PG_Stacker_Text::_for_people_groups_by_least_reached_status( $lists, $stack );
//        PG_Stacker_Text::_for_people_groups_by_reached_status( $lists, $stack );
//        PG_Stacker_Text::_for_people_groups_by_religion( $lists, $stack );
//        PG_Stacker_Text::_for_people_groups_by_population( $lists, $stack );

        PG_Stacker_Text::_for_local_leadership( $lists, $stack );
        PG_Stacker_Text::_for_apostolic_pioneering_leadership( $lists, $stack );
        PG_Stacker_Text::_for_evangelistic_leadership( $lists, $stack );
        PG_Stacker_Text::_for_prophetic_leadership( $lists, $stack );
        PG_Stacker_Text::_for_shepherding_leadership( $lists, $stack );
        PG_Stacker_Text::_for_teaching_leadership( $lists, $stack );

        PG_Stacker_Text::_for_biblical_authority( $lists, $stack );
        PG_Stacker_Text::_for_obedience( $lists, $stack );
        PG_Stacker_Text::_for_reliance_on_god( $lists, $stack );
        PG_Stacker_Text::_for_faithfulness( $lists, $stack );
        PG_Stacker_Text::_for_love_and_generosity( $lists, $stack );
        PG_Stacker_Text::_for_kingdom_urgency( $lists, $stack );
        PG_Stacker_Text::_for_suffering( $lists, $stack );
//        PG_Stacker_Text::_cities( $lists, $stack );

        foreach ( $lists as $content ) { // kill duplication
            $content['id'] = hash( 'sha256', serialize( $content ) . microtime() );
            $stack['list'][$content['id']] = [
                'type' => 'basic_block',
                'data' => $content
            ];
        }
        shuffle( $stack['list'] ); // shuffle the list
        $stack['list'] = array_slice( $stack['list'], 0, 7 ); // limit to first 8

        /****************************/
        // PRAYER FACTS
        /****************************/
        PG_Stacker_Positions::_position_1( $stack );
        PG_Stacker_Positions::_position_2( $stack );
        PG_Stacker_Positions::_position_3( $stack );
        PG_Stacker_Positions::_position_4( $stack );
        PG_Stacker_Positions::_position_5( $stack );

        // REDUCE STACK
        $reduced_stack = [];
        $reduced_stack['list'] = $stack['list'];
        $reduced_stack['location'] = $stack['location'];
        $stack = $reduced_stack;

        return $stack;
    }

    public static function build_location_stats( $grid_id ) { // @todo is this being used?
        global $wpdb;

        $user_id = get_current_user_id();
        // get some basic stats on the country
        $stack = self::_stack_query( $grid_id );

        if ( $user_id ) {
            $community_activity = $wpdb->get_results( $wpdb->prepare( "
            SELECT r.value as minutes, r.timestamp as timestamp, p.post_title as group_name, IF(r.user_id = %d, 1, 0) as is_mine
            FROM $wpdb->dt_reports r
            JOIN $wpdb->posts p
            ON r.post_id = p.ID
            WHERE r.grid_id = %d
            AND r.type = 'prayer_app'
            ORDER BY r.timestamp DESC
            ", $user_id, $grid_id ), ARRAY_A );
        } else {
            $community_activity = $wpdb->get_results( $wpdb->prepare( "
            SELECT r.value as minutes, r.timestamp as timestamp, p.post_title as group_name, 0 as is_mine
            FROM $wpdb->dt_reports r
            JOIN $wpdb->posts p
            ON r.post_id = p.ID
            WHERE r.grid_id = %d
            AND r.type = 'prayer_app'
            ORDER BY r.timestamp DESC
            ", $grid_id ), ARRAY_A );
        }

        $community_stats = [
            "time_prayed" => [
                "me" => 0,
                "community" => 0,
                "total" => 0,
            ],
            "times_prayed" => [
                "me" => 0,
                "community" => 0,
                "total" => 0,
            ],
            "logs" => [],
        ];

        foreach ( $community_activity as $key => $activity ) {
            $community_activity[$key] = pg_soft_time_format( $activity, 'timestamp', 'when_text', 'when_time_formatted' );

            $minutes_prayed = (int) $activity['minutes'];
            $community_activity[$key]['time_prayed_text'] = ( $minutes_prayed === 1 ) ? "1 min" : "$minutes_prayed mins";
            $community_activity[$key]['is_mine'] = (int) $activity['is_mine'];

            if ( $activity['is_mine'] ) {
                $community_stats['times_prayed']['me'] += 1;
                $community_stats['time_prayed']['me'] += $minutes_prayed;
            } else {
                $community_stats['times_prayed']['community'] += 1;
                $community_stats['time_prayed']['community'] += $minutes_prayed;
            }
        }

        $community_stats['times_prayed']['total'] = $community_stats['times_prayed']['me'] + $community_stats['times_prayed']['community'];
        $community_stats['time_prayed']['total'] = $community_stats['time_prayed']['me'] + $community_stats['time_prayed']['community'];
        $community_stats['logs'] = $community_activity;

        $stack["stats"] = $community_stats;

        return $stack;
    }

    public static function build_user_location_stats( $grid_id = null, $offset = 0, $limit = 50 ) {
         global $wpdb;

        $user_id = get_current_user_id();

        if ( !$user_id ) {
            return [];
        }

        $sql = "
        SELECT r.value as minutes, r.timestamp as timestamp, p.post_title as group_name, l0.name as country_name, l.name as grid_name
        FROM $wpdb->dt_reports r
            JOIN $wpdb->posts p
                ON r.post_id = p.ID
            JOIN $wpdb->dt_location_grid l
                ON l.grid_id = r.grid_id
            JOIN $wpdb->dt_location_grid l0
                ON l0.grid_id = l.admin0_grid_id
            WHERE r.user_id = %d
                AND r.type = 'prayer_app'
        ";

        $args = [ $user_id ];

        if ( !is_null( $grid_id ) ) {
            $sql .= "AND r.grid_id = %d";
            $args[] = $grid_id;
        }

        $sql .= "
            ORDER BY r.timestamp DESC
            LIMIT %d, %d
        ";
        $args[] = $offset;
        $args[] = $limit;

        $user_activity = $wpdb->get_results( $wpdb->prepare( $sql, $args ), ARRAY_A ); // @phpcs:ignore

        $user_stats = [
            "offset" => (int) $offset,
            "limit" => (int) $limit,
            "logs" => [],
        ];

        foreach ($user_activity as $key => $activity) {
            $user_activity[$key] = pg_soft_time_format( $activity, 'timestamp', 'when_text', 'when_text_formatted' );

            $minutes_prayed = (int) $activity['minutes'];
            $user_activity[$key]['time_prayed_text'] = ( $minutes_prayed === 1 ) ? "1 min" : "$minutes_prayed mins";
            $user_activity[$key]['is_mine'] = 1;
            $user_activity[$key]['location_name'] = $activity['grid_name'] . ', ' . $activity['country_name'];
        }

        $user_stats['logs'] = $user_activity;

        return $user_stats;
    }

    public static function _stack_query( $grid_id ) {
        global $wpdb;

        // get record and level
        $grid_record = $wpdb->get_row( $wpdb->prepare( "
            SELECT
              g.grid_id,
              lgn.name,
              lgn.admin0_name,
              lgn.full_name,
              g.population,
              g.latitude,
              g.longitude,
              g.country_code,
              g.admin0_code,
              g.parent_id,
              p.name as parent_name,
              g.admin0_grid_id,
              g.admin1_grid_id,
              ga1.name as admin1_name,
              g.admin2_grid_id,
              ga2.name as admin2_name,
              g.admin3_grid_id,
              ga3.name as admin3_name,
              g.admin4_grid_id,
              ga4.name as admin4_name,
              g.admin5_grid_id,
              ga5.name as admin5_name,
              g.level,
              g.level_name,
              g.north_latitude,
              g.south_latitude,
              g.east_longitude,
              g.west_longitude,
              p.longitude as p_longitude,
              p.latitude as p_latitude,
              p.north_latitude as p_north_latitude,
              p.south_latitude as p_south_latitude,
              p.east_longitude as p_east_longitude,
              p.west_longitude as p_west_longitude,
              gc.longitude as c_longitude,
              gc.latitude as c_latitude,
              gc.north_latitude as c_north_latitude,
              gc.south_latitude as c_south_latitude,
              gc.east_longitude as c_east_longitude,
              gc.west_longitude as c_west_longitude,
              (SELECT count(pl.grid_id) FROM $wpdb->dt_location_grid pl WHERE pl.parent_id = g.parent_id) as peer_locations,
              lgf.birth_rate,
              lgf.death_rate,
              lgf.growth_rate,
              lgf.believers,
              lgf.christian_adherents,
              lgf.non_christians,
              lgf.primary_language,
              lgf.primary_religion,
              lgf.percent_believers,
              lgf.percent_christian_adherents,
              lgf.percent_non_christians
            FROM $wpdb->dt_location_grid as g
            LEFT JOIN $wpdb->dt_location_grid as gc ON g.admin0_grid_id=gc.grid_id
            LEFT JOIN $wpdb->dt_location_grid as ga1 ON g.admin1_grid_id=ga1.grid_id
            LEFT JOIN $wpdb->dt_location_grid as ga2 ON g.admin2_grid_id=ga2.grid_id
            LEFT JOIN $wpdb->dt_location_grid as ga3 ON g.admin3_grid_id=ga3.grid_id
            LEFT JOIN $wpdb->dt_location_grid as ga4 ON g.admin4_grid_id=ga4.grid_id
            LEFT JOIN $wpdb->dt_location_grid as ga5 ON g.admin5_grid_id=ga5.grid_id
            LEFT JOIN $wpdb->dt_location_grid as p ON g.parent_id=p.grid_id
            LEFT JOIN $wpdb->location_grid_facts as lgf ON g.grid_id=lgf.grid_id
            LEFT JOIN $wpdb->location_grid_names as lgn ON g.grid_id=lgn.grid_id AND lgn.language_code = 'en'
            WHERE g.grid_id = %s
        ", $grid_id ), ARRAY_A );


        // build the description
        if ( 'admin1' === $grid_record['level_name'] ) {
            $admin_level_name = 'state';
            $admin_level_name_plural = 'states';
        } else if ( 'admin0' === $grid_record['level_name'] ) {
            $admin_level_name = 'country';
            $admin_level_name_plural = 'countries';
        } else {
            $admin_level_name = 'county';
            $admin_level_name_plural = 'counties';
        }
        $grid_record = array_merge( $grid_record, [ 'admin_level_name' => $admin_level_name, 'admin_level_name_cap' => ucwords( $admin_level_name ), 'admin_level_name_plural' => $admin_level_name_plural ] );


        // format
        $grid_record['level'] = (int) $grid_record['level'];
        $grid_record['longitude'] = (float) $grid_record['longitude'];
        $grid_record['latitude'] = (float) $grid_record['latitude'];
        $grid_record['north_latitude'] = (float) $grid_record['north_latitude'];
        $grid_record['south_latitude'] = (float) $grid_record['south_latitude'];
        $grid_record['east_longitude'] = (float) $grid_record['east_longitude'];
        $grid_record['west_longitude'] = (float) $grid_record['west_longitude'];
        $grid_record['p_latitude'] = (float) $grid_record['p_latitude'];
        $grid_record['p_longitude'] = (float) $grid_record['p_longitude'];
        $grid_record['p_north_latitude'] = (float) $grid_record['p_north_latitude'];
        $grid_record['p_south_latitude'] = (float) $grid_record['p_south_latitude'];
        $grid_record['p_east_longitude'] = (float) $grid_record['p_east_longitude'];
        $grid_record['p_west_longitude'] = (float) $grid_record['p_west_longitude'];
        $grid_record['c_latitude'] = (float) $grid_record['c_latitude'];
        $grid_record['c_longitude'] = (float) $grid_record['c_longitude'];
        $grid_record['c_north_latitude'] = (float) $grid_record['c_north_latitude'];
        $grid_record['c_south_latitude'] = (float) $grid_record['c_south_latitude'];
        $grid_record['c_east_longitude'] = (float) $grid_record['c_east_longitude'];
        $grid_record['c_west_longitude'] = (float) $grid_record['c_west_longitude'];
        $grid_record['birth_rate'] = (float) $grid_record['birth_rate'];
        $grid_record['death_rate'] = (float) $grid_record['death_rate'];
        $grid_record['growth_rate'] = (float) $grid_record['growth_rate'];
        $grid_record['population_int'] = (int) $grid_record['population'];
        $grid_record['population'] = number_format( intval( $grid_record['population'] ) );
        $grid_record['believers_int'] = (int) $grid_record['believers'];
        $grid_record['believers'] = number_format( intval( $grid_record['believers'] ) );
        $grid_record['christian_adherents_int'] = (int) $grid_record['christian_adherents'];
        $grid_record['christian_adherents'] = number_format( intval( $grid_record['christian_adherents'] ) );
        $grid_record['non_christians_int'] = (int) $grid_record['non_christians'];
        $grid_record['non_christians'] = number_format( intval( $grid_record['non_christians'] ) );
        $grid_record['percent_believers_full'] = (float) $grid_record['percent_believers'];
        $grid_record['percent_believers'] = round( (float) $grid_record['percent_believers'], 2 );
        $grid_record['percent_christian_adherents_full'] = (float) $grid_record['percent_christian_adherents'];
        $grid_record['percent_christian_adherents'] = round( (float) $grid_record['percent_christian_adherents'], 2 );
        $grid_record['percent_non_christians_full'] = (float) $grid_record['percent_non_christians'];
        $grid_record['percent_non_christians'] = round( (float) $grid_record['percent_non_christians'], 2 );

        // lost
        $grid_record['all_lost_int'] = $grid_record['christian_adherents_int'] + $grid_record['non_christians_int'];
        $grid_record['all_lost'] = number_format( $grid_record['all_lost_int'] );
        if ( $grid_record['believers_int'] > 0 ) {
            $grid_record['lost_per_believer_int'] = (int) ceil( ( $grid_record['christian_adherents_int'] + $grid_record['non_christians_int'] ) / $grid_record['believers_int'] );
        } else {
            $grid_record['lost_per_believer_int'] = $grid_record['christian_adherents_int'] + $grid_record['non_christians_int'];
        }
        $grid_record['lost_per_believer'] = number_format( $grid_record['lost_per_believer_int'] );

        // process pace
        $grid_record['population_growth_status'] = self::_get_pace( 'population_growth_status', $grid_record );

        $grid_record['deaths_non_christians_next_hour'] = self::_get_pace( 'deaths_non_christians_next_hour', $grid_record );
        $grid_record['deaths_non_christians_next_100'] = self::_get_pace( 'deaths_non_christians_next_100', $grid_record );
        $grid_record['deaths_non_christians_next_week'] = self::_get_pace( 'deaths_non_christians_next_week', $grid_record );
        $grid_record['deaths_non_christians_next_month'] = self::_get_pace( 'deaths_non_christians_next_month', $grid_record );
        $grid_record['deaths_non_christians_next_year'] = self::_get_pace( 'deaths_non_christians_next_year', $grid_record );

        $grid_record['births_non_christians_last_hour'] = self::_get_pace( 'births_non_christians_last_hour', $grid_record );
        $grid_record['births_non_christians_last_100'] = self::_get_pace( 'births_non_christians_last_100', $grid_record );
        $grid_record['births_non_christians_last_week'] = self::_get_pace( 'births_non_christians_last_week', $grid_record );
        $grid_record['births_non_christians_last_month'] = self::_get_pace( 'births_non_christians_last_month', $grid_record );
        $grid_record['births_non_christians_last_year'] = self::_get_pace( 'births_non_christians_last_year', $grid_record );

        $grid_record['deaths_christian_adherents_next_hour'] = self::_get_pace( 'deaths_christian_adherents_next_hour', $grid_record );
        $grid_record['deaths_christian_adherents_next_100'] = self::_get_pace( 'deaths_christian_adherents_next_100', $grid_record );
        $grid_record['deaths_christian_adherents_next_week'] = self::_get_pace( 'deaths_christian_adherents_next_week', $grid_record );
        $grid_record['deaths_christian_adherents_next_month'] = self::_get_pace( 'deaths_christian_adherents_next_month', $grid_record );
        $grid_record['deaths_christian_adherents_next_year'] = self::_get_pace( 'deaths_christian_adherents_next_year', $grid_record );

        $grid_record['births_christian_adherents_last_hour'] = self::_get_pace( 'births_christian_adherents_last_hour', $grid_record );
        $grid_record['births_christian_adherents_last_100'] = self::_get_pace( 'births_christian_adherents_last_100', $grid_record );
        $grid_record['births_christian_adherents_last_week'] = self::_get_pace( 'births_christian_adherents_last_week', $grid_record );
        $grid_record['births_christian_adherents_last_month'] = self::_get_pace( 'births_christian_adherents_last_month', $grid_record );
        $grid_record['births_christian_adherents_last_year'] = self::_get_pace( 'births_christian_adherents_last_year', $grid_record );

        $grid_record['deaths_among_lost'] = self::_get_pace( 'deaths_among_lost', $grid_record );
        $grid_record['new_churches_needed'] = self::_get_pace( 'new_churches_needed', $grid_record );

        $status = [];
        for ($i = 1; $i <= $grid_record['percent_christian_adherents']; $i++) {
            $status[] = 'christian_adherents';
        }
        for ($i = 1; $i <= $grid_record['percent_non_christians']; $i++) {
            $status[] = 'non_christians';
        }
        for ($i = 1; $i <= $grid_record['percent_believers']; $i++) {
            $status[] = 'believers';
        }
        $grid_record['favor'] = $status[array_rand( $status )];

        if ( 'christian_adherents' === $grid_record['favor'] ) {
            $grid_record['icon_color'] = 'red';
        } else if ( 'non_christians' === $grid_record['favor'] ) {
            $grid_record['icon_color'] = 'orange';
        } else { // believers
            $grid_record['icon_color'] = 'green';
        }

        // build people groups list
        $people_groups = $wpdb->get_results($wpdb->prepare( "
            SELECT DISTINCT lgpg.*, FORMAT(lgpg.population, 0) as population, 'current' as query_level
                FROM $wpdb->location_grid_people_groups lgpg
                WHERE
                    lgpg.longitude < %d AND /* east */
                    lgpg.longitude >  %d AND /* west */
                    lgpg.latitude < %d AND /* north */
                    lgpg.latitude > %d AND /* south */
                    lgpg.admin0_grid_id = %d AND
                    lgpg.PrimaryReligion != 'Christianity'
                ORDER BY lgpg.LeastReached DESC
                LIMIT 20
        ", $grid_record['east_longitude'], $grid_record['west_longitude'], $grid_record['north_latitude'], $grid_record['south_latitude'], $grid_record['admin0_grid_id'] ), ARRAY_A );
        if ( empty( $people_groups ) ) {
            $people_groups = $wpdb->get_results($wpdb->prepare( "
                SELECT DISTINCT lgpg.*, FORMAT(lgpg.population, 0) as population, 'parent' as query_level
                    FROM $wpdb->location_grid_people_groups lgpg
                    WHERE
                        lgpg.longitude < %d AND /* east */
                        lgpg.longitude >  %d AND /* west */
                        lgpg.latitude < %d AND /* north */
                        lgpg.latitude > %d AND /* south */
                        lgpg.admin0_grid_id = %d AND
                        lgpg.PrimaryReligion != 'Christianity'
                    ORDER BY lgpg.LeastReached DESC
                    LIMIT 20
            ", $grid_record['p_east_longitude'], $grid_record['p_west_longitude'], $grid_record['p_north_latitude'], $grid_record['p_south_latitude'], $grid_record['admin0_grid_id'] ), ARRAY_A );
        }
        if ( empty( $people_groups ) ) {
            $people_groups = [];
        }
        shuffle( $people_groups ); // randomize results

        $least_reached = [];
        if ( ! empty( $people_groups ) ) {

            foreach ( $people_groups as $i => $pg ) {
                if ( 'Y' === $pg['LeastReached'] ) {
                    $pg['diaspora_label'] = '';
                    if ( isset( $pg['IndigenousCode'] ) && 'N' === $pg['IndigenousCode'] ) {
                        $pg['diaspora_label'] = __( 'Diaspora', 'prayer-global' );
                    } else if ( isset( $pg['IndigenousCode'] ) && '?' === $pg['IndigenousCode'] ) {
                        $pg['diaspora_label'] = __( 'Possibly Diaspora', 'prayer-global' );
                    }
                    $least_reached = $pg; // get first least reached group
                    unset( $people_groups[$i] );
                    break;
                }
            }

            $people_groups = array_slice( $people_groups, 0, 5, true ); // trim to first 5 shuffled results

            $people_groups_list = [ 'names' => [], 'names_pop' => [] ];
            foreach ( $people_groups as $i => $pg ) {
                $people_groups_list['names'][] = $pg['name'];
                $pop = empty( $pg['population'] ) ? '' : ' ('.$pg['population'].')';
                $people_groups_list['names_pop'][] = $pg['name'] . $pop;
            }
            $grid_record['people_groups_list'] = implode( ', ', $people_groups_list['names'] );
            $grid_record['people_groups_list_w_pop'] = implode( ', ', $people_groups_list['names_pop'] );
        }

        // cities
        $cities = [];
        $where = '';
        if ( 0 === $grid_record['level'] ) {
            $where = ' WHERE lgpg.admin0_grid_id = '.$grid_record['grid_id'].' ';
        } else if ( 1 === $grid_record['level'] ) {
            $where = ' WHERE lgpg.admin1_grid_id = '.$grid_record['grid_id'].' ';
        } else if ( 2 === $grid_record['level'] ) {
            $where = ' WHERE lgpg.admin2_grid_id = '.$grid_record['grid_id'].' ';
        }
        if ( ! empty( $where ) ) {
            // @phpcs:disable
            $cities = $wpdb->get_results( "
            SELECT
                   lgpg.id,
                   lgpg.geonameid,
                   lgpg.name,
                   lgpg.full_name,
                   lgpg.admin0_name,
                   lgpg.latitude,
                   lgpg.longitude,
                   lgpg.timezone,
                   lgpg.population as population_int,
                   FORMAT(lgpg.population, 0) as population
                FROM $wpdb->location_grid_cities lgpg
                $where
                ORDER BY lgpg.population DESC
                LIMIT 5
        ", ARRAY_A );
            // @phpcs:enable
        }
        if ( ! empty( $cities ) ) {
            $cities_list = [ 'names' => [], 'names_pop' => [] ];
            foreach ( $cities as $city_value ) {
                $cities_list['names'][] = $city_value['name'];
                $pop = empty( $city_value['population'] ) ? '' : ' ('.$city_value['population'].')';
                $cities_list['names_pop'][] = $city_value['name'] . $pop;
            }
            $grid_record['cities_list'] = implode( ', ', $cities_list['names'] );
            $grid_record['cities_list_w_pop'] = implode( ', ', $cities_list['names_pop'] );
        }


        return [
            'location' => $grid_record,
            'cities' => $cities,
            'people_groups' => $people_groups,
            'least_reached' => $least_reached
        ];
    }

    public static function _get_pace( $type, $grid_record ) {
        $return_value = 0;
        $birth_rate = $grid_record['birth_rate'];
        $death_rate = $grid_record['death_rate'];
        $believers = $grid_record['believers_int'];
        $christian_adherents = $grid_record['christian_adherents_int'];
        $non_christians = $grid_record['non_christians_int'];
        $not_believers = $non_christians + $christian_adherents;

        switch ( $type ) {
            case 'births_non_christians_last_hour':
                $return_value = ( $birth_rate * ( $not_believers / 1000 ) ) / 365 / 24;
                break;
            case 'births_non_christians_last_100':
                $return_value = ( $birth_rate * ( $not_believers / 1000 ) ) / 365 / 24 * 100;
                break;
            case 'births_non_christians_last_week':
                $return_value = ( $birth_rate * ( $not_believers / 1000 ) ) / 365 * 7;
                break;
            case 'births_non_christians_last_month':
                $return_value = ( $birth_rate * ( $not_believers / 1000 ) ) / 365 * 30;
                break;
            case 'births_non_christians_last_year':
                $return_value = ( $birth_rate * ( $not_believers / 1000 ) );
                break;

            case 'deaths_non_christians_next_hour':
                $return_value = ( $death_rate * ( $not_believers / 1000 ) ) / 365 / 24;
                break;
            case 'deaths_non_christians_next_100':
                $return_value = ( $death_rate * ( $not_believers / 1000 ) ) / 365 / 24 * 100;
                break;
            case 'deaths_non_christians_next_week':
                $return_value = ( $death_rate * ( $not_believers / 1000 ) ) / 365 * 7;
                break;
            case 'deaths_non_christians_next_month':
                $return_value = ( $death_rate * ( $not_believers / 1000 ) ) / 365 * 30;
                break;
            case 'deaths_non_christians_next_year':
                $return_value = ( $death_rate * ( $not_believers / 1000 ) );
                break;
            case 'deaths_among_lost':
//                $number = [
//                    $grid_record['deaths_christian_adherents_next_100']
//                ];
//                $in_the_next = [
//
//                ];
                $return_value = '';
                break;

            case 'births_christian_adherents_last_hour':
                $return_value = ( $birth_rate * ( $christian_adherents / 1000 ) ) / 365 / 24;
                break;
            case 'births_christian_adherents_last_100':
                $return_value = ( $birth_rate * ( $christian_adherents / 1000 ) ) / 365 / 24 * 100;
                break;
            case 'births_christian_adherents_last_week':
                $return_value = ( $birth_rate * ( $christian_adherents / 1000 ) ) / 365 * 7;
                break;
            case 'births_christian_adherents_last_month':
                $return_value = ( $birth_rate * ( $christian_adherents / 1000 ) ) / 365 * 30;
                break;
            case 'births_christian_adherents_last_year':
                $return_value = ( $birth_rate * ( $christian_adherents / 1000 ) );
                break;

            case 'deaths_christian_adherents_next_hour':
                $return_value = ( $death_rate * ( $christian_adherents / 1000 ) ) / 365 / 24;
                break;
            case 'deaths_christian_adherents_next_100':
                $return_value = ( $death_rate * ( $christian_adherents / 1000 ) ) / 365 / 24 * 100;
                break;
            case 'deaths_christian_adherents_next_week':
                $return_value = ( $death_rate * ( $christian_adherents / 1000 ) ) / 365 * 7;
                break;
            case 'deaths_christian_adherents_next_month':
                $return_value = ( $death_rate * ( $christian_adherents / 1000 ) ) / 365 * 30;
                break;
            case 'deaths_christian_adherents_next_year':
                $return_value = ( $death_rate * ( $christian_adherents / 1000 ) );
                break;

            case 'population_growth_status':
                if ( $grid_record['growth_rate'] >= 1.3 ) {
                    $return_value = 'Fastest Growing in the World';
                } else if ( $grid_record['growth_rate'] >= 1.2 ) {
                    $return_value = 'Extreme Growth';
                } else if ( $grid_record['growth_rate'] >= 1.1 ) {
                    $return_value = 'Significant Growth';
                } else if ( $grid_record['growth_rate'] >= 1.0 ) {
                    $return_value = 'Stable, but with slight growth';
                } else if ( $grid_record['growth_rate'] >= .99 ) {
                    $return_value = 'Stable, but in slight decline';
                } else if ( $grid_record['growth_rate'] >= .96 ) {
                    $return_value = 'Extreme Decline';
                } else {
                    $return_value = 'Fastest Declining in the World';
                }
                return $return_value;

            case 'new_churches_needed':
                $return_value = $grid_record['population_int'] / 5000;
                if ( $return_value < 1 ) {
                    $return_value = $grid_record['population_int'] / 500;
                    if ( $return_value < 1 ) {
                        $return_value = $grid_record['population_int'] / 50;
                    }
                }
                break;

            default:
                break;
        }

        return number_format( intval( $return_value ) );
    }

}
