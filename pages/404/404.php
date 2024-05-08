<?php
if ( !defined( 'ABSPATH' ) ) { exit; } // exit if accessed directly

class PG_Porch_404 extends DT_Magic_Url_Base
{
    public $magic = false;
    public $parts = false;
    public $root = '404';
    public $page_title = '404';
    public $type_name = '404';
    public static $token = 'race_app_race_list';

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

        $root_types = apply_filters( 'dt_magic_url_register_types', [] );

        $dt_blank_access = apply_filters( 'dt_blank_access', false );

        $url = dt_get_url_path();
        $url_no_params = strpos( $url, '?' ) ? substr( $url, 0, strpos( $url, '?' ) ) : $url;

        $split_url = explode( '/', $url_no_params );

        $root = !empty( $split_url ) ? $split_url[0] : '';

        if ( array_key_exists( $root, $root_types ) && !$dt_blank_access ) {

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

            add_filter( "dt_override_header_meta", function (){ return true;
            }, 100, 1 );
        }

    }

    public function dt_magic_url_base_allowed_js( $allowed_js ) {
        return [];
    }

    public function dt_magic_url_base_allowed_css( $allowed_css ) {
        return [];
    }

    public function _header() {
        $this->header_style();
        $this->header_javascript();
    }

    public function header_javascript(){
        require_once( trailingslashit( plugin_dir_path( __DIR__ ) ) . 'assets/header.php' );
        ?>
        <script>
            let jsObject = [<?php echo json_encode([
                'parts' => $this->parts,
                'current_lap' => pg_current_global_lap(),
                'global_race' => pg_global_race_stats(),
                'translations' => [
                    'add' => __( 'Add Magic', 'prayer-global-porch' ),
                ],
                'nope' => plugin_dir_url( __DIR__ ) . 'assets/images/nope.jpg',
                'images_url' => pg_grid_image_url(),
                'image_folder' => plugin_dir_url( __DIR__ ) . 'assets/images/',
            ]) ?>][0]
        </script>
        <link rel="stylesheet" href="<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ) ?>assets/css/basic.css?ver=<?php echo esc_attr( fileatime( trailingslashit( plugin_dir_path( __DIR__ ) ) . 'assets/css/basic.css' ) ) ?>" type="text/css" media="all">
        <style>
            section {
                margin-top: 110px;
            }
        </style>
        <?php
    }

    public function footer_javascript(){
        require_once( trailingslashit( plugin_dir_path( __DIR__ ) ) . 'assets/footer.php' );
    }

    public function body(){
        require_once( trailingslashit( plugin_dir_path( __DIR__ ) ) . '/assets/nav.php' );
        ?>
        <!-- content section -->
        <section class="page-section">
            <div class="container pb-4">
                <div class="row">
                    <div class="col-md text-center">
                        <h2 class="">404</h2>
                    </div>
                </div>
            </div>
            <div class="container center">
                <div class="row">
                    <div class="col center">
                        <p><?php echo esc_html__( 'Not where you meant to be? Try some of the links below (or above) to get back into the action...', 'prayer-global-porch' ) ?></p>
                    </div>
                </div>
            </div>
            <hr>
            <div class="container center">
                <div class="row">
                    <div class="col center">
                        <ul style="list-style: none; padding-left: 0;">
                            <li><a href="/newest/lap"><?php echo esc_html__( 'Start Praying', 'prayer-global-porch' ) ?></a></li>
                            <li><a href="/newest/map"><?php echo esc_html__( 'The map', 'prayer-global-porch' ) ?></a></li>
                            <li><a href="/newest/stats"><?php echo esc_html__( 'More stats', 'prayer-global-porch' ) ?></a></li>
                            <li><a href="/challenges/active"><?php echo esc_html__( 'Prayer Relays', 'prayer-global-porch' ) ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <hr>
            <div class="container pb-4">
                <div class="row">
                    <div class="col-md text-center">
                        <h3 class=""><?php echo esc_html__( 'Other interesting links', 'prayer-global-porch' ) ?></h3>
                    </div>
                </div>
            </div>
            <div class="container center">
                <div class="row">
                    <div class="col center">
                        <ul style="list-style: none; padding-left: 0;">
                            <li><a href="/prayer_app/contact_us/"><?php echo esc_html__( 'Anything to share/request? Please contact us :)', 'prayer-global-porch' ) ?></a></li>
                            <li><a href="/content_app/data_sources"><?php echo esc_html__( 'Where does all the data come from?', 'prayer-global-porch' ) ?></a></li>
                            <li><a href="/download_app/media"><?php echo esc_html__( 'Invites for sharing on social media', 'prayer-global-porch' ) ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <?php require_once( trailingslashit( plugin_dir_path( __DIR__ ) ) . '/assets/working-footer.php' ) ?>
        <?php
    }
}
PG_Porch_404::instance();
