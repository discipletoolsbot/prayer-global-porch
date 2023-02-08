<?php
if ( !defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly.

class Prayer_Global_Show_All extends DT_Magic_Url_Base
{
    public $magic = false;
    public $parts = false;
    public $page_title = 'Global Prayer - Show All';
    public $root = 'show_app';
    public $type = 'all_content';
    public $type_name = 'Global Prayer - Show All';
    public static $token = 'show_app_all_content';
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
        if ( isset( $_GET['grid_id'] ) ) {
            $grid_id = sanitize_text_field( wp_unslash( $_GET['grid_id'] ) );
        } else {
            $grid_id = '100000003';
        }
        $stack = PG_Stacker::_stack_query( $grid_id );

        $empty_array = [];
        $lists = [];

        $lists['_for_extraordinary_prayer'] = PG_Stacker_Text::_for_extraordinary_prayer( $empty_array, $stack, true );

        $lists['_for_intentional_movement_strategy'] = PG_Stacker_Text::_for_intentional_movement_strategy( $empty_array, $stack, true );

        $lists['_for_abundant_gospel_sowing'] = PG_Stacker_Text::_for_abundant_gospel_sowing( $empty_array, $stack, true );

        $lists['_for_persons_of_peace'] = PG_Stacker_Text::_for_persons_of_peace( $empty_array, $stack, true );

        $lists['_for_prioritizing_priesthood_of_believers'] = PG_Stacker_Text::_for_prioritizing_priesthood_of_believers( $empty_array, $stack, true );



        $lists['_for_media_resources'] = PG_Stacker_Text::_for_media_resources( $empty_array, $stack, true );

        $lists['_for_safety'] = PG_Stacker_Text::_for_safety( $empty_array, $stack, true );

        $lists['_for_political_stability'] = PG_Stacker_Text::_for_political_stability( $empty_array, $stack, true );



        $lists['_for_church_health'] = PG_Stacker_Text::_for_church_health( $empty_array, $stack, true );

        $lists['_for_multiplication'] = PG_Stacker_Text::_for_multiplication( $empty_array, $stack, true );

        $lists['_for_movement_essential_simple_churches'] = PG_Stacker_Text::_for_movement_essential_simple_churches( $empty_array, $stack, true );

        $lists['_for_new_churches'] = PG_Stacker_Text::_for_new_churches( $empty_array, $stack, true );

        $lists['_for_multiplying_churches'] = PG_Stacker_Text::_for_multiplying_churches( $empty_array, $stack, true );

        $lists['_for_multiplying_disciples'] = PG_Stacker_Text::_for_multiplying_disciples( $empty_array, $stack, true );



        $lists['_for_demographic_feature_total_population'] = PG_Stacker_Text::_for_demographic_feature_total_population( $empty_array, $stack, true );

        $lists['_for_demographic_feature_population_non_christians'] = PG_Stacker_Text::_for_demographic_feature_population_non_christians( $empty_array, $stack, true );

        $lists['_for_demographic_feature_population_christian_adherents'] = PG_Stacker_Text::_for_demographic_feature_population_christian_adherents( $empty_array, $stack, true );

        $lists['_for_demographic_feature_population_believers'] = PG_Stacker_Text::_for_demographic_feature_population_believers( $empty_array, $stack, true );

        $lists['_for_demographic_feature_primary_religion'] = PG_Stacker_Text::_for_demographic_feature_primary_religion( $empty_array, $stack, true );

        $lists['_for_demographic_feature_primary_language'] = PG_Stacker_Text::_for_demographic_feature_primary_language( $empty_array, $stack, true );




        $lists['_for_people_groups_by_least_reached_status'] = PG_Stacker_Text::_for_people_groups_by_least_reached_status( $empty_array, $stack, true );

        $lists['_for_people_groups_by_reached_status'] = PG_Stacker_Text::_for_people_groups_by_reached_status( $empty_array, $stack, true );

        $lists['_for_people_groups_by_religion'] = PG_Stacker_Text::_for_people_groups_by_religion( $empty_array, $stack, true );

        $lists['_for_people_groups_by_population'] = PG_Stacker_Text::_for_people_groups_by_population( $empty_array, $stack, true );



        $lists['_for_local_leadership'] = PG_Stacker_Text::_for_local_leadership( $empty_array, $stack, true ); // convert these to the next series below

        $lists['_for_apostolic_pioneering_leadership'] = PG_Stacker_Text::_for_apostolic_pioneering_leadership( $empty_array, $stack, true );;

        $lists['_for_evangelistic_leadership'] = PG_Stacker_Text::_for_evangelistic_leadership( $empty_array, $stack, true );;

        $lists['_for_prophetic_leadership'] = PG_Stacker_Text::_for_prophetic_leadership( $empty_array, $stack, true );;

        $lists['_for_shepherding_leadership'] = PG_Stacker_Text::_for_shepherding_leadership( $empty_array, $stack, true );;

        $lists['_for_teaching_leadership'] = PG_Stacker_Text::_for_teaching_leadership( $empty_array, $stack, true );;



        $lists['_for_biblical_authority_over_the_believers'] = PG_Stacker_Text::_for_biblical_authority_over_the_believers( $empty_array, $stack, true );

        $lists['_for_obedience_in_the_believers'] = PG_Stacker_Text::_for_obedience_in_the_believers( $empty_array, $stack, true );

        $lists['_for_trust_in_the_believers'] = PG_Stacker_Text::_for_trust_in_the_believers( $empty_array, $stack, true );

        $lists['_for_faith_in_the_believers'] = PG_Stacker_Text::_for_faith_in_the_believers( $empty_array, $stack, true );

        $lists['_for_love_in_the_believers'] = PG_Stacker_Text::_for_love_in_the_believers( $empty_array, $stack, true );

        $lists['_for_urgency_in_the_believers'] = PG_Stacker_Text::_for_urgency_in_the_believers( $empty_array, $stack, true );



        $lists['_for_bible_promises_for_the_believer'] = PG_Stacker_Text::_for_bible_promises_for_the_believer( $empty_array, $stack, true );

        $lists['_for_bible_promises_for_the_lost'] = PG_Stacker_Text::_for_bible_promises_for_the_lost( $empty_array, $stack, true );



        $lists['_cities'] = PG_Stacker_Text::_cities( $empty_array, $stack, true );


        require_once( WP_CONTENT_DIR . '/plugins/prayer-global-porch/pages/assets/nav.php' ) ?>

        <section class="page-section mt-5" >
            <div class="container">
                <div class="row justify-content-md-center text-center mb-5">
                    <div class="col-lg-7">
                        <h2 class="mt-0 header-border-top font-weight-normal">Show All</h2>
                        <p>
                            <select id="country_change">
                                <option></option>
                                <option value="100219450">Bhagalpur, Bihar, India</option>
                                <option value="100241389">Kauno, Lithuania</option>
                                <option value="100219618">Lohardaga, Jharkhand, India</option>
                                <option value="100385116">Mashonaland West, Zimbabwe</option>
                                <option value="100235211">Otdar Mean Chey, Cambodia</option>
                                <option value="100363330">Ternopil‘, Ukraine</option>
                                <option value="100000003">Badghis, Afghanistan</option>
                            </select>
                        </p>
                        <p>
                            <?php echo esc_html( $stack['location']['full_name'] ) ?>
                        </p>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-12 mb-3">
                       <hr>
                        <div class="container block">
                            <div class="row">
                                <div class="col text-center ">
                                    <p class="mt-3 mb-3 font-weight-bold three-em uc" style="text-transform: uppercase;">Concept List</p>
                                    <?php
                                    foreach ( $lists as $key => $items ) {
                                        ?>
                                        <a href="#<?php echo esc_html( $key ) ?>"><?php echo esc_html( str_replace( '_', ' ', $key ) ) ?></a> (<?php echo esc_html( count( $items ) ) ?> )<br>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="w-100"><hr></div>
                        </div>
                        <?php
                        foreach ( $lists as $key => $items ) {
                            ?>
                            <div class="container block" id="<?php echo esc_html( $key ) ?>">
                                <div class="row" style="background-color:lightgrey;">
                                    <div class="col text-center ">
                                        <p class="mt-3 mb-3 font-weight-bold three-em uc" style="text-transform: uppercase;">Concept:</p>
                                        <p class="mt-3 mb-3 font-weight-bold three-em uc" style="text-transform: uppercase;"><?php echo esc_html( str_replace( '_', ' ', $key ) ) ?></p>
                                        <p class="mt-3 mb-3 font-weight-bold three-em uc" style="text-transform: uppercase;">(<?php echo esc_html( count( $items ) ) ?> prayers)</p>
                                    </div>
                                </div>
                                <div class="w-100"><hr></div>
                            </div>
                            <?php

                            foreach ( $items as $item ) {
                                $hash = hash( 'sha256', serialize( $item ) );
                                $display = empty( $item['reference'] ) ? 'none' :'block';
                                ?>
                                <div class="container block">
                                    <div class="row">
                                        <div class="col text-center ">
                                            <p class="mt-3 mb-3 font-weight-normal one-em uc"><?php echo esc_html( $item['section_label'] ) ?></p>
                                        </div>
                                    </div>
                                    <div class="row text-center justify-content-center">
                                        <div class="col-md-8">
                                            <p class="mt-3 mb-3 font-weight-bold two-em"><?php echo esc_html( $item['prayer'] ) ?></p>
                                        </div>
                                    </div>

                                    <div class="row text-center justify-content-center <?php echo esc_html( $hash ) ?>" style="display:<?php echo esc_html( $display ) ?>;">
                                        <div class="col mt-3 mb-3 font-weight-bold text-center">
                                            <button type="button" class="btn btn-outline-dark btn-sm" onclick="jQuery('#<?php echo esc_html( $hash ) ?>').show();jQuery('.<?php echo esc_html( $hash ) ?>').hide();" ><?php echo esc_html( $item['reference'] ) ?></button>
                                        </div>
                                    </div>
                                    <div class="row text-center justify-content-center" style="display:none;" id="<?php echo esc_html( $hash ) ?>" >
                                        <div class="col-md-8">
                                            <p class="mt-3 mb-0 font-weight-normal font-italic two-em"><?php echo esc_html( $item['verse'] ) ?></p>
                                            <p class="mt-0 mb-3 font-weight-normal"><?php echo esc_html( $item['reference'] ) ?></p>
                                        </div>
                                    </div>
                                    <div class="w-100"><hr></div>
                                </div>
                                <p>

                                </p>
                                <?php
                            }
                        }
                        ?>

                        <div class="container block">
                            <div class="row">
                                <div class="col text-center">
                                    <p class="mt-3 mb-3 font-weight-bold three-em uc" style="text-transform: uppercase;">Variable List</p>
                                </div>
                                <div class="col">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">Variable</th>
                                                <th scope="col">Value</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ( $stack['location'] as $key => $item ) {
                                                ?>
                                                <tr>
                                                    <td><?php echo esc_html( $key ) ?></td>
                                                    <td><?php echo esc_html( $item ) ?></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="w-100"><hr></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script>
            jQuery(document).ready(function(){
                jQuery('#country_change').on('change', function(e){
                    let grid_id = jQuery(this).val()
                    window.location.href = '/show_app/all_content/?grid_id='+grid_id
                })
            })
        </script>
        <!-- END section -->

        <?php require_once( WP_CONTENT_DIR . '/plugins/prayer-global-porch/pages/assets/working-footer.php' ) ?>
        <?php
    }

}
Prayer_Global_Show_All::instance();
