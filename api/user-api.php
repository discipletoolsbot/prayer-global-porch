<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class PG_User_API {

    public $root = 'pg-api';

    public $type = 'user';
    public static $allowed_user_meta = [
        'location',
        'location_hash',
        'send_lap_emails',
        'send_general_emails',
    ];

    private static $_instance = null;
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    } // End instance()

    public function __construct() {
        add_filter( 'dt_allow_rest_access', [ $this, 'authorize_url' ], 10, 1 );
        if ( dt_is_rest() ) {
            add_action( 'rest_api_init', [ $this, 'add_endpoints' ] );
        }
    }


    /**
     * Register REST Endpoints
     * @link https://github.com/DiscipleTools/disciple-tools-theme/wiki/Site-to-Site-Link for outside of wordpress authentication
     */
    public function add_endpoints() {
        $namespace = $this->root . '/v1/' . $this->type . '/';
        DT_Route::post( $namespace, 'ip_location', [ $this, 'get_ip_location' ] );
        DT_Route::post( $namespace, 'details', [ $this, 'get_user' ] );
        DT_Route::post( $namespace, 'stats', [ $this, 'get_user_stats' ] );
    }

    public function authorize_url( $authorized ){
        if ( isset( $_SERVER['REQUEST_URI'] ) && strpos( sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) ), $this->root . '/v1/'.$this->type ) !== false ) {
            $authorized = true;
        }
        return $authorized;
    }

    public function get_ip_location() {
        if ( is_user_logged_in() ) {
            $user_id = get_current_user_id();
            $location_meta = get_user_meta( $user_id, PG_NAMESPACE . 'location', true );

            return $location_meta;
        } else {
            $response = DT_Ipstack_API::get_location_grid_meta_from_current_visitor();
            if ( $response ) {
                $response['hash'] = hash( 'sha256', serialize( $response ) . mt_rand( 1000000, 10000000000000000 ) );
                $array = array_reverse( explode( ', ', $response['label'] ) );
                $response['country'] = $array[0] ?? '';
            }
            return $response;
        }
    }

    /**
     * Get the user data and stats for the currently logged in user
     */
    public function get_user() {
        $user_id = get_current_user_id();
        $userdata = pg_get_user( $user_id, self::$allowed_user_meta );

        $userdata['stats'] = $this->get_user_stats();

        return $userdata;
    }

    public function get_user_stats() {
        global $wpdb;

        $user_id = get_current_user_id();

        if ( !$user_id ) {
            return new WP_Error( __METHOD__, 'Unauthorised', [ 'status' => 401 ] );
        }

        $user_stats = $wpdb->get_row( $wpdb->prepare( "
            SELECT COUNT(r.id) as total_locations, SUM(r.value) as total_minutes
            FROM $wpdb->dt_reports r
            WHERE r.user_id = %d
            AND r.type = 'prayer_app'
            ORDER BY r.timestamp DESC
            ", $user_id ), ARRAY_A );

        $user_stats['total_locations'] = (int) $user_stats['total_locations'];
        $user_stats['total_minutes'] = (int) $user_stats['total_minutes'];
        return $user_stats;
    }

}
PG_User_API::instance();
