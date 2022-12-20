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
            'user' => [
                'country' => 'United States',
                'grid_id'=>'100364522',
                'hash'=>'3ba4f83cfbd24b4be862536cfd9babe2025a2e027b69e2defbf2e62edcf3efa5',
                'label'=>'Golden, Colorado, United States',
                'lat'=>39.828250885009766,
                'level'=>'district',
                'lng'=>-105.06230163574219,
                'source'=>'ip'
            ]
        ];

        // query to get custom list
        $custom_laps_ids = $wpdb->get_results("
                SELECT p.ID, pm2.meta_value as public_key
                FROM wp_posts p
                JOIN wp_postmeta pm ON pm.post_id=p.ID AND pm.meta_value = 'custom' AND pm.meta_key = 'type'
                LEFT JOIN wp_postmeta pm2 ON pm2.post_id=p.ID AND pm2.meta_key = 'prayer_app_custom_magic_key'
                WHERE p.post_type = 'laps';"
            , ARRAY_A );

        // query to get count required
        foreach( $custom_laps_ids as $value ) {

            $jsobject[$value['ID']] = [];
            $jsobject[$value['ID']]['post_id'] = $value['ID'];
            $jsobject[$value['ID']]['grid_id'] = '';
            $jsobject[$value['ID']]['parts'] = [
                'post_id' => $value['ID'],
                'post_type' => 'laps',
                'public_key' => $value['public_key'],
                'meta_key' => 'prayer_app_custom_magic_key',
                'root' => 'prayer_app',
                'type' => 'custom',
                'action' => ''
            ];
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
                <input type="text" value="" id="post_id" /><button type="button" class="button" id="start">Start</button><br>
                <div id="list"></div>
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

                function send_log( grid_id, post_id ) {
                    window.api_post( 'log', { grid_id: grid_id, pace: 1, user: {country:"United States",grid_id:"100364522",hash:"3ba4f83cfbd24b4be862536cfd9babe2025a2e027b69e2defbf2e62edcf3efa5",
                            label:"Golden, Colorado, United States",lat:39.828250885009766, level:"district",lng:-105.06230163574219,source:"ip"}
                        }, jsObject[post_id].parts, 'https://prayer.global/wp-json/prayer_app/v1/custom' )
                        .done(function(x) {
                            console.log(x)
                            if ( x ) {
                                jQuery('#results').prepend(post_id + ' - ' + grid_id + '<br>')
                                send_log( x.location.grid_id, post_id )
                            }
                        })
                }

                jQuery.each(jsObject, function(i,v){
                    jQuery('#list').append(i + ', ')
                })

                jQuery('#start').on('click', function() {
                        let gval = jQuery('#post_id').val()
                        send_log( jsObject[gval].grid_id, jsObject[gval].post_id )
                    }
                )
            })
        </script>
        <!-- END section -->

        <?php
    }

}
Prayer_Global_Test_Load::instance();
