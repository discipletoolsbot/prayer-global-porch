<?php
if ( !defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly.

class Prayer_Global_Test_Load extends DT_Magic_Url_Base
{

    public $magic = false;
    public $parts = false;
    public $page_title = 'Global Prayer - Show All';
    public $root = 'show_app';
    public $type = 'test_load';
    public $type_name = 'Global Prayer - Test Load';
    public static $token = 'show_app_test_load';
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
        if ( str_contains( $url, $this->root . '/' . $this->type ) ) {

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
            add_action( 'wp_print_scripts', [ $this, 'print_scripts' ], 1500 ); // authorizes scripts
            add_action( 'wp_print_styles', [ $this, 'print_styles' ], 1500 ); // authorizes styles


            // page content
            add_action( 'dt_blank_head', [ $this, '_header' ] );
            add_action( 'dt_blank_footer', [ $this, '_footer' ] );
            add_action( 'dt_blank_body', [ $this, 'body' ] ); // body for no post key

            add_filter( 'dt_magic_url_base_allowed_css', [ $this, 'dt_magic_url_base_allowed_css' ], 10, 1 );
            add_filter( 'dt_magic_url_base_allowed_js', [ $this, 'dt_magic_url_base_allowed_js' ], 10, 1 );
        }

    }

    public function dt_magic_url_base_allowed_js( $allowed_js ) {
        return [];
    }

    public function dt_magic_url_base_allowed_css( $allowed_css ) {
        return [];
    }

    public function header_javascript(){
        require_once( WP_CONTENT_DIR . '/plugins/prayer-global-porch/pages/assets/header.php' );
        ?>
        <link href="https://fonts.googleapis.com/css?family=Crimson+Text:400,400i,600|Montserrat:200,300,400" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo esc_url( WP_CONTENT_URL . '/plugins/prayer-global-porch/pages/' ) ?>assets/fonts/ionicons/css/ionicons.min.css">
        <link rel="stylesheet" href="<?php echo esc_url( WP_CONTENT_URL . '/plugins/prayer-global-porch/pages/' ) ?>assets/css/basic.css?ver=<?php echo esc_attr( fileatime( WP_CONTENT_DIR . '/plugins/prayer-global-porch/pages/assets/css/basic.css' ) ) ?>" type="text/css" media="all">
        <?php
    }

    public function footer_javascript(){
        require_once( WP_CONTENT_DIR . '/plugins/prayer-global-porch/pages/assets/footer.php' );

        global $wpdb;
        $jsobject = [
            'map_key' => DT_Mapbox_API::get_key(),
            'root' => esc_url_raw( rest_url() ),
            'nonce' => wp_create_nonce( 'wp_rest' ),
            'parts' => $this->parts,
            'global' => [],
            'custom' => []
        ];
        $list_4770 = pg_query_4770_locations();

        $list_of_custom_laps = $wpdb->get_results("". ARRAY_A );

        // Global
        $post_global_ids = [
            [
                'post_id' => 241,
                'post_type' => 'laps',
                'meta_key' => 'prayer_app_global_magic_key',
                'public_key' => 'cfb333',
                'root' => 'prayer_app',
                'type' => 'global'
            ],
        ];
        $current_lap = pg_current_global_lap();
        $raw_list = $wpdb->get_col( $wpdb->prepare(
            "SELECT DISTINCT grid_id
                    FROM $wpdb->dt_reports
                    WHERE
                          timestamp >= %d
                      AND type = 'prayer_app'",
            $current_lap['start_time'] ) );
        $list = [];
        if ( ! empty( $raw_list ) ) {
            foreach ( $raw_list as $item ) {
                $list[$item] = $item;
            }
        }
        if ( ! empty( $list ) ) {
            foreach ( $list as $grid_id ) {
                if ( isset( $list_4770[$grid_id] ) ) {
                    unset( $list_4770[$grid_id] );
                }
            }
        }
        shuffle($list);
        $jsobject['global'][$current_lap['post_id']] = [];
        $jsobject['global'][$current_lap['post_id']]['list'] = $list;
        $jsobject['global'][$current_lap['post_id']]['count'] = count( $list );
        $jsobject['global'][$current_lap['post_id']]['parts'] = $post_global_ids[0];

        $post_ids = [
            [
                'post_id' => 260,
                'post_type' => 'laps',
                'public_key' => 'ff2cd5',
                'meta_key' => 'prayer_app_custom_magic_key',
                'root' => 'prayer_app',
                'type' => 'custom'
            ],
            [
                'post_id' => 258,
                'post_type' => 'laps',
                'public_key' => '2de150',
                'meta_key' => 'prayer_app_custom_magic_key',
                'root' => 'prayer_app',
                'type' => 'custom'
            ],
            [
                'post_id' => 247,
                'post_type' => 'laps',
                'public_key' => 'd5ce37',
                'meta_key' => 'prayer_app_custom_magic_key',
                'root' => 'prayer_app',
                'type' => 'custom'
            ],
            [
                'post_id' => 245,
                'post_type' => 'laps',
                'public_key' => '703454',
                'meta_key' => 'prayer_app_custom_magic_key',
                'root' => 'prayer_app',
                'type' => 'custom'
            ],

        ];
        foreach( $post_ids as $index => $p ) {
            $list_4770 = pg_query_4770_locations();
            $raw_list = $wpdb->get_col( $wpdb->prepare(
                "SELECT DISTINCT grid_id
                    FROM $wpdb->dt_reports
                    WHERE
                      post_id = %d
                      AND type = 'prayer_app'
                      AND subtype = 'custom'
                      ",
                $p['post_id'] ) );
            $list = [];
            if ( ! empty( $raw_list ) ) {
                foreach ( $raw_list as $item ) {
                    $list[$item] = $item;
                }
            }
            if ( ! empty( $list ) ) {
                foreach ( $list as $grid_id ) {
                    if ( isset( $list_4770[$grid_id] ) ) {
                        unset( $list_4770[$grid_id] );
                    }
                }
            }
            shuffle($list);
            $jsobject['custom'][$p['post_id']] = [];
            $jsobject['custom'][$p['post_id']]['list'] = $list;
            $jsobject['custom'][$p['post_id']]['count'] = count( $list );
            $jsobject['custom'][$p['post_id']]['parts'] = $p;
        }

        ?>
        <script>
            let jsObject = [<?php echo json_encode($jsobject) ?>][0]
        </script>
        <?php
    }

    public function body(){
        require_once( WP_CONTENT_DIR . '/plugins/prayer-global-porch/pages/assets/nav.php' )
        ?>

        <section class="page-section mt-5" >
            <div class="container">
                Total <span id="total"></span> | Unprayed For <span id="unprayed"></span> | Reduced Count <span id="reduced"></span>
                <hr>
                <div id="results"></div>
            </div>
        </section>
        <script>
            jQuery(document).ready(function(){
                window.api_post = ( action, data, parts, url ) => {
                    return jQuery.ajax({
                        type: "POST",
                        data: JSON.stringify({ action: action, parts: parts, data: data }),
                        contentType: "application/json; charset=utf-8",
                        dataType: "json",
                        url: url,
                        beforeSend: function (xhr) {
                            xhr.setRequestHeader('X-WP-Nonce', jsObject.nonce )
                        }
                    })
                        .fail(function(e) {
                            console.log(e)
                        })
                }
                function delay(time) {
                    return new Promise(resolve => setTimeout(resolve, time));
                }

                jQuery.each(jsObject.global, function(ig, vg ) {
                    window.global_loop = 0
                    jQuery.each( vg.list, function( i ,v ){
                        if ( window.global_loop > 10 ) {
                            return
                        }else {
                            window.global_loop++
                        }
                        delay(1000).then(
                            window.api_post( 'log', { grid_id: v, pace: 1, user: {country:"United States",grid_id:"100364522",hash:"3ba4f83cfbd24b4be862536cfd9babe2025a2e027b69e2defbf2e62edcf3efa5",
                                    label:"Golden, Colorado, United States",lat:39.828250885009766, level:"district",lng:-105.06230163574219,
                                    source:"ip"}}, vg.parts, 'https://prayer.global/wp-json/prayer_app/v1/global')
                                .done(function(x) {
                                    console.log(x)
                                    jQuery('#results').append(`Global ${x.report_id} <br>` )
                                })
                        );
                    })
                })

                jQuery.each(jsObject.custom, function(ig, vg ) {
                    window.lap_loop = 0
                    jQuery.each( vg.list, function( i ,v ){
                        if ( window.lap_loop > 10 ) {
                            return
                        }else {
                            window.lap_loop++
                        }
                        delay(1000).then(
                            window.api_post( 'log', { grid_id: v, pace: 1, user: {country:"United States",grid_id:"100364522",hash:"3ba4f83cfbd24b4be862536cfd9babe2025a2e027b69e2defbf2e62edcf3efa5",
                                    label:"Golden, Colorado, United States",lat:39.828250885009766, level:"district",lng:-105.06230163574219,
                                    source:"ip"}}, vg.parts, 'https://prayer.global/wp-json/prayer_app/v1/custom' )
                                .done(function(x) {
                                    console.log(x)
                                    jQuery('#results').append(`Custom ${x.report_id} <br>` )
                                })
                        );
                    })
                })

            })
        </script>
        <!-- END section -->

        <?php
    }

}
Prayer_Global_Test_Load::instance();
