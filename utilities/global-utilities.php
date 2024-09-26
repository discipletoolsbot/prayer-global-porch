<?php

function pg_enabled_translations(){
    return [
        'en_US' => [
            'parent_code' => 'en',
            'po_code' => 'en_US',
            'datatables_url' => '',
            'firebase_code' => 'en',
        ],
        'fr_FR' => [
            'parent_code' => 'fr',
            'po_code' => 'fr_FR',
            'datatables_url' => '//cdn.datatables.net/plug-ins/1.13.4/i18n/fr-FR.json',
            'firebase_code' => 'fr',
        ],
    ];
}

function pg_generate_key() {
    return substr( md5( mt_rand( 10000, 100000 ).time() ), 0, 3 ) . substr( md5( mt_rand( 10000, 100000 ).time() ), 10, 3 );
}
function pg_grid_images_json(){
    return get_option( 'pg_grid_images_json' );
}
function pg_jp_images_json(){
    return get_option( 'pg_jp_images_json' );
}
function pg_grid_images_version(){
    return get_option( 'pg_grid_images_version' );
}
function pg_jp_images_version(){
    return get_option( 'pg_jp_images_version' );
}
function pg_current_global_lap() : array {
    /**
     * Example:
     *  [lap_number] => 5
     *  [post_id] => 19
     *  [key] => d7dcd4
     *  [start_time] => 1651269768
     */
    $lap = get_option( 'pg_current_global_lap', [] );
    return $lap;
}

function pg_current_custom_lap( int $post_id ) : array {
    /* Search down the child lap tree to find the last lap that is active. That is the current custom lap. */
    global $wpdb;

    /* === THIS QUERY WORKS UP TO MYSQL 5.7 AND SHOULD BE REMOVED IN FAVOR OF BELOW QUERY WHEN MYSQL IS UPGRADED TO 8 === */
    $results = $wpdb->get_results( $wpdb->prepare(
        "SELECT
            t.p2p_from,
            @pv:= t.p2p_to p2p_to,
            t.p2p_to as post_id
        FROM ( SELECT * FROM wp_p2p ORDER BY p2p_from ASC ) t
        JOIN ( SELECT @pv := %d ) tmp
        WHERE p2p_type = 'parent-lap_to_child-lap'
        AND t.p2p_from = @pv;",
    $post_id ), ARRAY_A );

    /* === THIS QUERY SHOULD BE USED WHEN THE MYSQL DB IS UPGRADED TO 8 IN FAVOR OF THE ABOVE ONE === */
    /*$results = $wpdb->get_results( $wpdb->prepare(
        "WITH RECURSIVE cte ( p2p_from_, p2p_to_ ) AS (
            SELECT p2p_from, p2p_to FROM $wpdb->p2p WHERE p2p_from = %d AND p2p_type = 'parent-lap_to_child-lap'
            UNION ALL
            SELECT
                c.p2p_to_, p.p2p_to
            FROM
                cte c
            JOIN
                $wpdb->p2p p
            ON
                c.p2p_to_ = p.p2p_from
            AND
                p.p2p_type = 'parent-lap_to_child-lap'
        )
        SELECT p2p_to_, p2p_from_, c.p2p_to_ as post_id
        FROM cte c

    ", [ $post_id ] ), ARRAY_A );
    */
    if ( is_wp_error( $results ) ) {
        return [];
    }

    if ( empty( $results ) ) {
        $current_lap_post_id = $post_id;
    } else {
        $current_lap_details = $results[ count( $results ) - 1 ];
        $current_lap_post_id = $current_lap_details['post_id'];
    }



    $current_lap = pg_get_custom_lap_by_post_id( $current_lap_post_id );

    if ( !$current_lap ) {
        return [];
    }

    return $current_lap;
}

/**
 * @param $key
 * @return array|false
 */
function pg_get_global_lap_by_key( $key ) {

//    if ( wp_cache_get( __METHOD__. $key ) ) {
//        return wp_cache_get( __METHOD__. $key );
//    }

    global $wpdb;
    $result = $wpdb->get_row( $wpdb->prepare(
        "SELECT pm.meta_value as lap_key, pm1.meta_value as lap_number, pm.post_id, pm2.meta_value as start_time, pm3.meta_value as end_time, p.post_title as title
                    FROM $wpdb->postmeta pm
                    LEFT JOIN $wpdb->postmeta pm1 ON pm.post_id=pm1.post_id AND pm1.meta_key = 'global_lap_number'
                    LEFT JOIN $wpdb->postmeta pm2 ON pm.post_id=pm2.post_id AND pm2.meta_key = 'start_time'
                    LEFT JOIN $wpdb->postmeta pm3 ON pm.post_id=pm3.post_id AND pm3.meta_key = 'end_time'
                    LEFT JOIN $wpdb->posts p ON pm.post_id=p.ID
                    WHERE pm.meta_key = 'prayer_app_global_magic_key' AND pm.meta_value = %s",
        $key
    ), ARRAY_A);

    if ( empty( $result ) ) {
        $lap = false;
    } else {
        $ongoing = false;
        if ( empty( $result['end_time'] ) ) {
            $result['end_time'] = time();
            $ongoing = true;
        }
        $lap = [
            'title' => $result['title'],
            'lap_number' => (int) $result['lap_number'],
            'post_id' => (int) $result['post_id'],
            'key' => $result['lap_key'],
            'start_time' => (int) $result['start_time'],
            'end_time' => (int) $result['end_time'],
            'on_going' => $ongoing
        ];
    }

//    wp_cache_set( __METHOD__.$key, $lap );

    return $lap;
}

