<?php
if ( !defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly.

require_once( 'trait-lap.php' );
/**
 * Class Prayer_Global_Prayer_App
 */
class PG_Global_Prayer_App_Location extends PG_Global_Prayer_App {

    use PG_Lap_Trait;

    public $grid_id;
    private static $_instance = null;
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    } // End instance()

    public function __construct() {
        parent::__construct();

        $grid_id = isset( $_GET['grid_id'] ) ? sanitize_text_field( wp_unslash( $_GET['grid_id'] ) ) : null;
        $this->grid_id = $grid_id;

        /**
         * post type and module section
         */
        $this->if_rest_add_actions();

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

        add_filter( 'dt_magic_url_base_allowed_css', [ $this, 'dt_magic_url_base_allowed_css' ], 10, 1 );
        add_filter( 'dt_magic_url_base_allowed_js', [ $this, 'dt_magic_url_base_allowed_js' ], 10, 1 );
    }

    public function if_rest_add_actions() {
        if ( dt_is_rest() ) {
            add_action( 'rest_api_init', [ $this, 'add_endpoints' ] );
        }
    }

    public function validate_action( $action ) {
        if ( 'location' === $action && $this->is_valid_grid_id( $this->grid_id ) ) {
            return true;
        }
        add_filter( 'dt_blank_access', function() { return false;
        } );
        return false;
    }

    public function is_valid_grid_id( $grid_id ) {
        global $wpdb;

        $grid_id = intval( $grid_id );

        if ( !$grid_id ) {
            return false;
        }

        $location = $wpdb->get_row( $wpdb->prepare( "
            SELECT * FROM $wpdb->dt_location_grid
            WHERE grid_id = %d
        ", $grid_id ) );

        if ( !$location ) {
            return false;
        }

        return true;
    }

    public function question_buttons() {
        ?>

        <button type="button" class="btn btn-secondary question" id="question__yes_done">Done</button>

        <?php
    }

    public function decision_buttons() {
        ?>

        <button type="button" class="btn btn-secondary decision" id="decision__home">Home</button>
        <button type="button" class="btn btn-secondary decision" id="decision__map">Map</button>

        <?php
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

        if ( ! isset( $params['parts'], $params['action'], $params['data'] ) ) {
            return new WP_Error( __METHOD__, "Missing parameters", [ 'status' => 400 ] );
        }

        $params = dt_recursive_sanitize_array( $params );

        switch ( $params['action'] ) {
            case 'refresh':
                $grid_id = isset( $params['data']['grid_id'] ) ? $params['data']['grid_id'] : null;
                if ( $grid_id ) {
                    return $this->get_location_by_grid_id( $grid_id );
                }
                return $this->get_new_location();
            case 'log':
                return $this->save_log( $params['parts'], $params['data'] );
            case 'increment_log':
                return $this->increment_log( $params['parts'], $params['data'] );
            case 'correction':
                return $this->save_correction( $params['parts'], $params['data'] );
            case 'ip_location':
                return $this->get_ip_location();
            default:
                return new WP_Error( __METHOD__, "Incorrect action", [ 'status' => 400 ] );
        }
    }

    public function get_location_by_grid_id( $grid_id ) {
        return PG_Stacker::build_location_stack_v2( $grid_id );
    }
}
PG_Global_Prayer_App_Location::instance();
