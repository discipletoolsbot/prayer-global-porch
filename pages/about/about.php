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



        <section class="page-section center mt-0" data-section="about" id="section-about">
            <div class="container px-4">
                <div class="row justify-content-md-center text-center">
                    <div class="col-lg-7 flow-medium">
                        <h2 class="mt-0 font-weight-normal">About</h2>
                        <p class="border-bottom border-brand-light pb-5 mb-0">
                            Prayer.Global seeks to encourage extraordinary prayer for the fulfillment of the Great Commission using technology.
                        </p>
                    </div>
                </div>

                <a class="pg-accordion__toggle" href="#historic-moment">
                    <i class="icon pg-time icon-small position-absolute start-0 top-0 bottom-0"></i>
                    Historic Moment
                </a>
                <a class="pg-accordion__toggle" href="#how-it-works">
                    <i class="icon pg-question-dark icon-small position-absolute start-0 top-0 bottom-0"></i>
                    How it works
                </a>
                <a class="pg-accordion__toggle" href="#global-race">
                    <i class="icon pg-race icon-small position-absolute start-0 top-0 bottom-0"></i>
                    Global Race
                </a>
                <a class="pg-accordion__toggle" href="#prayer-challenge" data-smaller>
                    <i class="icon pg-prayer icon-small position-absolute start-0 top-0 bottom-0"></i>
                    Moravian Prayer Challenge
                </a>

                <div class="mt-5"><a class="btn btn-cta mx-2 two-em" href="/newest/lap/">Start Praying</a></div>

            </div>
        </section>
        <section class="page-section center mt-0" id="historic-moment">
            <div class="container px-4 flow-medium">
                <i class="icon pg-time icon-medium"></i>
                <h2 style="--pg-flow-size: 0">Historic Moment</h2>
                <p>
                    We know three things about our moment in history:
                </p>
                <p>
                    (1) Never before in history have we been able to coordinate global prayer for the kingdom IN REALTIME!
                </p>
                <p>
                    (2) God has used technology for the advance of His kingdom (i.e. written language, Roman roads, printing presses, etc.),
                        and is now using the internet.
                </p>
                <p>
                    (3) "Extraordinary prayer" is a foundational mark of all modern disciple multiplying movements.
                </p>
            </div>
        </section>
        <section class="page-section center white brand-bg mt-0" id="how-it-works">
            <div class="container px-4 flow-medium font-weight-bold">
                <i class="icon pg-question-dark icon-medium"></i>
                <h2 style="--pg-flow-size: 0">How It Works</h2>
                <p class="left-align">
                    1. Click on "Start Praying". <a href="/newest/lap/"><i class="ion-android-open"></i></a>
                </p>
                <p class="left-align">
                    2. Use the demographics, guided prayers, faith status, images, and maps to pray for the location for one minute.
                </p>
                <p class="left-align">
                    3. Once the one-minute timer has ended, you will be asked if you prayed for this location, if you click "Yes", then your prayer will be added to the community prayer coverage for the world.
                </p>
                <p class="left-align">
                    4. Pray for another location or end your prayer session.
                </p>
            </div>
        </section>
        <section class="page-section center mt-0" id="global-race">
            <div class="container px-4 flow-medium">
                <i class="icon pg-race icon-medium"></i>
                <h2 style="--pg-flow-size: 0">Global Race</h2>
                <h4 class="uppercase white brand-light-bg rounded d-inline-block px-3 py-1 two-em" style="--pg-flow-size: 0">Keys To The Race</h4>

                <div class="border-bottom border-brand-light flow-small">
                    <h4 class="uppercase font-weight-bold d-flex justify-content-center align-items-center gap-3"><i class="icon pg-logo-prayer icon-small"></i> Prayer Lap</h4>
                    <p>
                        A Prayer Lap consists of covering all 4770 geographical "states" of the world in prayer.
                    </p>
                </div>
                <div class="border-bottom border-brand-light flow-small">
                    <h4 class="uppercase font-weight-bold d-flex justify-content-center align-items-center gap-3"><i class="icon pg-world-dark icon-small"></i>Race Map <a href="/race_app/race_map/"><i class="ion-android-open"></i></a></h4>
                    <p>
                        The Race map shows the number of laps, number of minutes, and number of prayer warriors for the entire challenge.
                    </p>
                </div>
                <div class="border-bottom border-brand-light flow-small">
                    <h4 class="uppercase font-weight-bold d-flex justify-content-center align-items-center gap-3"><i class="icon pg-check icon-small"></i> Race List <a href="/race_app/race_list/"><i class="ion-android-open"></i></a></h4>
                    <p>
                        The Race List shows each of the laps accomplished so far and some of the statistics for those individual laps.
                    </p>
                </div>
                <div class="border-bottom border-brand-light flow-small">
                    <h4 class="uppercase font-weight-bold d-flex justify-content-center align-items-center gap-3"><i class="icon pg-world-arrow icon-small"></i> Current Lap</h4>
                    <p>
                        The Current Lap in the "real time" prayer coverage of the 4770 "states" of the world.
                    </p>
                </div>
                <div class="border-bottom border-brand-light flow-small">
                    <h4 class="uppercase font-weight-bold d-flex justify-content-center align-items-center gap-3"><i class="icon pg-world-light icon-small"></i> Current Map <a href="/newest/map"><i class="ion-android-open"></i></a></h4>
                    <p>
                        The current map shows what has been covered so far in the active prayer map.
                    </p>
                </div>
                <div class="border-bottom border-brand-light flow-small">
                    <h4 class="uppercase font-weight-bold d-flex justify-content-center align-items-center gap-3"><i class="icon pg-prayerfuel icon-small"></i> Prayer Fuel</h4>
                    <p>
                        Demographics, scripture, faith status, images and maps to help guide your prayer time.
                    </p>
                </div>
                <div class="border-bottom border-brand-light flow-small">
                    <h4 class="uppercase font-weight-bold d-flex justify-content-center align-items-center gap-3"><i class="icon pg-give icon-small"></i> Faith Status</h4>
                    <div>
                        <i class="ion-ios-body secondary icon-medium d-block lh-1"></i>
                        <p>Know Jesus</p>
                    </div>
                    <div>
                        <i class="ion-ios-body brand-lighter icon-medium d-block lh-1"></i>
                        <p>Know About Jesus</p>
                    </div>
                    <div>
                        <i class="ion-ios-body brand icon-medium d-block lh-1"></i>
                        <p>Don't Know Jesus</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="page-section center white brand-bg mb-5 mt-0" id="prayer-challenge">
            <div class="container px-4 flow-medium font-weight-bold">
                <i class="icon pg-prayer icon-medium"></i>
                <h1 class="lh-1 mb-0" style="--pg-flow-size: 0">Moravian</h1>
                <h2 style="--pg-flow-size: 0">Prayer Challenge</h2>
                <p class="left-align">
                    Inspired by the <a href="https://www.christianitytoday.com/history/issues/issue-1/prayer-meeting-that-lasted-100-years.html">Moravians</a>, who prayed non-stop for 100 years,
                    we have crafted this website to help the church pray for the entire world in measurable units, as a community, and to know at the end when we have finished ... and are ready to start
                    another lap.
                </p>
                <p class="left-align">
                    Once every location in the world has been prayed for (we finish a lap), then the prayer map resets, and we try to pray over the world again
                    ... maybe faster.
                </p>
                <p class="left-align">
                    The Moravians had one person praying every hour of every day for 100 years. This was roughly 876,000 hours of prayer, or 52,560,000 minutes of prayer for the world. We are humbled by this extraordinary commitment to praying for the world.
                </p>
            </div>
        </section>

        <!-- END section -->
        <div class="row d-none">
                    <div class="col-lg-5 ps-md-5 ps-sm-0">
                        <div id="prayer_accordion_" class="pg-accordion" data-children=".item">
                            <div class="item">
                                <a class="pg-accordion__toggle" data-bs-toggle="collapse" href="#prayer_accordion_1" aria-expanded="true" aria-controls="prayer_accordion_1" >
                                    <i class="icon pg-time icon-small position-absolute start-0 top-0 bottom-0"></i>
                                    Historic Moment
                                </a>
                                <div id="prayer_accordion_1" class="accordian-collapse collapse show" role="tabpanel">
                                    <p>
                                        We know three things about our moment in history:
                                    </p>
                                    <p>
                                        (1) Never before in history have we been able to coordinate global prayer for the kingdom IN REALTIME!
                                    </p>
                                    <p>
                                        (2) God has used technology for the advance of His kingdom (i.e. written language, Roman roads, printing presses, etc.),
                                        and is now using the internet.
                                    </p>
                                    <p>
                                        (3) "Extraordinary prayer" is a foundational mark of all modern disciple multiplying movements.
                                    </p>
                                </div>
                            </div>
                            <div class="item">
                                <a class="pg-accordion__toggle" data-bs-toggle="collapse" data-parent="#prayer_accordion_" href="#prayer_accordion_2" aria-expanded="false" aria-controls="prayer_accordion_2">
                                    <i class="icon pg-question-dark icon-small position-absolute start-0 top-0 bottom-0"></i>
                                    How it works
                                </a>
                                <div id="prayer_accordion_2" class="collapse" role="tabpanel">
                                    <p>
                                        1. Click on "Start Praying". <a href="/newest/lap/"><i class="ion-android-open"></i></a>
                                    </p>
                                    <p>
                                        2. Use the demographics, guided prayers, faith status, images, and maps to pray for the location for one minute.
                                    </p>
                                    <p>
                                        3. Once the one-minute timer has ended, you will be asked if you prayed for this location, if you click "Yes", then your prayer will be added to the community prayer coverage for the world.
                                    </p>
                                    <p>
                                        4. Pray for another location or end your prayer session.
                                    </p>
                                </div>
                            </div>
                            <div class="item">
                                <a class="pg-accordion__toggle" data-bs-toggle="collapse" data-parent="#prayer_accordion_" href="#prayer_accordion_4" aria-expanded="false" aria-controls="prayer_accordion_4">
                                    <i class="icon pg-race icon-small position-absolute start-0 top-0 bottom-0"></i>
                                    Global Race
                                </a>
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
                            <div class="item">
                                <a class="pg-accordion__toggle" data-bs-toggle="collapse" data-parent="#prayer_accordion_" data-smaller href="#prayer_accordion_3" aria-expanded="false" aria-controls="prayer_accordion_3">
                                    <i class="icon pg-prayer icon-small position-absolute start-0 top-0 bottom-0"></i>
                                    Moravian Prayer Challenge
                                </a>
                                <div id="prayer_accordion_3" class="collapse brand-bg whit" role="tabpanel">
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
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


        <!-- Video modal -->
        <section class="cover cover-small text-center cover-black d-none" id="section-challenge" style="background-image: url(<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ) ?>assets/images/1900x1200_img_2.jpg)">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <h2 class="heading mb-5">Moravian Prayer Challenge</h2>
                        <p class="sub-heading mb-5" style="border: 1px solid white;">Prayer for the World<br> x <br> 24 hours a day / 7 days a week / 365 days a year <br>x<br> 100 years <br>=<br>52.56 million minutes of prayer</p>
                        <p class="sub-heading mb-5">Who are the Moravians? <br>What is the Moravian Prayer Challenge?<br> How are we going to accept the challenge? <br> Watch this video.</p>
                        <div class="text-center">
                            <img class="img-fluid video-image-link" src="<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ) ?>assets/images/moravian-video.jpg" id="video-image-link" />
                        </div>
                        <div class="text-center mt-3"></div>
                    </div>
                </div>
            </div>
        </section>
        <div class="modal fade" id="demo_video"  tabindex="-1" role="dialog" aria-labelledby="demo_video" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Prayer.Global Intro</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END section -->

        <?php require_once( trailingslashit( plugin_dir_path( __DIR__ ) ) . '/assets/working-footer.php' ) ?>
        <?php
    }

}
Prayer_Global_About::instance();
