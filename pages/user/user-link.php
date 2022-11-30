<?php
if ( !defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly.

/**
 * Class Prayer_Global_Porch_Public_Porch_Profile
 */
class PG_User_App_Profile extends DT_Magic_Url_Base {

    public $page_title = 'User Profile';
    public $root = 'user_app';
    public $type = 'profile';
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

        add_action( 'rest_api_init', [ $this, 'add_endpoints' ] );

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

        // require login access
//        if ( ! is_user_logged_in() ) {
//            wp_safe_redirect( dt_custom_login_url( 'login' ) );
//        }


        // load if valid url
        add_action( 'dt_blank_body', [ $this, 'body' ] ); // body for no post key

        add_filter( 'dt_magic_url_base_allowed_css', [ $this, 'dt_magic_url_base_allowed_css' ], 10, 1 );
        add_filter( 'dt_magic_url_base_allowed_js', [ $this, 'dt_magic_url_base_allowed_js' ], 10, 1 );
        add_action( 'wp_enqueue_scripts', [ $this, 'wp_enqueue_scripts' ], 99 );
    }

    public function dt_magic_url_base_allowed_css( $allowed_css ) {
        return [
            'porch-user-style-css',
            'jquery-ui-site-css',
            'foundations-css',
        ];
    }

    public function dt_magic_url_base_allowed_js( $allowed_js ) {
        return [
            'jquery',
            'jquery-ui',
            'foundations-js',
            'porch-user-site-js',
        ];
    }

    public function wp_enqueue_scripts() {}

    public function header_javascript(){
        require_once( trailingslashit( plugin_dir_path( __DIR__ ) ) . 'assets/header.php' );
        ?>
        <script>
            let jsObject = [<?php echo json_encode([
                'map_key' => DT_Mapbox_API::get_key(),
                'root' => esc_url_raw( rest_url() ),
                'nonce' => wp_create_nonce( 'wp_rest' ),
                'parts' => $this->parts,
                'user' => wp_get_current_user(),
                'translations' => [
                    'add' => __( 'Add Magic', 'disciple-tools-porch-template' ),
                ],
                'is_logged_in' => is_user_logged_in() ? 1 : 0,
                'logout_url' => esc_url( wp_logout_url( '/' ) )
            ]) ?>][0]
        </script>
        <script src="<?php echo esc_url( trailingslashit( plugin_dir_url( __FILE__ ) ) ) ?>user-link.js?ver=<?php echo esc_attr( fileatime( trailingslashit( plugin_dir_path( __FILE__ ) ) . 'user-link.js' ) ) ?>"></script>
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

    public function body(){
        require_once( trailingslashit( plugin_dir_path( __DIR__ ) ) . '/assets/nav.php' );

        ?>
        <section class="page-section" data-section="login" id="section-login">
            <div class="container">
                <div class="row justify-content-md-center text-center">
                    <div class="col-lg-7 flow" id="pg_content"></div>
                </div>
            </div>
            <div class="offcanvas offcanvas-end" id="user-profile-details" data-bs-backdrop="true" data-bs-scroll="false">
                <div class="offcanvas__header"><button type="button" data-bs-dismiss="offcanvas" style="text-align: start"><i class="ion-chevron-right three-em"></i></button></div>
                <div class="row offcanvas__content" id="user-details-content"></div>
           </div>
        </section>
        <?php
    }

    /**
     * Register REST Endpoints
     * @link https://github.com/DiscipleTools/disciple-tools-theme/wiki/Site-to-Site-Link for outside of wordpress authentication
     */
    public function add_endpoints() {
        $namespace = $this->root . '/v1';
        register_rest_route(
            $namespace, '/'.$this->type, [
                [
                    'methods'  => "POST",
                    'callback' => [ $this, 'endpoint' ],
                    'permission_callback' => '__return_true',
                ],
            ]
        );
    }

    public function endpoint( WP_REST_Request $request ) {

        $params = $request->get_params();

        if ( ! isset( $params['parts'], $params['action'] ) ) {
            return new WP_Error( __METHOD__, "Missing parameters", [ 'status' => 400 ] );
        }

        $params = dt_recursive_sanitize_array( $params );

        switch ( $params['action'] ) {
            case 'login':
                $user = get_user_by( 'email', $params['data']['email'] );

                if ( $user ) {
                    if ( wp_check_password( $params['data']['pass'], $user->data->user_pass ) ) {
                        // password match
                        $logged_in = $this->programmatic_login( $user->data->user_login );
                        if ( $logged_in ) {
                            return $user;
                        }
                    }
                }
                return false;
            default:
                return $params;
        }


    }

    /**
     * Programmatically logs a user in
     *
     * @param string $username
     * @return bool True if the login was successful; false if it wasn't
     */
    public function programmatic_login( $username ): bool
    {
        if ( is_user_logged_in() ) {
            wp_logout();
        }

        add_filter( 'authenticate', [ $this, 'allow_programmatic_login' ], 10, 3 );    // hook in earlier than other callbacks to short-circuit them
        $user = wp_signon( array( 'user_login' => $username ) );
        remove_filter( 'authenticate', [ $this, 'allow_programmatic_login' ], 10, 3 );

        if ( is_a( $user, 'WP_User' ) ) {
            wp_set_current_user( $user->ID, $user->user_login );

            if ( is_user_logged_in() ) {
                return true;
            }
        }

        return false;
    }

    /**
     * An 'authenticate' filter callback that authenticates the user using only     the username.
     *
     * To avoid potential security vulnerabilities, this should only be used in     the context of a programmatic login,
     * and unhooked immediately after it fires.
     *
     * @param WP_User $user
     * @param string $username
     * @param string $password
     * @return bool|WP_User a WP_User object if the username matched an existing user, or false if it didn't
     */
    public function allow_programmatic_login( $user, $username, $password ) {
        return get_user_by( 'login', $username );
    }

}
PG_User_App_Profile::instance();
