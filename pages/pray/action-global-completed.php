<?php
if ( !defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly.


/**
 * Class PG_Global_Prayer_App
 */
class PG_Global_Prayer_App_Completed extends PG_Global_Prayer_App {

    private static $_instance = null;
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    } // End instance()

    public function __construct() {
        parent::__construct();

        // must be valid url
        $url = dt_get_url_path();
        if ( strpos( $url, $this->root . '/' . $this->type ) === false ) {
            return;
        }

        // must be valid parts
        if ( !$this->check_parts_match() ){
            return;
        }

        // must be specific action
        if ( 'completed' !== $this->parts['action'] ) {
            return;
        }

        add_action( 'dt_blank_body', [ $this, 'body' ] );
        add_filter( 'dt_magic_url_base_allowed_css', [ $this, 'dt_magic_url_base_allowed_css' ], 10, 1 );
        add_filter( 'dt_magic_url_base_allowed_js', [ $this, 'dt_magic_url_base_allowed_js' ], 10, 1 );

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
    public function _footer(){
        $this->footer_javascript();
    }

    public function header_javascript(){
        require_once( trailingslashit( plugin_dir_path( __DIR__ ) ) . 'assets/header.php' );
    }

    public function footer_javascript(){
        require_once( trailingslashit( plugin_dir_path( __DIR__ ) ) . 'assets/footer.php' );
    }

    public function body(){
        global $wpdb;

        $parts = $this->parts;
        $lap_stats = pg_global_stats_by_key( $parts['public_key'] );

        if ( empty( $lap_stats['end_time'] ) ) {
            $lap_stats['end_time'] = time();
        }
        $participant_locations = $wpdb->get_results( $wpdb->prepare( "
           SELECT r.label as location, COUNT(r.label) as count
           FROM wp_dt_reports r
            WHERE r.post_type = 'laps'
                AND r.type = 'prayer_app'
            AND r.timestamp >= %d AND r.timestamp <= %d
			AND r.label IS NOT NULL
            GROUP BY r.label
			ORDER BY count DESC
			LIMIT 10
        ", $lap_stats['start_time'], $lap_stats['end_time'] ), ARRAY_A );

        ?>
        <style>
            .cover.completed-lap .container .row {
                height: 10vh;
                padding-top:10vh;
            }
            .cover {
                height: 100vh;
            }
        </style>
        <?php require_once( trailingslashit( plugin_dir_path( __DIR__ ) ) . 'assets/nav.php' );  ?>

        <section class="hero full-height cover bg-center completed-lap cover-black" style="background-image: url(<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ) ?>assets/images/map_background.jpg)" id="section-home">
            <div class="container">
                <div class="row ">
                    <div class="col text-center">
                        <h2 class="heading mb-5">
                            <?php echo esc_attr( sprintf( _X( 'Lap %s Completed!', 'Lap 20 Completed!', 'prayer-global-porch' ), $lap_stats['lap_number']  ) ) ?>
                        </h2>
                        <a href="<?php echo esc_url( '/'. $this->parts['root'] . '/' . $this->parts['type'] . '/' . $this->parts['public_key'] . '/map' ) ?>" role="button" class="btn smoothscroll cta_button btn-primary uppercase"><?php esc_html_e( 'View Map', 'prayer-global-porch' ); ?></a>
                        <a href="/newest/lap/" role="button" class="btn smoothscroll cta_button btn-primary uppercase"><?php esc_html_e( 'Go To The Current Lap', 'prayer-global-porch' ); ?></a> <br>
                        <hr style="border:1px solid white;margin-top:5vh;">
                    </div>
                    <div class="w-100"></div>

                </div>

            </div>
        </section>
        <section class="full-height completed-lap">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h2 class="heading mb-3"><?php esc_html_e( 'Prayer', 'prayer-global-porch' ); ?></h2>
                        <div class="sub-heading ps-4">
                            <p class="mb-0"><?php echo esc_attr( sprintf( _X( '%s of the World Covered in Prayer', '100% of the World Covered in Prayer', 'prayer-global-porch' ), $lap_stats['completed_percent'] . '%' ) ) ?></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h2 class="heading mb-3"><?php esc_html_e( 'Pace', 'prayer-global-porch' ); ?></h2>
                        <div class="sub-heading ps-4">
                            <p class="mb-0"><?php esc_html_e( 'Start', 'prayer-global-porch' ); ?>: <?php echo esc_attr( gmdate( 'M j, Y', $lap_stats['start_time'] ) ) ?></p>
                            <p class="mb-0"><?php esc_html_e( 'End', 'prayer-global-porch' ); ?>: <?php echo esc_attr( ( $lap_stats['end_time'] ) ? gmdate( 'M j, Y', $lap_stats['end_time'] ) : 'ongoing' ) ?></p>
                            <p class="mb-0"><?php echo esc_attr( $lap_stats['time_elapsed'] ) ?></p>
                        </div>
                    </div>
                    <div class="w-100"></div>
                    <div class="col-md-6">
                        <h2 class="heading mb-3"><?php esc_html_e( 'Participants', 'prayer-global-porch' ); ?></h2>
                        <div class="sub-heading ps-4">
                            <p class="mb-0"><?php echo esc_attr( sprintf( _X( '%s Prayer Intercessors Participated', '192 Prayer Intercessors Participated', 'prayer-global-porch' ), $lap_stats['participants'] )  ) ?> </p>

                            <p class="mb-2"><u><?php esc_html_e( 'Top Intercessor Locations', 'prayer-global-porch' ); ?></u></p>
                            <ol class="intercessor-locations">
                                <?php
                                if ( ! empty( $participant_locations ) ) {
                                    foreach ( $participant_locations as $location ) {
                                        ?>
                                        <li class="mb-0"><?php echo esc_html( $location['location'] ) ?></li>
                                        <?php
                                    }
                                }
                                ?>
                            </ol>
                        </div>
                    </div>
                    <div class="w-100"></div>

                    <div class="col-md-6">
                    </div>
                    <div class="col-md-6">
                        <div class="sub-heading ps-4">
                        </div>
                    </div>
                    <div class="col center">

                    </div>
                </div>
            </div>
        </section>


        <?php
    }

}
PG_Global_Prayer_App_Completed::instance();