/**
 * @param int|string $post_id
 *
 * @return array
 */
function pg_get_custom_lap_by_post_id( $post_id ) {

//    if ( wp_cache_get( __METHOD__. $post_id ) ) {
//        return wp_cache_get( __METHOD__. $post_id );
//    }

    $result = DT_Posts::get_post( 'laps', $post_id, true, false );

    if ( is_wp_error( $result ) ) {
        $lap = false;
    } else if ( empty( $result ) ) {
        $lap = false;
    } else {
        $ongoing = false;
        if ( empty( $result['end_time'] ) ) {
            $result['end_time'] = time();
            $ongoing = true;
        }
        $contacts = [];
        if ( !empty( $result['contacts'] ) ) {
            foreach ( $result['contacts'] as $contact ) {
                $contacts[] = $contact['ID'];
            }
        }

        $lap = [
            'title' => $result['title'],
            'lap_number' => (int) isset( $result['global_lap_number'] ) ? $result['global_lap_number'] : 1,
            'post_id' => (int) $post_id,
            'key' => $result['prayer_app_custom_magic_key'],
            'start_time' => (int) $result['start_time'],
            'end_time' => (int) isset( $result['end_time'] ) ? $result['end_time'] : time(),
            'on_going' => $ongoing,
            'visibility' => isset( $result['visibility'] ) ? $result['visibility'] : 'public',
            'challenge_type' => isset( $result['challenge_type'] ) ? $result['challenge_type'] : 'ongoing',
            'single_lap' => isset( $result['single_lap'] ) ? $result['single_lap'] : false,
            'assigned_to' => isset( $result['assigned_to'] ) ? $result['assigned_to'] : null,
            'contacts' => $contacts,
            'ctas_off' => isset( $result['ctas_off'] ) ? $result['ctas_off'] : false,
        ];
    }

//    wp_cache_set( __METHOD__.$post_id, $lap );

    return $lap;
}

