<?php
if ( !defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly.

class Prayer_Global_Porch_Challenge_List extends DT_Magic_Url_Base
{
    public $magic = false;
    public $parts = false;
    public $page_title = 'Active Challenges';
    public $root = 'challenges';
    public $type = 'active';
    public $type_name = 'Active Challenges';
    public static $token = 'custom_app_lists';
    public $post_type = 'laps';

    private static $_instance = null;
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    } // End instance()

    public function __construct() {
        parent::__construct();

        $url = dt_get_url_path();
        if ( ( $this->root . '/' . $this->type ) === $url ) {

            $this->magic = new DT_Magic_URL( $this->root );
            $this->parts = $this->magic->parse_url_parts();

            // register url and access
            add_action( "template_redirect", [ $this, 'theme_redirect' ] );
            add_filter( 'dt_blank_access', function (){ return true;
            }, 100, 1 );
            add_filter( 'dt_allow_non_login_access', function (){ return true;
            }, 100, 1 );
            add_filter( 'dt_override_header_meta', function (){ return true;
            }, 100, 1 );

            // header content
            add_filter( "dt_blank_title", [ $this, "page_tab_title" ] ); // adds basic title to browser tab

            // page content
            add_action( 'dt_blank_head', [ $this, '_header' ] );
            add_action( 'dt_blank_body', [ $this, 'body' ] ); // body for no post key

            add_filter( 'dt_magic_url_base_allowed_js', [ $this, 'dt_magic_url_base_allowed_js' ], 10, 1 );
            add_filter( 'dt_magic_url_base_allowed_css', [ $this, 'dt_magic_url_base_allowed_css' ], 10, 1 );

            add_filter( "dt_override_header_meta", function (){ return true;
            }, 100, 1 );
        }

        if ( dt_is_rest() ) {
            add_action( 'rest_api_init', [ $this, 'add_endpoints' ] );
            add_filter( 'dt_allow_rest_access', [ $this, 'authorize_url' ], 10, 1 );
        }
    }

    public function dt_magic_url_base_allowed_js( $allowed_js ) {
        return [];
    }

    public function dt_magic_url_base_allowed_css( $allowed_css ) {
        return [];
    }


    public function header_javascript(){
        require_once( trailingslashit( plugin_dir_path( __DIR__ ) ) . 'assets/header.php' );
        ?>
        <script>
            let jsObject = [<?php echo json_encode([
                'map_key' => DT_Mapbox_API::get_key(),
                'mirror_url' => dt_get_location_grid_mirror( true ),
                'ipstack' => DT_Ipstack_API::get_key(),
                'root' => esc_url_raw( rest_url() ),
                'nonce' => wp_create_nonce( 'wp_rest' ),
                'parts' => $this->parts,
                'site_url' => site_url(),
                'translations' => [
                    'add' => __( 'Add Magic', 'prayer-global' ),
                ],
                'nope' => plugin_dir_url( __DIR__ ) . 'assets/images/nope.jpg',
                'images_url' => pg_grid_image_url(),
                'image_folder' => plugin_dir_url( __DIR__ ) . 'assets/images/',
                'is_rolling_laps_feature_on' => ( new PG_Feature_Flag( PG_Flags::ROLLING_LAPS ) )->is_on(),
            ]) ?>][0]
        </script>
        <link rel="stylesheet" href="<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ) ?>assets/css/basic.css?ver=<?php echo esc_attr( fileatime( trailingslashit( plugin_dir_path( __DIR__ ) ) . 'assets/css/basic.css' ) ) ?>" type="text/css" media="all">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.12.1/r-2.3.0/datatables.min.css"/>
        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/r-2.3.0/datatables.min.js"></script>
        <script src="<?php echo esc_url( trailingslashit( plugin_dir_url( __FILE__ ) ) ) ?>active-list.js?ver=<?php echo esc_attr( fileatime( trailingslashit( plugin_dir_path( __FILE__ ) ) . 'active-list.js' ) ) ?>"></script>
        <?php
    }

    public function footer_javascript(){
        require_once( trailingslashit( plugin_dir_path( __DIR__ ) ) . 'assets/footer.php' );
    }

    public function body(){
        require_once( trailingslashit( plugin_dir_path( __DIR__ ) ) . '/assets/nav.php' );
        ?>
        <!-- content section -->
        <style>
            .challenge-cell {
                cursor:pointer;
            }
            .challenge-row:hover{
                background-color: #f9f9f9;
            }
            .dataTables_wrapper {
                margin: 2em 0;
            }
        </style>
        <section class="brand-light text-center page flow-medium">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2 class="">Prayer Relays</h2>
                        <i class="icon pg-relay icon-large"></i>
                    </div>
                    <div class="col-md-3"></div>
                    <div class="col-md-6 mt-4">
                        <p>Group challenges are communities of prayer warriors who have picked up the challenge of praying for the entire world as a group. All prayers prayed in the group challenges contribute to the global laps.</p>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md text-center">
                        <a class="btn btn-cta two-em has-icon cta-blue px-5" href="/prayer_app/group_challenge_request">Start a Prayer Relay <i class="icon pg-chevron-right icon-end two-em end-0 me-2"></i></a>
                    </div>
                </div>
            </div>
            <section class="flow-small contain bg-top" style="background-image: url(<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ) ?>assets/images/map-lightblue-transparent.png);">
                <i class="icon pg-relay icon-medium d-block"></i>
                <h4 class="uppercase">Active Relays</h4>
                <div class="container data-table uppercase" id="active_content"><span class="loading-spinner active"></span></div>
            </section>
            <section class="brand-lighter flow-small contain bg-top" style="background-image: url(<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ) ?>assets/images/map-lightblue-transparent.png);">
                <i class="icon pg-crown icon-medium d-block"></i>
                <h3 class="uppercase">Completed Relays</h3>
                <div class="container data-table uppercase" id="complete_content"><span class="loading-spinner active"></span></div>
                <div class="container" ><hr style="margin: 1em auto;"></div>
            </section>


        </section>
        <div style="height:300px;"></div>

        <?php require_once( trailingslashit( plugin_dir_path( __DIR__ ) ) . '/assets/working-footer.php' ) ?>
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
                ],
            ]
        );
    }

    public function endpoint( WP_REST_Request $request ) {
        $params = $request->get_params();

        if ( ! isset( $params['parts'], $params['action'] ) ) {
            return new WP_Error( __METHOD__, "Missing parameters", [ 'status' => 400 ] );
        }

        switch ( $params['action'] ) {
            case 'get_global_list':
                return $this->get_active_list();
        }

        return false;
    }

    public function get_active_list() {
         global $wpdb;

         $data = [];

        $results = $wpdb->get_results(
            "   SELECT
                    p.post_title,
                    pm.post_id,
                    pm2.meta_value as status,
                    pm3.meta_value as lap_key,
                    pm4.meta_value as start_time,
                    pm6.meta_value as lap_number,
                    pm7.meta_value as single_lap
                FROM $wpdb->posts p
                JOIN $wpdb->postmeta pm ON pm.post_id=p.ID AND pm.meta_key = 'type' AND pm.meta_value = 'custom'
                LEFT JOIN $wpdb->postmeta pm2 ON pm2.post_id=p.ID AND pm2.meta_key = 'status'
                LEFT JOIN $wpdb->postmeta pm3 ON pm3.post_id=p.ID AND pm3.meta_key = 'prayer_app_custom_magic_key'
                LEFT JOIN $wpdb->postmeta pm4 ON pm4.post_id=p.ID AND pm4.meta_key = 'start_time'
                LEFT JOIN $wpdb->postmeta pm5 ON pm5.post_id=p.ID AND pm5.meta_key = 'visibility'
                LEFT JOIN $wpdb->postmeta pm6 ON pm6.post_id=p.ID AND pm6.meta_key = 'global_lap_number'
                LEFT JOIN $wpdb->postmeta pm7 ON pm7.post_id=p.ID AND pm7.meta_key = 'single_lap'
                WHERE p.post_type = 'laps'
                AND pm5.meta_value = 'public' OR pm5.meta_value IS NULL OR pm5.meta_value = 'none'
                ORDER BY p.post_title
             ", ARRAY_A );

        foreach ( $results as $row ) {
            $row['stats'] = pg_custom_lap_stats_by_post_id( $row['post_id'] );
            $data[] = $row;
        }

        return $data;
    }

}
Prayer_Global_Porch_Challenge_List::instance();
