<?php
if ( !defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly.

class Prayer_Global_Show_All_CTAS extends DT_Magic_Url_Base
{
    public $magic = false;
    public $parts = false;
    public $page_title = 'Global Prayer - Show All CTAs';
    public $root = 'show_app';
    public $type = 'all_ctas';
    public $type_name = 'Global Prayer - Show All CTAs';
    public static $token = 'show_app_all_ctas';
    public $post_type = 'ctas';

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
        <link rel="stylesheet" href="<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ) ?>../pages/assets/css/bootstrap/bootstrap5.2.2.css">
        <link rel="stylesheet" href="<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ) ?>../pages/assets/fonts/prayer-global/style.css?ver=<?php echo esc_attr( fileatime( trailingslashit( plugin_dir_path( __DIR__ ) ) . 'assets/fonts/prayer-global/style.css' ) ) ?>">
        <link rel="stylesheet" href="<?php echo esc_url( WP_CONTENT_URL . '/plugins/prayer-global-porch/pages/' ) ?>assets/fonts/ionicons/css/ionicons.min.css">
        <link rel="stylesheet" href="<?php echo esc_url( WP_CONTENT_URL . '/plugins/prayer-global-porch/pages/' ) ?>assets/css/basic.css?ver=<?php echo esc_attr( fileatime( WP_CONTENT_DIR . '/plugins/prayer-global-porch/pages/assets/css/basic.css' ) ) ?>" type="text/css" media="all">
        <?php
    }

    public function footer_javascript(){
        require_once( WP_CONTENT_DIR . '/plugins/prayer-global-porch/pages/assets/footer.php' );
    }

    public function body(){

        $cta_categories = get_terms( [
            'taxonomy' => 'category',
        ] );

        $cta_cats_by_slug = [];
        $ctas_by_category = [];
        foreach ( $cta_categories as $term ) {
            $ctas = get_posts( [
                'post_type' => 'ctas',
                'cat' => $term->term_id,
                'posts_per_page' => -1,
            ] );

            $cta_cats_by_slug[$term->slug] = $term;
            $ctas_by_category[$term->slug] = $ctas;
        }



        require_once( WP_CONTENT_DIR . '/plugins/prayer-global-porch/pages/assets/nav.php' ) ?>

        <section class="page-section mt-5" >
            <div class="container">
                <div class="row mb-5">
                    <div class="col-12 mb-3">
                       <hr>
                        <div class="container block">
                            <div class="row">
                                <div class="col text-center ">
                                    <p class="mt-3 mb-3 font-weight-bold three-em uc" style="text-transform: uppercase;">CTA categories</p>
                                    <?php
                                    foreach ( $cta_cats_by_slug as $slug => $term ) {
                                        ?>
                                        <a href="#<?php echo esc_html( $slug ) ?>"><?php echo esc_html( $term->name ) ?></a> ( <?php echo esc_html( count( $ctas_by_category[$slug] ) ) ?> )<br>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="w-100"><hr></div>
                        </div>
                        <?php
                        foreach ( $ctas_by_category as $slug => $ctas ) {
                            ?>
                            <div class="container block" id="<?php echo esc_html( $slug ) ?>">
                                <div class="row" style="background-color:lightgrey;">
                                    <div class="col text-center ">
                                        <h2><?php echo esc_html( $cta_cats_by_slug[$slug]->name ) ?></h2>
                                    </div>
                                </div>
                                <div class="w-100"><hr></div>
                            </div>
                            <?php

                            foreach ( $ctas as $cta ) {
                                ?>
                                <div class="container block mb-5">
                                    <div class="row">
                                        <div class="col text-center">
                                            <div class="mx-auto w-fit py-5 px-5 rounded-3 border border-dark">
                                                <h3 class="modal-title"><?php echo esc_html( $cta->post_title ) ?></h3>
                                                <?php echo wp_kses( str_replace( 'wp-element-button', 'btn btn-primary', $cta->post_content ), 'post' ) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- END section -->

        <?php require_once( WP_CONTENT_DIR . '/plugins/prayer-global-porch/pages/assets/working-footer.php' ) ?>
        <?php
    }

}
Prayer_Global_Show_All_CTAS::instance();
