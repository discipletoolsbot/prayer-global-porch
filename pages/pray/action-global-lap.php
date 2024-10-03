<?php
if ( !defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly.

require_once( 'trait-lap.php' );
/**
 * Class Prayer_Global_Prayer_App
 */
class PG_Global_Prayer_App_Lap extends PG_Global_Prayer_App {

    use PG_Lap_Trait;

    public $lap_title;

    private static $_instance = null;
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    } // End instance()

    public function __construct() {
        parent::__construct();

        // must be valid url
        $url = dt_get_url_path();
        if ( strpos( $url, $this->root . '/' . $this->type ) === false ) {
            return;
        }

        // must be valid parts
        if ( !$this->check_parts_match() ){
            return;
        }

        // has empty action, of stop
        if ( !$this->validate_action( $this->parts['action'] ) ) {
            return;
        }

        // redirect to completed if not current global lap
        $current_lap = pg_current_global_lap();
        if ( (int) $current_lap['post_id'] === (int) $this->parts['post_id'] ) {
            add_action( 'dt_blank_body', [ $this, 'body' ] );
        } else {
            wp_redirect( trailingslashit( site_url() ) . $this->root . '/' . $this->type . '/' . $this->parts['public_key'] . '/completed' );
            exit;
        }

        $this->lap_title = 'Global';

        add_filter( 'dt_magic_url_base_allowed_css', [ $this, 'dt_magic_url_base_allowed_css' ], 10, 1 );
        add_filter( 'dt_magic_url_base_allowed_js', [ $this, 'dt_magic_url_base_allowed_js' ], 10, 1 );
        add_action( 'wp_enqueue_scripts', [ $this, 'wp_enqueue_scripts' ], 100 );

    }
    public function _header() {
        $this->header_style();
        $this->header_javascript();
    }
    public function _footer(){
        $this->footer_javascript();
    }

    public function validate_action( $action ) {
        /* We want the $action to be empty to signify we are praying for the lap */
        return empty( $action );
    }

    /**
     * Register REST Endpoints
     * @link https://github.com/DiscipleTools/disciple-tools-theme/wiki/Site-to-Site-Link for outside of wordpress authentication
     */
    public function add_endpoints() {
        $namespace = $this->root . '/v1';
        register_rest_route(
            $namespace,
            '/'.$this->type,
            [
                [
                    'methods'  => WP_REST_Server::CREATABLE,
                    'callback' => [ $this, 'endpoint' ],
                    'permission_callback' => '__return_true'
                ],
            ]
        );
    }

    public function endpoint( WP_REST_Request $request ) {
        $params = $request->get_params();

        dt_write_log( 'action-global-lap: ' . $_SERVER['REQUEST_URI'] . ' - ' .  $params['action'] );

        if ( ! isset( $params['parts'], $params['action'], $params['data'] ) ) {
            return new WP_Error( __METHOD__, "Missing parameters", [ 'status' => 400 ] );
        }

        $params = dt_recursive_sanitize_array( $params );

        switch ( $params['action'] ) {
            case 'log':
                $stack = $this->save_log( $params['parts'], $params['data'] );
                $global_lap = pg_current_global_lap();
                $params['parts']['post_id'] = $global_lap['post_id'];
                $params['parts']['public_key'] = $global_lap['key'];
                $stack['parts'] = $params['parts'];
                return $stack;
            case 'increment_log':
                return $this->increment_log( $params['parts'], $params['data'] );
            case 'correction':
                return $this->save_correction( $params['parts'], $params['data'] );
            case 'refresh':
                $stack = $this->get_new_location( $params['parts'] );
                $global_lap = pg_current_global_lap();
                $params['parts']['post_id'] = $global_lap['post_id'];
                $params['parts']['public_key'] = $global_lap['key'];
                $stack['parts'] = $params['parts'];
                return $stack;
            case 'ip_location':
                return $this->get_ip_location();
            default:
                return new WP_Error( __METHOD__, "Incorrect action", [ 'status' => 400 ] );
        }
    }
}
PG_Global_Prayer_App_Lap::instance();
