<?php

/**
 * Displays a page for the user to login/register and recover password etc.
 *
 * Any part of the site can send the user to the login page with an encoded redirect url to get back to where they were,
 * after the login/registration.
 */
class PG_User_Login_Registration extends DT_Magic_Url_Base {

    public $page_title = 'User Login';
    public $root = 'user_app';
    public $type = 'login';
    public $post_type = 'user';

    private static $_instance = null;
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    } // End instance()

    public function __construct() {
        parent::__construct();

        /**
         * tests if other URL
         */
        $url = dt_get_url_path();
        if ( strpos( $url, $this->root . '/' . $this->type ) === false ) {
            return;
        }
        /**
         * tests magic link parts are registered and have valid elements
         */
        if ( !$this->check_parts_match( false ) ){
            return;
        }

        // load if valid url
        add_action( 'dt_blank_body', [ $this, 'body' ] ); // body for no post key

        add_filter( 'dt_magic_url_base_allowed_css', [ $this, 'dt_magic_url_base_allowed_css' ], 10, 1 );
        add_filter( 'dt_magic_url_base_allowed_js', [ $this, 'dt_magic_url_base_allowed_js' ], 10, 1 );
        add_action( 'wp_enqueue_scripts', [ $this, 'wp_enqueue_scripts' ], 99 );
    }

    public function dt_magic_url_base_allowed_css( $allowed_css ) {
        return [];
    }

    public function dt_magic_url_base_allowed_js( $allowed_js ) {
        return array_merge( $allowed_js, [
            'jquery',
        ]);
    }

    public function wp_enqueue_scripts() {}

    public function header_javascript(){
        require_once( trailingslashit( plugin_dir_path( __DIR__ ) ) . 'assets/header.php' );

        $user_id = get_current_user_id();

        ?>
        <script>
            let jsObject = [<?php echo json_encode([
                'root' => esc_url_raw( rest_url() ),
                'nonce' => wp_create_nonce( 'wp_rest' ),
                'parts' => $this->parts,
                'is_logged_in' => is_user_logged_in() ? 1 : 0,
                'logout_url' => esc_url( '/user_app/logout' ),
                'redirect_url' => DT_Login_Fields::get( 'redirect_url' ),
            ]) ?>][0]
        </script>
        <script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js?ver=3"></script>
        <style>
            #login_form input {
                padding:.5em;
            }
        </style>
        <?php
    }

    public function footer_javascript(){
        require_once( trailingslashit( plugin_dir_path( __DIR__ ) ) . 'assets/footer.php' );
    }


    public function body() {
        require_once( trailingslashit( plugin_dir_path( __DIR__ ) ) . '/assets/nav.php' );

        /* if ( is_user_logged_in() ) {
            if ( isset( $_GET['redirect_to'] ) ) {
                $redirect_to = urldecode( wp_sanitize_redirect( wp_unslash( $_GET['redirect_to'] ) ) );
            } else {
                $redirect_to = DT_Login_Fields::get( 'redirect_url' );
            }

            header( "Location: $redirect_to" );
        } */

        ?>

        <script>

            $(document).ready(function($) {
                window.getAuthUser(
                    () => {
                        const url = new URL(location.href)
                        const redirectTo = url.searchParams.get('redirect_to') || encodeURIComponent('/user_app/profile')

                        location.href = decodeURIComponent(redirectTo)
                    },
                    () => {
                        document.getElementById('login-ui').style.display = 'block'
                        document.getElementById('login-ui-loader').style.display = 'none'
                    }
                )
            })

        </script>

        <section class="page-section" data-section="login" id="section-login">
            <div class="container">
                <div class="row justify-content-md-center text-center">
                    <div class="col-lg-7" id="pg_content">
                        <h2 class="header-border-top"><?php echo esc_html__( 'Login', 'prayer-global-porch' ) ?></h2>

                        <div id="login-ui" style="display: none;">
                            <?php echo do_shortcode( '[dt_firebase_login_ui]' ) ?>
                        </div>
                        <div id="login-ui-loader">
                            <span class="loading-spinner active"></span>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <script src="<?php echo esc_url( trailingslashit( plugin_dir_url( __FILE__ ) ) ) ?>user-mobile-login.js?ver=<?php echo esc_attr( fileatime( trailingslashit( plugin_dir_path( __FILE__ ) ) . 'user-mobile-login.js' ) ) ?>" defer></script>

        <?php

    }

}
PG_User_Login_Registration::instance();