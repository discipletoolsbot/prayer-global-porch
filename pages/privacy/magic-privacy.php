<?php
if ( !defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly.

class Prayer_Global_Porch_Privacy extends DT_Magic_Url_Base
{
    public $magic = false;
    public $parts = false;
    public $page_title = 'Global Prayer - Privacy';
    public $root = 'content_app';
    public $type = 'privacy';
    public $type_name = 'Global Prayer - Privacy';
    public static $token = 'content_app';
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
        require_once( trailingslashit( plugin_dir_path( __DIR__ ) ) . 'assets/header.php' );
        ?>
        <link href="https://fonts.googleapis.com/css?family=Crimson+Text:400,400i,600|Montserrat:200,300,400" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ) ?>assets/fonts/ionicons/css/ionicons.min.css">
        <link rel="stylesheet" href="<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ) ?>assets/css/basic.css?ver=<?php echo esc_attr( fileatime( trailingslashit( plugin_dir_path( __DIR__ ) ) . 'assets/css/basic.css' ) ) ?>" type="text/css" media="all">
        <?php
    }

    public function footer_javascript(){
        require_once( trailingslashit( plugin_dir_path( __DIR__ ) ) . 'assets/footer.php' );
    }

    public function body(){
        require_once( trailingslashit( plugin_dir_path( __DIR__ ) ) . '/assets/nav.php' ) ?>

        <section class="page-section mt-5" >
            <div class="container">
                <div class="row justify-content-md-center text-center mb-5">
                    <div class="col-lg-7">
                        <h2 class="mt-0 font-weight-normal"><?php echo esc_html__( 'Privacy Policy', 'prayer-global-porch' ) ?></h2>

                    </div>
                </div>
                <div class="row">

                    <!-- Item -->
                    <div class="col-12">
                        <hr>
                        <p><?php echo esc_html__( 'This privacy policy has been compiled to better serve those who are concerned with how their "Personally Identifiable Information" (PII) is being used online. PII, as described in US privacy law and information security, is information that can be used on its own or with other information to identify, contact, or locate a single person, or to identify an individual in context. Please read our privacy policy carefully to get a clear understanding of how we collect, use, protect or otherwise handle your Personally Identifiable Information in accordance with our website.', 'prayer-global-porch' ) ?></p>
                    </div>

                    <!-- Item -->
                    <div class="col-12">
                        <hr>
                        <h3 class="secondary"><?php echo esc_html__( 'What permissions do the social sign-on logins ask for?', 'prayer-global-porch' ) ?></h3>
                        <ul>
                        <li><?php echo esc_html__( 'Public Profile. This includes certain User’s Data such as id, name, picture, gender, and their locale.', 'prayer-global-porch' ) ?></li>
                        <li><?php echo esc_html__( 'Email Address.', 'prayer-global-porch' ) ?></li>
                        </ul>
                    </div>

                    <!-- Item -->
                    <div class="col-12">
                        <hr>
                        <h3 class="secondary"><?php echo esc_html__( 'What personal information do we collect from the people through our website?', 'prayer-global-porch' ) ?></h3>
                        <ul>
                            <li><?php echo esc_html__( 'Information in the Basic Social Profile (if used) and email.', 'prayer-global-porch' ) ?></li>
                            <li><?php echo esc_html__( 'Session and course activity.', 'prayer-global-porch' ) ?></li>
                            <li><?php echo esc_html__( 'General location telemetry, so we know in what countries our training is being used.', 'prayer-global-porch' ) ?></li>
                        </ul>
                    </div>

                    <!-- Item -->
                    <div class="col-12">
                        <hr>
                        <h3 class="secondary"><?php echo esc_html__( 'When do we collect information?', 'prayer-global-porch' ) ?></h3>
                        <ul>
                            <li><?php echo esc_html__( 'We collect your information at login.', 'prayer-global-porch' ) ?></li>
                            <li><?php echo esc_html__( 'We also track your progress through the training course.', 'prayer-global-porch' ) ?></li>
                        </ul>
                    </div>

                    <!-- Item -->
                    <div class="col-12">
                        <hr>
                        <h3 class="secondary"><?php echo esc_html__( 'How do we use your information?', 'prayer-global-porch' ) ?></h3>
                        <ul>
                            <li><?php echo esc_html__( 'We use your information to create a user account in the zume system based on your email address.', 'prayer-global-porch' ) ?></li>
                            <li><?php echo esc_html__( 'We will email you with basic transactional emails like password reset requests and other system notifications.', 'prayer-global-porch' ) ?></li>
                            <li><?php echo esc_html__( 'We email occasional reminders and encouragements depending on your progress through the training.', 'prayer-global-porch' ) ?></li>
                        </ul>
                    </div>

                    <!-- Item -->
                    <div class="col-12">
                        <hr>
                        <h3 class="secondary"><?php echo esc_html__( 'How do we protect your information?', 'prayer-global-porch' ) ?></h3>
                        <p><?php echo esc_html__( 'While we use encryption to protect sensitive information transmitted online, we also protect your information offline. Only team members who need the information to perform a specific job (for example, web administrator or customer service) are granted access to personally identifiable information.', 'prayer-global-porch' ) ?></p>
                        <p><?php echo esc_html__( 'Your personal information is contained behind secured networks and is only accessible by a limited number of persons who have special access rights to such systems, and are required to keep the information confidential. In addition, all sensitive/credit information you supply is encrypted via Secure Socket Layer (SSL) technology.', 'prayer-global-porch' ) ?></p>
                        <p><?php echo esc_html__( 'We implement a variety of security measures when a user submits, or accesses their information to maintain the safety of your personal information.', 'prayer-global-porch' ) ?></p>
                    </div>

                    <!-- Item -->
                    <div class="col-12">
                        <hr>
                        <h3 class="secondary"><?php echo esc_html__( 'Do we use "cookies"?', 'prayer-global-porch' ) ?></h3>
                        <p><?php echo esc_html__( 'Any use of Cookies - or of other tracking tools - by this Application or by the owners of third party services used by this Application, unless stated otherwise, serves to identify Users and remember their preferences, for the sole purpose of providing the service required by the User.', 'prayer-global-porch' ) ?></p>
                        <p><?php echo esc_html__( 'Personal Data collected: name, email.', 'prayer-global-porch' ) ?></p>
                    </div>

                    <!-- Item -->
                    <div class="col-12">
                        <hr>
                        <h3 class="secondary"><?php echo esc_html__( 'Your Access to and Control Over Information.', 'prayer-global-porch' ) ?></h3>
                        <p><?php echo esc_html__( 'You may opt out of any future contact from us at any time. You can do the following at any time by contacting us via our contact email address:', 'prayer-global-porch' ) ?></p>
                        <p><?php echo esc_html__( "See what data we've aggregated from your activities with us.", 'prayer-global-porch' ) ?></p>
                        <ul>
                            <li><?php echo esc_html__( 'Change/correct any data we have about you.', 'prayer-global-porch' ) ?></li>
                            <li><?php echo esc_html__( 'Have us delete any data we have about you.', 'prayer-global-porch' ) ?></li>
                            <li><?php echo esc_html__( 'Express any concern you have about our use of your data.', 'prayer-global-porch' ) ?></li>
                        </ul>
                    </div>

                    <!-- Item -->
                    <div class="col-12">
                        <hr>
                        <h3 class="secondary"><?php echo esc_html__( 'Updates', 'prayer-global-porch' ) ?></h3>
                        <p><?php echo esc_html__( 'Our Privacy Policy may change from time to time and all updates will be posted on this page.', 'prayer-global-porch' ) ?></p>
                    </div>

                </div>
            </div>
        </section>
        <!-- END section -->

        <?php require_once( trailingslashit( plugin_dir_path( __DIR__ ) ) . '/assets/working-footer.php' ) ?>
        <?php
    }

}
Prayer_Global_Porch_Privacy::instance();
