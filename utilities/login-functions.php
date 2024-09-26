<?php
add_action( 'init', 'pg_login_redirect_login_page' );
function pg_login_redirect_login_page() {
    if ( isset( $_SERVER['REQUEST_URI'] ) && !empty( $_SERVER['REQUEST_URI'] ) ) {
        $parsed_request_uri = ( new DT_URL( sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) ) ) )->parsed_url;
        $page_viewed = ltrim( $parsed_request_uri['path'], '/' );

        if ( $page_viewed == 'wp-login.php' && isset( $_GET['action'] ) && $_GET['action'] === 'register' ) {
            wp_redirect( site_url( 'user_app/login' ) );
            exit;
        }
    }
}
/* add_filter( 'login_url', function ( $url ) {
    if ( str_contains( $url, 'wp-login.php' ) ) {
        $url = str_replace( 'wp-login.php', 'user_app/login', $url );
    }
    return $url;
}, 100, 1 ); */
