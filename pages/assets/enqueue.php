<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

add_filter( 'dt_magic_url_base_allowed_js', function ( $allowed_js ){
    $allowed_js = array_merge( $allowed_js, [
        'jquery',
        'share-js',
        'components-js',
        'canvas-confetti',
        'global-functions',
        'main-js',
        'bootstrap',
        'slick',
        'heatmap-js',
        'jquery-easing',
        'jquery-waypoints',
    ] );

    return $allowed_js;
}, 100, 1 );


function pg_enqueue_script( string $handle, string $rel_src, array $deps = array(), bool $in_footer = false ) {
    wp_enqueue_script( $handle, Prayer_Global_Porch::get_url_path() . "$rel_src", $deps, filemtime( Prayer_Global_Porch::get_dir_path() . "$rel_src" ), $in_footer );
}

add_action( 'wp_enqueue_scripts', function (){

    wp_enqueue_script( 'jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js', [], '3.7.1', false );
    wp_enqueue_script( 'canvas-confetti', 'https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js', [], '1.5.1', true );
    pg_enqueue_script( 'global-functions', 'pages/assets/js/global-functions.js', [ 'jquery' ], true );
    pg_enqueue_script( 'components-js', 'pages/assets/js/components.js', [ 'jquery', 'global-functions' ], true );

    pg_enqueue_script( 'main-js', 'pages/assets/js/main.js', [ 'jquery', 'global-functions' ], true );
    pg_enqueue_script( 'share-js', 'pages/assets/js/share.js', [ 'jquery', 'global-functions' ], true );

    wp_enqueue_script( 'bootstrap', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js', [], '5.3.3', true );
    wp_enqueue_script( 'slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js', [], '1.9.0', true );
    //Easily execute a function when you scroll to an element
    wp_enqueue_script( 'jquery-waypoints', 'https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js', [ 'jquery' ], '4.0.1', true );
    wp_enqueue_script( 'jquery-easing', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js', [ 'jquery' ], '1.4.1', true );



    wp_localize_script( 'global-functions', 'pg_global', [
        'map_key' => DT_Mapbox_API::get_key(),
        'mirror_url' => dt_get_location_grid_mirror( true ),
        'root' => esc_url_raw( rest_url() ),
        'nonce' => wp_create_nonce( 'wp_rest' ),
    ]);

    wp_localize_script( 'components-js', 'pg_components', [
        'translations' => [
            'years' => __( 'Years', 'prayer-global-porch' ),
            'days' => __( 'Days', 'prayer-global-porch' ),
            'hours' => __( 'Hours', 'prayer-global-porch' ),
            'minutes' => __( 'Minutes', 'prayer-global-porch' ),
            'seconds' => __( 'Seconds', 'prayer-global-porch' ),
        ],
    ] );

    wp_localize_script( 'share-js', 'pg_share', [
        'translations' => [
            'Join us in covering the world in prayer' => __( 'Join us in covering the world in prayer', 'prayer-global-porch' ),
        ],
    ] );

});


function pg_heatmap_scripts( $glass ){
    DT_Mapbox_API::load_mapbox_header_scripts();
    pg_enqueue_script( 'heatmap-js', 'pages/pray/heatmap.js', [ 'jquery', 'mapbox-gl' ], true );
    wp_localize_script( 'heatmap-js', 'pg_heatmap', [

        'translations' => [
            "Don't Know Jesus" => __( "Don't Know Jesus", 'prayer-global-porch' ),
            'one_believer_for_every' => __( '1 believer for every %d lost neighbors.', 'prayer-global-porch' ),
            'Know about Jesus' => __( 'Know About Jesus', 'prayer-global-porch' ),
            'Know Jesus' => __( 'Know Jesus', 'prayer-global-porch' ),
            'location_description1' => _x( '%1$s of %2$s has a population of %3$s.', 'The state of Colorado has a population of 5,773,714.', 'prayer-global-porch' ),
            'location_description2' => _x( 'We estimate %1$s has %2$s people who might know Jesus, %3$s people who might know about Jesus culturally, and %4$s people who do not know Jesus.', 'We estimate new york has 100 people who might know Jesus, 300 people who might know about Jesus culturally, and 500 people who do not know Jesus.', 'prayer-global-porch' ),
            'location_description3' => _x( '%1$s is 1 of %2$s %3$s.', 'Colorado is 1 of 50 states.', 'prayer-global-porch' ),
            'religion' => __( 'Religion', 'prayer-global-porch' ),
            'official_language' => __( 'Official Language', 'prayer-global-porch' ),
            'Community Stats' => __( 'Community Stats', 'prayer-global-porch' ),
            'Summary' => __( 'Summary', 'prayer-global-porch' ),
            'Activity' => __( 'Activity', 'prayer-global-porch' ),
            'Times prayed for' => __( 'Times prayed for', 'prayer-global-porch' ),
            'Total time prayed' => __( 'Total time prayed', 'prayer-global-porch' ),
            'minute' => __( 'minute', 'prayer-global-porch' ),
            'minutes' => __( 'minutes', 'prayer-global-porch' ),
        ]
    ] );
}

add_action( 'wp_footer', function (){
    ?>
    <script defer src="https://umami.gospelambition.com/script.js" data-website-id="c8b2d630-e64a-4354-b03a-f92ac853153e"></script>
    <?php
} );


/**
 * Enqueue styles
 * https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css
 *
 */