function pg_get_global_lap_by_lap_number( $lap_number ) {

//    if ( wp_cache_get( __METHOD__.$lap_number ) ) {
//        return wp_cache_get( __METHOD__.$lap_number );
//    }

    global $wpdb;
    $result = $wpdb->get_row( $wpdb->prepare(
        "SELECT pm.meta_value as lap_number, pm1.meta_value as lap_key, pm.post_id, pm2.meta_value as start_time, pm3.meta_value as end_time, p.post_title as title
                    FROM $wpdb->postmeta pm
                    LEFT JOIN $wpdb->postmeta pm1 ON pm.post_id=pm1.post_id AND pm1.meta_key = 'prayer_app_global_magic_key'
                    LEFT JOIN $wpdb->postmeta pm2 ON pm.post_id=pm2.post_id AND pm2.meta_key = 'start_time'
                    LEFT JOIN $wpdb->postmeta pm3 ON pm.post_id=pm3.post_id AND pm3.meta_key = 'end_time'
                    LEFT JOIN $wpdb->posts p ON pm.post_id=p.ID
                    WHERE pm.meta_key = 'global_lap_number' AND pm.meta_value = %d",
        $lap_number
    ), ARRAY_A);

    if ( empty( $result ) ) {
        $lap = false;
    } else {
        $ongoing = false;
        if ( empty( $result['end_time'] ) ) {
            $result['end_time'] = time();
            $ongoing = true;
        }
        $lap = [
            'title' => $result['title'],
            'lap_number' => (int) $result['lap_number'],
            'post_id' => (int) $result['post_id'],
            'key' => $result['lap_key'],
            'start_time' => (int) $result['start_time'],
            'end_time' => (int) $result['end_time'],
            'on_going' => $ongoing
        ];
    }

//    wp_cache_set( __METHOD__.$lap_number, $lap );

    return $lap;
}
function pg_global_stats_by_lap_number( $lap_number ) {
    $data = pg_get_global_lap_by_lap_number( $lap_number );
    _pg_global_stats_builder_query( $data );
    return _pg_stats_builder( $data );
}
function pg_global_stats_by_key( $key ) {
    $data = pg_get_global_lap_by_key( $key );
    _pg_global_stats_builder_query( $data );
    return _pg_stats_builder( $data );
}
function pg_get_global_race(){

//    if ( wp_cache_get( __METHOD__ ) ) {
//        return wp_cache_get( __METHOD__ );
//    }

    global $wpdb;
    $result = $wpdb->get_row(
        "SELECT pm.meta_value as lap_number, pm1.meta_value as lap_key, pm.post_id, pm2.meta_value as start_time, pm3.meta_value as end_time, p.post_title as title
            FROM $wpdb->postmeta pm
            LEFT JOIN $wpdb->postmeta pm1 ON pm.post_id=pm1.post_id AND pm1.meta_key = 'prayer_app_global_magic_key'
            LEFT JOIN $wpdb->postmeta pm2 ON pm.post_id=pm2.post_id AND pm2.meta_key = 'start_time'
            LEFT JOIN $wpdb->postmeta pm3 ON pm.post_id=pm3.post_id AND pm3.meta_key = 'end_time'
            LEFT JOIN $wpdb->posts p ON pm.post_id=p.ID
            WHERE pm.meta_key = 'global_lap_number' AND pm.meta_value = '1'", ARRAY_A); // queries the first global lap

    $lap = [
        'title' => $result['title'],
        'lap_number' => (int) $result['lap_number'],
        'post_id' => (int) $result['post_id'],
        'key' => $result['lap_key'],
        'start_time' => (int) $result['start_time'],
        'end_time' => time(), // current time is the end of the query
        'on_going' => true,
    ];

//    wp_cache_set( __METHOD__, $lap );

    return $lap;
}

function pg_global_race_stats() {
    $current_lap = pg_current_global_lap();
    $data = pg_get_global_race();
    $data['number_of_laps'] = $current_lap['lap_number'];
    _pg_global_stats_builder_query( $data );
    return _pg_stats_builder( $data );
}
function _pg_global_stats_builder_query( &$data ) {
    global $wpdb;
    $counts = $wpdb->get_row( $wpdb->prepare( "
       SELECT SUM(r.value) as minutes_prayed, COUNT( DISTINCT( r.grid_id ) ) as locations_completed, COUNT( DISTINCT( r.hash ) ) as participants, COUNT(DISTINCT(r.label)) as participant_country_count
       FROM $wpdb->dt_reports r
        WHERE r.post_type = 'laps'
            AND r.type = 'prayer_app'
       AND r.timestamp >= %d AND r.timestamp <= %d
    ", $data['start_time'], $data['end_time'] ), ARRAY_A );
    $data['locations_completed'] = (int) $counts['locations_completed'];
    $data['participants'] = (int) $counts['participants'];
    $data['minutes_prayed'] = (int) $counts['minutes_prayed'];
    $data['participant_country_count'] = (int) $counts['participant_country_count'];

    return $data;
}
function pg_custom_lap_stats_by_post_id( $post_id ) {
    $data = pg_get_custom_lap_by_post_id( $post_id );
    _pg_custom_stats_builder_query( $data );
    return _pg_stats_builder( $data );
}
function _pg_custom_stats_builder_query( &$data ) {
    global $wpdb;
    $counts = $wpdb->get_row( $wpdb->prepare( "
       SELECT SUM(r.value) as minutes_prayed, COUNT( DISTINCT( r.grid_id ) ) as locations_completed, COUNT( DISTINCT( r.hash ) ) as participants, COUNT(DISTINCT(r.label)) as participant_country_count
       FROM $wpdb->dt_reports r
        WHERE r.post_type = 'laps'
            AND r.type = 'prayer_app'
       AND r.subtype = 'custom' AND r.post_id = %d
    ", $data['post_id'] ), ARRAY_A );

    $data['locations_completed'] = (int) $counts['locations_completed'];
    $data['participants'] = (int) $counts['participants'];
    $data['minutes_prayed'] = (int) $counts['minutes_prayed'];
    $data['participant_country_count'] = (int) $counts['participant_country_count'];

    return $data;
}

function _pg_stats_builder( $data ) : array {
//    dt_write_log(__METHOD__);
    /**
     * TIME CALCULATIONS
     */
    $now = $data['end_time'];
    $time_difference = $now - $data['start_time'];
    _pg_format_duration( $data, $time_difference, 'time_elapsed', 'time_elapsed_small' );

    $prayer_speed = (int) $time_difference !== 0 ? (int) $data['locations_completed'] / $time_difference : 0;
    $locations_per_hour = $prayer_speed * 60 * 60;
    $locations_per_day = $locations_per_hour * 24;
    $data['locations_per_hour'] = $locations_per_hour < 1 && $locations_per_hour !== 0 ? number_format( $locations_per_hour, 2 ) : number_format( $locations_per_hour );
    $data['locations_per_day'] = $locations_per_day < 1 && $locations_per_day !== 0 ? number_format( $locations_per_day, 2 ) : number_format( $locations_per_day );

    if ( $data['on_going'] === false ) {
        $time_remaining = $data['end_time'] - $now;
        _pg_format_duration( $data, $time_remaining, 'time_remaining', 'time_remaining_small' );

        $locations_remaining = PG_TOTAL_STATES - (int) $data['locations_completed'];
        $needed_prayer_speed = $time_remaining !== 0 ? $locations_remaining / $time_remaining : 0;
        $locations_per_hour = $needed_prayer_speed * 60 * 60;
        $locations_per_day = $locations_per_hour * 24;
        $data['needed_locations_per_hour'] = $locations_per_hour < 1 && $locations_per_hour !== 0 ? number_format( $locations_per_hour, 2 ) : number_format( $locations_per_hour );
        $data['needed_locations_per_day'] = $locations_per_day < 1 && $locations_per_day !== 0 ? number_format( $locations_per_day, 2 ) : number_format( $locations_per_day );
    }
    /**
     * QUANTITY OF PRAYER
     */
    $minutes_prayed = (int) $data['minutes_prayed'];
    $data['minutes_prayed'] = number_format( $minutes_prayed );
    $data['minutes_prayed_int'] = $minutes_prayed;
    $seconds_prayed = $minutes_prayed * 60;
    _pg_format_duration( $data, $seconds_prayed, 'minutes_prayed_formatted', 'minutes_prayer_formatted_small' );

    /**
     * COMPLETED & REMAINING
     */
    $completed = (int) $data['locations_completed'];
    if ( PG_TOTAL_STATES < $completed ) {
        $completed = PG_TOTAL_STATES;
    }
    $data['completed'] = number_format( $completed );
    $data['completed_int'] = $completed;
    $completed_percent = ROUND( $completed / PG_TOTAL_STATES * 100, 0 );
    if ( 100 < $completed_percent ) {
        $completed_percent = 100;
    }
    $data['completed_percent'] = $completed_percent;
    $remaining = PG_TOTAL_STATES - $completed;
    if ( 0 > $remaining ) {
        $remaining = 0;
    }
    $data['remaining'] = number_format( $remaining );
    $data['remaining_int'] = $remaining;
    $data['remaining_percent'] = 100 - $data['completed_percent'];

    /**
     * PARTICIPANTS
     */
    $participants = (int) $data['participants'];
    $data['participants'] = number_format( $participants );
    $data['participants_int'] = $participants;

    $data['start_time_formatted'] = gmdate( 'M d, Y', $data['start_time'] );
    $data['end_time_formatted'] = gmdate( 'M d, Y', $data['end_time'] );

//    dt_write_log(__METHOD__);
//    dt_write_log($data);
    return $data;
}

function _pg_format_duration( &$data, $time, $key_long, $key_short, $key_data = '' ) {

    if ( empty( $key_data ) ) {
        $key_data = $key_long . '_data';
    }

    if ( $time === 0 ) {
        $data[$key_long] = "--";
        $data[$key_short] = "--";
        return;
    }
    $days = floor( $time / 60 / 60 / 24 );
    $hours = floor( ( $time / 60 / 60 ) - ( $days * 24 ) );
    $minutes = floor( ( $time / 60 ) - ( $hours * 60 ) - ( $days * 24 * 60 ) );
    if ( empty( $days ) && empty( $hours ) ){
        $data[$key_long] = "$minutes minutes";
        $data[$key_short] = $minutes." min";
        $data[$key_data] = [
            'minutes' => $minutes,
        ];
    }
    else if ( empty( $days ) ) {
        $data[$key_long] = "$hours hours, $minutes minutes";
        $data[$key_short] = $hours."h, ".$minutes."m";
        $data[$key_data] = [
            'minutes' => $minutes,
            'hours' => $hours,
        ];
    }
    else if ( $days > 365 ) {
        $years = floor( $time / 60 / 60 / 24 / 365 );
        $days = floor( $days - ( $years * 365 ) );
        $data[$key_long] = "$years years, $days days, $hours hours, $minutes minutes";
        $data[$key_short] = $years."y, ".$days."d, ".$hours."h, ".$minutes."m";
        $data[$key_data] = [
            'minutes' => $minutes,
            'hours' => $hours,
            'days' => $days,
            'years' => $years,
        ];
    }
    else {
        $data[$key_long] = "$days days, $hours hours, $minutes minutes";
        $data[$key_short] = $days."d, ".$hours."h, ".$minutes."m";
        $data[$key_data] = [
            'minutes' => $minutes,
            'hours' => $hours,
            'days' => $days,
        ];
    }
}

function pg_query_4770_locations() {

    if ( get_transient( __METHOD__ ) ) {
        return get_transient( __METHOD__ );
    }

    global $wpdb;
    $raw_list = $wpdb->get_col(
        "SELECT
                        lg1.grid_id
                    FROM $wpdb->dt_location_grid lg1
                    WHERE lg1.level = 0
                      AND lg1.grid_id NOT IN ( SELECT lg11.admin0_grid_id FROM $wpdb->dt_location_grid lg11 WHERE lg11.level = 1 AND lg11.admin0_grid_id = lg1.grid_id )
                      AND lg1.admin0_grid_id NOT IN (100050711,100219347,100089589,100074576,100259978,100018514)
                    UNION ALL
                    SELECT
                        lg2.grid_id
                    FROM $wpdb->dt_location_grid lg2
                    WHERE lg2.level = 1
                      AND lg2.admin0_grid_id NOT IN (100050711,100219347,100089589,100074576,100259978,100018514)
                    UNION ALL
                    SELECT
                        lg3.grid_id
                    FROM $wpdb->dt_location_grid lg3
                    WHERE lg3.level = 2
                      AND lg3.admin0_grid_id IN (100050711,100219347,100089589,100074576,100259978,100018514)"
    );

    $list = [];
    if ( ! empty( $raw_list ) ) {
        foreach ( $raw_list as $item ) {
            $list[$item] = $item;
        }
    }

    set_transient( __METHOD__, $list, 60 *60 *12 );

    return $list;
}

function pg_fields() {
    $defaults = [
        'image_asset_url' => [
            'label' => 'Image Asset URL',
            'description' => 'Add root site URl. {root_site_url}/location-grid-images/v1/...',
            'value' => 'https://storage.googleapis.com/',
            'type' => 'text',
        ],
        'scripture_api_bible' => [
            'label' => 'Scripture API Bible API',
            'description' => 'API token to access https://scripture.api.bible',
            'value' => '',
            'type' => 'text',
        ],

    ];

    $defaults = apply_filters( 'pg_fields', $defaults );

    $saved_fields = get_option( 'pg_fields', [] );

    return pg_recursive_parse_args( $saved_fields, $defaults );
}

function pg_grid_image_url() {
    $fields = pg_fields();
    return trailingslashit( $fields['image_asset_url']['value'] ) . 'location-grid-images/v1/grid/';
}
function pg_jp_image_url() {
    $fields = pg_fields();
    return trailingslashit( $fields['image_asset_url']['value'] ) . 'location-grid-images/v1/jp/';
}
function pg_jp_image( $type, $id ) {
    $base_url = pg_jp_image_url();
    $image_list = pg_jp_images_json();

    switch ( $type ) {
        case 'pid3':
            if ( isset( $image_list['pid3'][$id] ) ) {
                return $base_url . 'pid3/' . $image_list['pid3'][$id];
            } else {
                return false;
            }
        case 'progress':
            if ( isset( $image_list['progress'][$id] ) ) {
                return $base_url . 'progress/' . $image_list['progress'][$id];
            } else {
                return false;
            }
        default:
            return false;
    }
}
function pg_grid_json_url() {
    $fields = pg_fields();
    return trailingslashit( $fields['image_asset_url']['value'] ) . 'location-grid-images/v1/grid.json';
}
function pg_jp_json_url() {
    $fields = pg_fields();
    return trailingslashit( $fields['image_asset_url']['value'] ) . 'location-grid-images/v1/jp.json';
}

/**
 * Returns the full array db of images in the location-grid-images file store.
 * @param $grid_id
 * @param $full_urls
 * @return array|false|mixed|void
 */
function pg_images( $grid_id = null, $full_urls = false ) {
    $image_list = pg_grid_images_json();

    // full list
    if ( is_null( $grid_id ) ) {
        if ( $full_urls ) {
            $base_url = pg_grid_image_url();
            unset( $image_list['version'] );
            foreach ( $image_list as $i0 => $v0 ) {
                foreach ( $v0 as $i1 => $v1 ) {
                    foreach ( $v1 as $i2 => $v2 ) {
                        $image_list[$i0][$i1][$i2] = $base_url . $i0 .'/'. $i1 . '/' . $v2;
                    }
                }
            }
        }
        return $image_list;
    }

    // single grid_id
    if ( $full_urls ) {
        $base_url = pg_grid_image_url();
        foreach ( $image_list[$grid_id] as $i1 => $v1 ) {
            foreach ( $v1 as $i2 => $v2 ) {
                $image_list[$grid_id][$i1][$i2] = $base_url . $grid_id .'/'. $i1 . '/' . $v2;
            }
        }
    }
    return $image_list[$grid_id] ?? [];
}


function pg_recursive_parse_args( $args, $defaults ) {
    $new_args = (array) $defaults;

    foreach ( $args ?: [] as $key => $value ) {
        if ( is_array( $value ) && isset( $new_args[ $key ] ) ) {
            $new_args[ $key ] = pg_recursive_parse_args( $value, $new_args[ $key ] );
        }
        elseif ( $key !== "default" ){
            $new_args[ $key ] = $value;
        }
    }

    return $new_args;
}

function pg_is_lap_complete( $post_id ) {
    $complete = get_post_meta( $post_id, 'lap_completed', true );
    if ( ! $complete ) {
        global $wpdb;
        $count = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT( DISTINCT( grid_id ) ) FROM $wpdb->dt_reports WHERE post_id = %d AND type = 'prayer_app' AND subtype = 'custom'", $post_id ) );
        if ( $count >= PG_TOTAL_STATES ){
            update_post_meta( $post_id, 'lap_completed', time() );
            return true;
        } else {
            return false;
        }
    } else {
        return true;
    }
}

function pg_og_tags( $details = [] ) {
    global $wp;
    $details = array_merge([
        "url" => home_url(),
        "type" => "app",
        "title" => 'Prayer.Global',
        "description" => 'Join us in covering the world in prayer for disciple making using a creative, community-driven prayer coordination app.',
        "image" => trailingslashit( plugin_dir_url( __DIR__ ) ) . 'pages/assets/images/favicons/prayer-global-og.png',
    ], $details);

    ?>

    <meta name="twitter:card"              content="<?php echo esc_attr( $details['type'] ) ?>" />

    <meta property="og:url"                content="<?php echo esc_url( $details['url'] ) ?>" />
    <meta property="og:type"               content="<?php echo esc_attr( $details['type'] ) ?>" />
    <meta property="og:title"              content="<?php echo esc_attr( $details['title'] ) ?>" />
    <meta property="og:description"        content="<?php echo esc_attr( $details['description'] ) ?>" />
    <meta property="og:image"              content="<?php echo esc_url( $details['image'] ) ?>" />
    <meta name="description"               content="<?php echo esc_attr( $details['description'] ) ?>">

    <?php
}

/**
 * Adds soft duration text into an array of objects with timestamps in. E.g. 2 days ago, 1 month ago
 * Timestamps must be unix timestamps
 *
 * @param $object
 * @param $timestamp_key
 * @param $when_key
 * @param $timestamp_formatted_key
 * @return mixed
 */
function pg_soft_time_format( $object, $timestamp_key, $when_key, $timestamp_formatted_key ) {
    $time = time() - (int) $object[$timestamp_key];

    $days = floor( $time / 60 / 60 / 24 );
    $hours = floor( ( $time / 60 / 60 ) - ( $days * 24 ) );
    $minutes = floor( ( $time / 60 ) - ( $hours * 60 ) - ( $days * 24 * 60 ) );
    $seconds = $time;

    if ( empty( $days ) && empty( $hours ) && empty( $minutes ) ) {
        $seconds_word = $seconds > 1 ? __( 'seconds', 'prayer-global-porch' ) : __( 'second', 'prayer-global-porch' );
        $object[$when_key] = sprintf( _x( '%1$d %2$s ago', '23 seconds ago', 'prayer-global-porch' ), $seconds, $seconds_word );
    } else if ( empty( $days ) && empty( $hours ) ) {
        $minutes_word = $minutes > 1 ? __( 'minutes', 'prayer-global-porch' ) : __( 'minute', 'prayer-global-porch' );
        $object[$when_key] = sprintf( _x( '%1$d %2$s ago', '23 seconds ago', 'prayer-global-porch' ), $minutes, $minutes_word );
    } else if ( empty( $days ) ) {
        $hours_word = $hours > 1 ? __( 'hours', 'prayer-global-porch' ) : __( 'hour', 'prayer-global-porch' );
        $object[$when_key] = sprintf( _x( '%1$d %2$s ago', '23 seconds ago', 'prayer-global-porch' ), $hours, $hours_word );
    } else if ( $days < 7 ) {
        $days_word = $days > 1 ? __( 'days', 'prayer-global-porch' ) : __( 'day', 'prayer-global-porch' );
        $object[$when_key] = sprintf( _x( '%1$d %2$s ago', '23 seconds ago', 'prayer-global-porch' ), $days, $days_word );
    } else if ( $days < 30 ) {
        $weeks = floor( $days / 7 );
        $weeks_word = $weeks > 1 ? __( 'weeks', 'prayer-global-porch' ) : __( 'week', 'prayer-global-porch' );
        $object[$when_key] = sprintf( _x( '%1$d %2$s ago', '23 seconds ago', 'prayer-global-porch' ), $weeks, $weeks_word );
    } else if ( $days > 30 ) {
        $months = floor( $days / 30 );
        $months_word = $months > 1 ? __( 'months', 'prayer-global-porch' ) : __( 'month', 'prayer-global-porch' );
        $object[$when_key] = sprintf( _x( '%1$d %2$s ago', '23 seconds ago', 'prayer-global-porch' ), $months, $months_word );
    } else {
        $object[$when_key] = "";
    }

    $object[$timestamp_formatted_key] = gmdate( $time );

    return $object;
}

/**
 * Get the user data merged with meta data
 * @param int $user_id
 * @param array $allowed_meta
 * @return mixed
 */
function pg_get_user( int $user_id, array $allowed_meta ) {
    $userdata = get_userdata( $user_id );

    if ( $userdata instanceof stdClass ) {
        $userdata = get_object_vars( $userdata );
    } elseif ( $userdata instanceof WP_User ) {
        $userdata = $userdata->to_array();
    } else {
        $userdata = [];
    }

    foreach ( $allowed_meta as $meta_key ) {
        $namespaced_meta_key = PG_NAMESPACE . $meta_key;
        $meta_value = get_user_meta( $user_id, $namespaced_meta_key, true );
        $userdata[$meta_key] = $meta_value;
    }

    return $userdata;
}

function pg_log( $message ) {

    $prefix = isset( $_SERVER['REQUEST_TIME_FLOAT'] ) ? '=== ' . sanitize_text_field( wp_unslash( $_SERVER['REQUEST_TIME_FLOAT'] ) ) . ' === ' : '=== ';

    dt_write_log( $prefix . $message );
}
function pg_create_lock( $lock_name, $release_timeout = null ) {
    global $wpdb;
    if ( ! $release_timeout ) {
        $release_timeout = HOUR_IN_SECONDS;
    }
    $lock_option = $lock_name . '.lock';

    // Try to lock.
    $lock_result = $wpdb->query( $wpdb->prepare( "INSERT IGNORE INTO `$wpdb->options` ( `option_name`, `option_value`, `autoload` ) VALUES (%s, %s, 'no') /* LOCK */", $lock_option, time() ) );

    if ( ! $lock_result ) {
        $lock_result = get_option( $lock_option );

        // If a lock couldn't be created, and there isn't a lock, bail.
        if ( ! $lock_result ) {
            return false;
        }

        // Check to see if the lock is still valid. If it is, bail.
        if ( $lock_result > ( time() - $release_timeout ) ) {
            return false;
        }

        // There must exist an expired lock, clear it and re-gain it.
        pg_release_lock( $lock_name );

        return pg_create_lock( $lock_name, $release_timeout );
    }

    // Update the lock, as by this point we've definitely got a lock, just need to fire the actions.
    update_option( $lock_option, time() );

    return true;
}
function pg_release_lock( $lock_name ) {
    return delete_option( $lock_name . '.lock' );
}
/**
 * @param string $post_id
 * @return array|false|mixed
 */
function pg_generate_new_global_prayer_lap( $post_id ) {
    // hold generation while being created
    $lock_created = pg_create_lock( 'pg_generate_new_lap_in_progress', 30 );
    if ( ! $lock_created ) {
        pg_log( 'lock exists, sleeping for 25' );
        sleep( 25 );
        return pg_query_4770_locations();
    }

    pg_log( '*** creating new lap' );

    global $wpdb;

    $lap_status = $wpdb->get_var($wpdb->prepare(
        "SELECT meta_value as status FROM $wpdb->postmeta
        WHERE
            meta_key = 'status'
            AND post_id = %d
        ", $post_id, ARRAY_A )
    );
    if ( $lap_status !== 'active' ) {
        pg_release_lock( 'pg_generate_new_lap_in_progress' );
        pg_log( '!!! lap has already been generated' );
        return pg_query_4770_locations();
    }

    $completed_prayer_lap_number = pg_calculate_lap_number( $post_id );
    $next_global_lap_number = $completed_prayer_lap_number + 1;

    $current_lap = pg_current_global_lap();
    $current_lap_key = $current_lap['key'];

    // create key
    $new_key = pg_generate_key();
    $time = time();
    $date = gmdate( 'Y-m-d H:m:s', time() );

    $fields = [];
    $fields['title'] = 'Global #' . $next_global_lap_number;
    $fields['status'] = 'active';
    $fields['type'] = 'global';
    $fields['start_date'] = $date;
    $fields['start_time'] = $time;
    $fields['global_lap_number'] = $next_global_lap_number;
    $fields['prayer_app_global_magic_key'] = $current_lap_key;
    $fields['parent_lap'] = [
        'values' => [
            [ 'value' => $current_lap['post_id'] ]
        ],
    ];
    $new_post = DT_Posts::create_post( 'laps', $fields, true, false );
    if ( is_wp_error( $new_post ) ) {
        // @handle error
        pg_release_lock( 'pg_generate_new_lap_in_progress' );
        pg_log( '!!! failed to create' );
        pg_log( $new_post );
        return pg_query_4770_locations();
    }

    // update current_lap
    $previous_lap = pg_current_global_lap();
    $lap = [
        'lap_number' => $next_global_lap_number,
        'post_id' => $new_post['ID'],
        'key' => $current_lap_key,
        'start_time' => $time,
    ];
    update_option( 'pg_current_global_lap', $lap, true );

    // close previous lap
    DT_Posts::update_post( 'laps', $previous_lap['post_id'], [
        'status' => 'complete',
        'end_date' => $date,
        'end_time' => $time,
        'prayer_app_global_magic_key' => $new_key,
        'child_lap' => [
            'values' => [
                [ 'value' => $new_post['ID'] ]
            ],
        ],
    ], true, false );

    pg_log( '*** finished generating lap ' . $next_global_lap_number );
    pg_release_lock( 'pg_generate_new_lap_in_progress' );

    return pg_query_4770_locations();
}

/**
 * @return array|false|mixed
 */
function pg_generate_new_custom_prayer_lap( $post_id ) {
    // hold generation while being created

    $lock_created = pg_create_lock( 'pg_generate_new_custom_lap_in_progress_post_id' . $post_id );
    if ( !$lock_created ) {
        pg_log( '!!! lock exists, sleeping for 25' );
        sleep( 25 );
        return pg_query_4770_locations();
    }
    global $wpdb;
    pg_log( '*** generating new lap' );

    $lap_status = $wpdb->get_var($wpdb->prepare(
        "SELECT meta_value as status FROM $wpdb->postmeta
        WHERE
            meta_key = 'status'
            AND post_id = %d
        ", $post_id, ARRAY_A )
    );
    if ( $lap_status !== 'active' ) {
        pg_log( '!!! lap has already been generated' );
        pg_release_lock( 'pg_generate_new_custom_lap_in_progress_post_id' . $post_id );
        return pg_query_4770_locations();
    }

    $current_lap = pg_current_custom_lap( $post_id );
    $current_lap_key = $current_lap['key'];

    // create key
    $new_key = pg_generate_key();
    $time = time();
    $date = gmdate( 'Y-m-d H:m:s', time() );

    // build new lap number
    $current_lap_number = pg_calculate_lap_number( $post_id );
    $next_custom_lap_number = $current_lap_number + 1;

    $contacts = [];
    foreach ( $current_lap['contacts'] as $contact_id ) {
        $contacts[] = [ 'value' => $contact_id, ];
    }

    $fields = [];
    $fields['title'] = $current_lap['title'];
    $fields['status'] = 'active';
    $fields['type'] = 'custom';
    $fields['visibility'] = $current_lap['visibility'] ? $current_lap['visibility'] : 'public';
    $fields['challenge_type'] = $current_lap['challenge_type'] ? $current_lap['challenge_type'] : 'ongoing';
    $fields['assigned_to'] = $current_lap['assigned_to'];
    $fields['start_date'] = $date;
    $fields['start_time'] = $time;
    $fields['global_lap_number'] = $next_custom_lap_number;
    $fields['prayer_app_custom_magic_key'] = $current_lap_key;
    $fields['ctas_off'] = $current_lap['ctas_off'];
    $fields['parent_lap'] = [
        'values' => [
            [ 'value' => $current_lap['post_id'] ]
        ],
    ];
    $fields['contacts'] = [
        'values' => $contacts,
    ];

    $new_post = DT_Posts::create_post( 'laps', $fields, true, false );
    if ( is_wp_error( $new_post ) ) {
        // @handle error
        pg_release_lock( 'pg_generate_new_custom_lap_in_progress_post_id' . $post_id );
        pg_log( '!!! failed to create new custom lap' );
        return pg_query_4770_locations();
    }

    // close previous lap
    DT_Posts::update_post( 'laps', $current_lap['post_id'], [
        'status' => 'complete',
        'end_date' => $date,
        'end_time' => $time,
        'prayer_app_custom_magic_key' => $new_key,
        'child_lap' => [
            'values' => [
                [ 'value' => $new_post['ID'] ]
            ],
        ],
    ], true, false );

    pg_release_lock( 'pg_generate_new_custom_lap_in_progress_post_id' . $post_id );
    pg_log( '*** finished creating custom lap post_id=' . $post_id );

    return pg_query_4770_locations();
}

function pg_calculate_lap_number( $post_id ) {
    global $wpdb;

    /* === THIS QUERY WORKS UP TO MYSQL 5.7 AND SHOULD BE REMOVED IN FAVOR OF BELOW QUERY WHEN MYSQL IS UPGRADED TO 8 === */
    $results = $wpdb->get_results( $wpdb->prepare(
        "SELECT  @pv:= t.p2p_from, t.p2p_to
        FROM (SELECT * FROM wp_p2p ORDER BY p2p_to DESC) t
        JOIN (SELECT @pv := %d) tmp
        WHERE p2p_type = 'parent-lap_to_child-lap'
        AND t.p2p_to = @pv",
    $post_id ), ARRAY_A );
    /* === THIS QUERY ONLY WORKS ON MYQSL 8+ === */
    /*$results = $wpdb->get_results( $wpdb->prepare(
        "WITH RECURSIVE cte ( p2p_from_, p2p_to_ ) AS (
            SELECT
                p2p_from, p2p_to
            FROM
                wp_p2p
            WHERE
                p2p_to = %d
            AND
                p2p_type = 'parent-lap_to_child-lap'
            UNION ALL
            SELECT
                p.p2p_from, p.p2p_to
            FROM
                cte c
            JOIN
                wp_p2p p
            ON
                c.p2p_from_ = p.p2p_to
            AND
                p.p2p_type = 'parent-lap_to_child-lap'
        )
        SELECT * FROM cte
    ", [ $post_id ] ), ARRAY_A );
    */

    return count( $results ) + 1;

}

if ( ! function_exists( 'dt_sanitize_array' ) ) {
    function dt_sanitize_array( &$array ) {
        foreach ( $array as &$value ) {
            if ( !is_array( $value ) ) {
                $value = sanitize_text_field( wp_unslash( $value ) );
            } else {
                dt_sanitize_array( $value );
            }
        }
        return $array;
    }
}



/**
 * Return the code of the language that the campaign is currently being viewed in.
 *
 * This could come from the GET request or be stored in the browser's cookies
 *
 * @return string
 */
function pg_get_current_lang(): string {
    $lang = 'en_US';
    if ( defined( 'PORCH_DEFAULT_LANGUAGE' ) ){
        $lang = PORCH_DEFAULT_LANGUAGE;
    }
    if ( isset( $_GET['lang'] ) && !empty( $_GET['lang'] ) ){
        $lang = sanitize_text_field( wp_unslash( $_GET['lang'] ) );
    } elseif ( isset( $_COOKIE['dt-magic-link-lang'] ) && !empty( $_COOKIE['dt-magic-link-lang'] ) ){
        $lang = sanitize_text_field( wp_unslash( $_COOKIE['dt-magic-link-lang'] ) );
    }
    return $lang;
}

function pg_set_translation( $lang ){
    if ( $lang !== 'en_US' ){
        add_filter( 'determine_locale', function ( $locale ) use ( $lang ){
            if ( !empty( $lang ) ){
                return $lang;
            }
            return $locale;
        }, 1000, 1 );
        pg_reload_text_domain();
    }
}
function pg_reload_text_domain(){
    load_plugin_textdomain( 'prayer-global-porch', false, trailingslashit( dirname( plugin_basename( __FILE__ ), 2 ) ). 'support/languages' );
}
/**
 * Set the magic link lang in the cookie
 *
 * @param string $lang
 */
function pg_add_lang_to_cookie( string $lang ) {
    if ( isset( $_COOKIE['dt-magic-link-lang'] ) && $_COOKIE['dt-magic-link-lang'] === $lang ){
        return;
    }
    setcookie( 'dt-magic-link-lang', $lang, 0, '/' );
}