<?php
if ( !defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly.

class Prayer_Global_Style_Guide extends DT_Magic_Url_Base
{
    public $magic = false;
    public $parts = false;
    public $page_title = 'Prayer Global - Style Guide';
    public $root = 'show_app';
    public $type = 'style_guide';
    public $type_name = 'Prayer Global - Style Guide';
    public static $token = 'show_app_style_guide';
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
    }

    public function body(){

        ?>

        <section class="page-section mt-5" >
            <div class="container">
                <div class="row justify-content-md-center text-center mb-5">
                    <h1 class="mt-0 font-weight-normal">Style Guide</h1>

                    <div>
                        <h2>Colours</h2>
                        <div class="d-flex flex-wrap">
                            <div class="swatch brand-bg rounded w-25">
                                <p class="white m-5 two-rem">#11224e</p>
                            </div>
                            <div class="swatch brand-light-bg rounded w-25">
                                <p class="white m-5 two-rem">#1a3b70</p>
                            </div>
                            <div class="swatch brand-lighter-bg rounded w-25">
                                <p class="white m-5 two-rem">#2c599d</p>
                            </div>
                            <div class="swatch brand-lightest-bg rounded w-25">
                                <p class="white m-5 two-rem">#5c83c4</p>
                            </div>
                            <div class="swatch brand-highlight-bg rounded w-25">
                                <p class="m-5 two-rem">#aec5eb</p>
                            </div>
                            <div class="swatch secondary-bg rounded w-25">
                                <p class="white m-5 two-rem">#f2944a</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-md-center text-center mb-5" style="page-break-after: always">
                    <h2>Fonts</h2>
                    <h3 class="font-title">Bebas Kai</h3>
                    <p class="font-title">abcdefghijklmnopqrstuvwxyz1234567890!"£$%^&*()\=+$[{}]/?|</p>
                    <h3 class="font-base">Europa</h3>
                    <p class="font-base">abcdefghijklmnopqrstuvwxyz1234567890!"£$%^&*()\=+$[{}]/?|</p>
                </div>
                <div class="row justify-content-md-center center mb-5">
                    <h2 class="">Headings</h2>

                    <h1>Header 1</h1>
                    <h2>Header 2</h2>
                    <h3>Header 3</h3>
                    <h4>Header 4</h4>
                    <h5>Header 5</h5>
                    <h6>Header 6</h6>
                    <p>Body text</p>
                </div>

            </div>
        </section>

        <!-- END section -->

        <?php
    }

}
Prayer_Global_Style_Guide::instance();
