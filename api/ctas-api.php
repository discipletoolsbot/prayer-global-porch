<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class PG_CTAs_API {
    public $root = 'pg-api';
    public $type = 'ctas';

    private static $_instance = null;
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    } // End instance()

    public function __construct() {
        add_filter( 'dt_allow_rest_access', [ $this, 'authorize_url' ], 10, 1);
        if ( dt_is_rest() ) {
            add_action( 'rest_api_init', [ $this, 'add_endpoints' ] );
        }
    }

    /**
     * Register REST Endpoints
     * @link https://github.com/DiscipleTools/disciple-tools-theme/wiki/Site-to-Site-Link for outside of wordpress authentication
     */
    public function add_endpoints() {
        $namespace = $this->root . "/v1/$this->type";
        DT_Route::post( $namespace, 'get_cta', [ $this, 'get_cta' ] );
    }

    public function authorize_url( $authorized ){
        if ( isset( $_SERVER['REQUEST_URI'] ) && strpos( sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) ), $this->root . '/v1/'.$this->type ) !== false ) {
            $authorized = true;
        }
        return $authorized;
    }


    public function endpoint( WP_REST_Request $request ) {
        $params = $request->get_params();

        if ( ! isset( $params['parts'], $params['action'], $params['data'] ) ) {
            return new WP_Error( __METHOD__, "Missing parameters", [ 'status' => 400 ] );
        }

        $params = dt_recursive_sanitize_array( $params );

        switch ( $params['action'] ) {
            case 'get_cta':
                return $this->get_cta();
            default:
                return new WP_Error( __METHOD__, "Incorrect action", [ 'status' => 400 ] );
        }
    }

    public function get_cta() {
        $ctas = $this->get_ctas();

        if ( empty( $ctas ) ) {
            return [];
        }

        $rand = random_int( 0, count( $ctas ) - 1 );

        return $ctas[$rand];
    }

    public function get_ctas() {
        global $wpdb;
        $ctas = get_posts( [
            'post_type' => 'ctas',
            'tax_query' => [
                [
                    'taxonomy' => 'category',
                    'field' => 'slug',
                    'terms' => [ 'disabled' ],
                    'operator' => 'NOT IN',
                ]
            ],
        ] );

        return array_map( function( $cta ) {
            return [
                'post_title' => $cta->post_title,
                'post_content' => $cta->post_content,
            ];
        }, $ctas );
    }
}
PG_CTAs_API::instance();
