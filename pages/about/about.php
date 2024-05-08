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
            <a href="#" class="text-decoration-none btn-top hide"><i class="icon pg-chevron-up"></i></a>
            <div class="container px-4">
                <div class="row justify-content-md-center text-center">
                    <div class="col-lg-8 flow-medium">
                        <h2 class="mt-0 font-weight-normal"><?php echo esc_html( __( 'About', 'prayer-global-porch' ) ) ?></h2>
                        <p class="pb-5 mb-0">
                            <?php echo esc_html( sprintf( __( '%s seeks to encourage extraordinary prayer for the fulfillment of the Great Commission using technology.', 'prayer-global-porch' ), 'Prayer.Global' ) ) ?>
                        </p>

                        <div class="border-top border-brand-light">
                            <a class="pg-accordion__toggle" href="#historic-moment">
                                <i class="icon pg-time icon-small position-absolute start-0 top-0 bottom-0"></i>
                                <?php echo esc_html( __( 'Historic Moment', 'prayer-global-porch' ) ) ?>
                            </a>
                            <a class="pg-accordion__toggle" href="#how-it-works">
                                <i class="icon pg-question-dark icon-small position-absolute start-0 top-0 bottom-0"></i>
                                <?php echo esc_html( __( 'How it works', 'prayer-global-porch' ) ) ?>
                            </a>
                            <a class="pg-accordion__toggle" href="#global-race">
                                <i class="icon pg-race icon-small position-absolute start-0 top-0 bottom-0"></i>
                                <?php echo esc_html( __( 'Global Race', 'prayer-global-porch' ) ) ?>
                            </a>
                            <a class="pg-accordion__toggle" href="#prayer-challenge" data-smaller>
                                <i class="icon pg-prayer icon-small position-absolute start-0 top-0 bottom-0"></i>
                                <?php echo esc_html( __( 'Moravian Prayer Challenge', 'prayer-global-porch' ) ) ?>
                            </a>
                        </div>

                    </div>
                </div>
                <div class="mt-5"><a class="btn btn-cta mx-2 two-rem" href="/newest/lap/"><?php echo esc_html( __( 'Start Praying', 'prayer-global-porch' ) ) ?></a></div>

            </div>
        </section>
        <section class="page-section center mt-0 pb-4" id="historic-moment">
            <div class="container px-4">
                <div class="row justify-content-md-center text-center">
                    <div class="col-lg-8 flow-medium">
                        <i class="icon pg-time icon-medium"></i>
                        <h2 style="--pg-flow-size: 0"><?php echo esc_html( __( 'Historic Moment', 'prayer-global-porch' ) ) ?></h2>
                        <p>
                            <?php echo esc_html( __( 'We know three things about our moment in history:', 'prayer-global-porch' ) ) ?>
                        </p>
                        <p>
                            <?php echo esc_html( __( '(1) Never before in history have we been able to coordinate global prayer for the kingdom IN REALTIME!', 'prayer-global-porch' ) ) ?>
                        </p>
                        <p>
                            <?php echo esc_html( __( '(2) God has used technology for the advance of His kingdom (i.e. written language, Roman roads, printing presses, etc.),
                            and is now using the Internet.', 'prayer-global-porch' ) ) ?>
                        </p>
                        <p>
                            <?php echo esc_html( __( '(3) Extraordinary prayer is a foundational mark of all modern disciple multiplying movements.', 'prayer-global-porch' ) ) ?>
                        </p>
                        <a class="d-block text-decoration-none brand-light" href="#how-it-works"><i class="icon pg-chevron-down icon-small"></i></a>
                    </div>
                </div>
            </div>
        </section>
        <section class="page-section center white brand-bg mt-0 pb-4" id="how-it-works">
            <div class="container px-4 font-weight-bold">
                <div class="row justify-content-md-center text-center">
                    <div class="col-lg-8 flow-medium">
                        <i class="icon pg-question-dark icon-medium"></i>
                        <h2 style="--pg-flow-size: 0"><?php echo esc_html( __( 'How It Works', 'prayer-global-porch' ) ) ?></h2>
                        <p class="left-align">
                            1. <?php echo sprintf( esc_html__( 'Click on %1$sStart Praying%2$s.', 'prayer-global-porch' ), '<a class="link-light" href="/newest/lap/">', '</a>' ) ?>
                        </p>
                        <p class="left-align">
                            2. <?php echo esc_html( __( 'Pray over the location provided using the maps, photos, prayers, people group info, and facts.', 'prayer-global-porch' ) ) ?>
                        </p>
                        <p class="left-align">
                            3. <?php echo esc_html( __( 'Pray for one minute (or longer) as the Spirit leads.', 'prayer-global-porch' ) ) ?>
                        </p>
                        <p class="left-align">
                            4. <?php echo esc_html__( 'When the timer finishes', 'prayer-global-porch' ) ?>
                            <br>
                            <?php echo sprintf( esc_html( __( 'Click Done to see your impact on the map or %sclick Next to pray for another location', 'prayer-global-porch' ) ), '' ) ?>
                        </p>
                        <a class="d-block text-decoration-none white" href="#global-race"><i class="icon pg-chevron-down icon-small"></i></a>
                    </div>
                </div>
            </div>
        </section>
        <section class="page-section center mt-0 pb-4" id="global-race">
            <div class="container px-4">
                <div class="row justify-content-md-center text-center">
                    <div class="col-lg-8 flow-medium">
                        <i class="icon pg-race icon-medium"></i>
                        <h2 style="--pg-flow-size: 0"><?php echo esc_html( __( 'Global Race', 'prayer-global-porch' ) ) ?></h2>
                        <h4 class="uppercase white brand-light-bg rounded d-inline-block px-3 py-1 two-em" style="--pg-flow-size: 0"><?php echo esc_html( __( 'Keys To The Race', 'prayer-global-porch' ) ) ?></h4>

                        <div class="border-bottom border-brand-light flow-small">
                        <h4 class="uppercase font-weight-bold d-flex justify-content-center align-items-center gap-3"><i class="icon pg-logo-prayer icon-small"></i> <?php echo esc_html( __( 'Prayer Lap', 'prayer-global-porch' ) ) ?></h4>
                            <p>
                                <?php echo esc_html( __( 'A Prayer Lap consists of covering all 4770 geographical states of the world in prayer.', 'prayer-global-porch' ) ) ?>
                            </p>
                        </div>
                        <div class="border-bottom border-brand-light flow-small">
                            <h4 class="uppercase font-weight-bold d-flex justify-content-center align-items-center gap-3"><i class="icon pg-world-dark icon-small"></i><a href="/race_app/race_map/"><?php echo esc_html( __( 'Race Map', 'prayer-global-porch' ) ) ?></a></h4>
                            <p>
                                <?php echo esc_html( __( 'The Race map shows the number of laps, number of minutes, and number of prayer intercessors for the entire challenge.', 'prayer-global-porch' ) ) ?>
                            </p>
                        </div>
                        <div class="border-bottom border-brand-light flow-small">
                            <h4 class="uppercase font-weight-bold d-flex justify-content-center align-items-center gap-3"><i class="icon pg-check icon-small"></i> <a href="/race_app/race_list/"><?php echo esc_html( __( 'Race List', 'prayer-global-porch' ) ) ?></a></h4>
                            <p>
                                <?php echo esc_html( __( 'The Race List shows each of the laps accomplished so far and some of the statistics for those individual laps.', 'prayer-global-porch' ) ) ?>
                            </p>
                        </div>
                        <div class="border-bottom border-brand-light flow-small">
                            <h4 class="uppercase font-weight-bold d-flex justify-content-center align-items-center gap-3"><i class="icon pg-world-arrow icon-small"></i> <?php echo esc_html( __( 'Current Lap', 'prayer-global-porch' ) ) ?></h4>
                            <p>
                                <?php echo esc_html( __( 'The Current Lap in the real time prayer coverage of the 4770 states of the world.', 'prayer-global-porch' ) ) ?>
                            </p>
                        </div>
                        <div class="border-bottom border-brand-light flow-small">
                            <h4 class="uppercase font-weight-bold d-flex justify-content-center align-items-center gap-3"><i class="icon pg-world-light icon-small"></i> <a href="/newest/map"><?php echo esc_html( __( 'Current Map', 'prayer-global-porch' ) ) ?></a></h4>
                            <p>
                                <?php echo esc_html( __( 'The current map shows what has been covered so far in the active prayer map.', 'prayer-global-porch' ) ) ?>
                            </p>
                        </div>
                        <div class="border-bottom border-brand-light flow-small">
                        <h4 class="uppercase font-weight-bold d-flex justify-content-center align-items-center gap-3"><i class="icon pg-prayerfuel icon-small"></i> <?php echo esc_html( __( 'Prayer Fuel', 'prayer-global-porch' ) ) ?></h4>
                            <p>
                                <?php echo esc_html( __( 'Demographics, scripture, faith status, images and maps to help guide your prayer time.', 'prayer-global-porch' ) ) ?>
                            </p>
                        </div>
                        <div class="border-bottom border-brand-light flow-small" id="faith-status-icons">
                            <h4 class="uppercase font-weight-bold d-flex justify-content-center align-items-center gap-3"><i class="icon pg-give icon-small"></i> <?php echo esc_html( __( 'Faith Status', 'prayer-global-porch' ) ) ?></h4>
                            <div>
                                <i class="ion-ios-body secondary icon-medium d-block lh-1"></i>
                                <p><?php echo esc_html( __( 'Know Jesus', 'prayer-global-porch' ) ) ?></p>
                            </div>
                            <div>
                                <i class="ion-ios-body brand-lighter icon-medium d-block lh-1"></i>
                                <p><?php echo esc_html( __( 'Know About Jesus', 'prayer-global-porch' ) ) ?></p>
                            </div>
                            <div>
                                <i class="ion-ios-body brand icon-medium d-block lh-1"></i>
                                <p><?php echo esc_html( __( "Don't Know Jesus", 'prayer-global-porch' ) ) ?></p>
                            </div>
                        </div>

                        <a class="d-block text-decoration-none brand-light" href="#prayer-challenge"><i class="icon pg-chevron-down icon-small"></i></a>
                    </div>
                </div>
            </div>
        </section>
        <section class="page-section center white brand-bg mb-5 mt-0" id="prayer-challenge">
            <div class="container px-4 font-weight-bold">
                <div class="row justify-content-md-center text-center">
                    <div class="col-lg-8 flow-medium">
                        <i class="icon pg-prayer icon-medium"></i>
                        <h1 class="lh-1 mb-0" style="--pg-flow-size: 0"><?php echo esc_html( __( 'Moravian', 'prayer-global-porch' ) ) ?></h1>
                        <h2 style="--pg-flow-size: 0"><?php echo esc_html( __( 'Prayer Challenge', 'prayer-global-porch' ) ) ?></h2>
                        <p class="left-align">
                            <?php echo wp_kses( sprintf( __( 'Inspired by the %1$sMoravians%2$s, who prayed non-stop for 100 years, we have crafted this website to help the church pray for the entire world in measurable units, as a community, and to know at the end when we have finished ... and are ready to start another lap.', 'prayer-global-porch' ), '<a class="link-light" href="https://www.christianitytoday.com/history/issues/issue-1/prayer-meeting-that-lasted-100-years.html">', '</a>' ), 'post' ) ?>
                        </p>
                        <p class="left-align">
                            <?php echo esc_html( __( 'Once every location in the world has been prayed for (we finish a lap), then the prayer map resets, and we try to pray over the world again ... maybe faster.', 'prayer-global-porch' ) ) ?>
                        </p>
                        <p class="left-align">
                            <?php echo esc_html( __( 'The Moravians had one person praying every hour of every day for 100 years. This was roughly 876,000 hours of prayer, or 52,560,000 minutes of prayer for the world. We are humbled by this extraordinary commitment to praying for the world.', 'prayer-global-porch' ) ) ?>
                        </p>
                        <a class="d-block text-decoration-none white" href="#">
                            <i class="icon pg-chevron-up icon-small"></i>
                            <h5 class="uppercase"><?php echo esc_html( __( 'Top', 'prayer-global-porch' ) ) ?></h5>
                        </a>
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
