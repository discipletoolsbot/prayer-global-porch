<?php
if ( !defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly.

class Prayer_Global_About extends DT_Magic_Url_Base
{
    public $magic = false;
    public $parts = false;
    public $page_title = 'Global Prayer - About';
    public $root = 'content_app';
    public $type = 'about_page';
    public $type_name = 'Global Prayer - About';
    public static $token = 'content_app_about';
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

        <section class="page-section d-sm-none d-md-block" data-section="about" id="section-about">
            <div class="container">
                <div class="row justify-content-md-center text-center mb-5">
                    <div class="col-lg-7">
                        <h2 class="mt-0 header-border-top font-weight-normal">About</h2>
                        <p>
                            Prayer.Global seeks to encourage extraordinary prayer for the fulfillment of the Great Commission using technology.
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-7">
                        <div class="images right">
                            <img class="img1 img-fluid" src="<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ) ?>assets/images/pray-4770.jpg" alt="image">
                            <img class="img2" src="<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ) ?>assets/images/dark-map.jpg" alt="image">
                        </div>
                    </div>
                    <div class="col-lg-5 ps-md-5 ps-sm-0">
                        <div id="prayer_accordion_" class="pg-accordion" data-children=".item">
                            <div class="item">
                                <a class="pg-accordion__toggle" data-bs-toggle="collapse" href="#prayer_accordion_1" aria-expanded="true" aria-controls="prayer_accordion_1" >Historic Moment</a>
                                <div id="prayer_accordion_1" class="accordian-collapse collapse show" role="tabpanel">
                                    <p>
                                        We know three things about our moment in history:
                                    </p>
                                    <p>
                                        (1) Never before in history have we been able to coordinate global prayer for the kingdom <u>IN REALTIME</u>!
                                    </p>
                                    <p>
                                        (2) God has used technology for the advance of His kingdom (i.e. written language, Roman roads, printing presses, etc.),
                                        and is now using the internet.
                                    </p>
                                    <p>
                                        (3) "Extraordinary prayer" is a foundational mark of all modern disciple multiplying movements.
                                    </p>
                                    <p>
                                        So, <strong>Prayer.Global</strong> exists to encourage extraordinary prayer for the fulfillment of the Great Commission using technology.
                                    </p>
                                    <p>
                                        <br><hr>
                                    </p>
                                </div>
                            </div>
                            <div class="item">
                                <a class="pg-accordion__toggle" data-bs-toggle="collapse" data-parent="#prayer_accordion_" href="#prayer_accordion_2" aria-expanded="false" aria-controls="prayer_accordion_2">How it works</a>
                                <div id="prayer_accordion_2" class="collapse" role="tabpanel">
                                    <p>
                                        <span class="black">&#9312;</span> Click on "Start Praying". <a href="/newest/lap/"><i class="ion-android-open"></i></a>
                                    </p>
                                    <p>
                                        <strong class="black">&#9313;</strong> Use the demographics, guided prayers, faith status, images, and maps to pray for the location for one minute.
                                    </p>
                                    <p>
                                        <strong class="black">&#9314;</strong> Once the one-minute timer has ended, you will be asked if you prayed for this location, if you click "Yes", then your prayer will be added to the community prayer coverage for the world.
                                    </p>
                                    <p>
                                        <strong class="black">&#9315;</strong> Pray for another location or end your prayer session.
                                    </p>
                                    <p>
                                        <br><hr>
                                    </p>
                                </div>
                            </div>
                            <div class="item">
                                <a class="pg-accordion__toggle" data-bs-toggle="collapse" data-parent="#prayer_accordion_" href="#prayer_accordion_3" aria-expanded="false" aria-controls="prayer_accordion_3">Moravian Prayer Challenge</a>
                                <div id="prayer_accordion_3" class="collapse" role="tabpanel">
                                    <p>
                                        Inspired by the <a href="https://www.christianitytoday.com/history/issues/issue-1/prayer-meeting-that-lasted-100-years.html">Moravians</a>, who prayed non-stop for 100 years,
                                        we have crafted this website to help the church pray for the entire world in measurable units, as a community, and to know at the end when we have finished ... and are ready to start
                                        another lap.
                                    </p>
                                    <p>
                                        Once every location in the world has been prayed for (we finish a lap), then the prayer map resets, and we try to pray over the world again
                                        ... maybe faster.
                                    </p>
                                    <p>
                                        The Moravians had one person praying every hour of every day for 100 years. This was roughly 876,000 hours of prayer, or 52,560,000 minutes of prayer for the world. We are humbled by this extraordinary commitment to praying for the world.
                                    </p>
                                    <p>
                                        <br><hr>
                                    </p>
                                </div>
                            </div>
                            <div class="item">
                                <a class="pg-accordion__toggle" data-bs-toggle="collapse" data-parent="#prayer_accordion_" href="#prayer_accordion_4" aria-expanded="false" aria-controls="prayer_accordion_4">Maps & Lists</a>
                                <div id="prayer_accordion_4" class="collapse" role="tabpanel">
                                    <p>
                                        <strong class="black">Current Map</strong> <a href="/newest/map"><i class="ion-android-open"></i></a>
                                    </p>
                                    <p>
                                        The current map shows what has been covered so far in the active prayer map.
                                    </p>
                                    <p>
                                        <strong class="black">Race Map</strong> <a href="/race_app/race_map/"><i class="ion-android-open"></i></a>
                                    </p>
                                    <p>
                                        The Race map shows the number of laps, number of minutes, and number of prayer warriors for the entire challenge.
                                    </p>
                                    <p>
                                        <strong class="black">Race List</strong> <a href="/race_app/race_list/"><i class="ion-android-open"></i></a>
                                    </p>
                                    <p>
                                        The Race List shows each of the laps accomplished so far and some of the statistics for those individual laps.
                                    </p>
                                    <p>
                                        <br><hr>
                                    </p>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- END section -->

        <?php require_once( trailingslashit( plugin_dir_path( __DIR__ ) ) . '/assets/working-footer.php' ) ?>
        <?php
    }

}
Prayer_Global_About::instance();
