<?php
global $wp;
$current_url = add_query_arg( $wp->query_vars, home_url( $wp->request ) );
pg_google_analytics();
?>
<meta name="apple-mobile-web-app-title" content="Prayer.Global">

<link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ); ?>assets/images/favicons/apple-touch-icon.png">

<link rel="icon" type="image/png" sizes="512x512" href="<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ); ?>assets/images/favicons/android-chrome-512x512.png">
<link rel="icon" type="image/png" sizes="192x192" href="<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ); ?>assets/images/favicons/android-chrome-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ); ?>assets/images/favicons/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ); ?>assets/images/favicons/favicon-16x16.png">

<link rel="mask-icon" href="<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ); ?>assets/images/favicons/safari-pinned-tab.svg" color="#fff">
<link rel="shortcut icon" href="<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ); ?>assets/images/favicons/favicon.ico">

<meta name="msapplication-square512x512logo" content="<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ); ?>assets/images/favicons/android-chrome-512x512.png">
<meta name="msapplication-square192x192logo" content="<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ); ?>assets/images/favicons/android-chrome-192x192.png">

<meta name="theme-color" content="#fff">

<link rel="manifest" href="<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ); ?>assets/images/favicons/site.webmanifest">

<?php pg_og_tags( [ "url" => $current_url ] ) ?>

<link href="https://fonts.googleapis.com/css?family=Crimson+Text:400,400i,600|Montserrat:200,300,400" rel="stylesheet">

<link rel="stylesheet" href="<?php echo esc_url( trailingslashit( plugin_dir_url( __FILE__ ) ) ) ?>css/bootstrap/bootstrap5.2.2.css">
<link rel="stylesheet" href="<?php echo esc_url( trailingslashit( plugin_dir_url( __FILE__ ) ) ) ?>fonts/ionicons/css/ionicons.min.css">

<link rel="stylesheet" href="<?php echo esc_url( trailingslashit( plugin_dir_url( __FILE__ ) ) ) ?>fonts/fontawesome/css/font-awesome.min.css">

<script src="<?php echo esc_url( trailingslashit( plugin_dir_url( __FILE__ ) ) ) ?>js/jquery.min.js"></script>

<link rel="stylesheet" href="<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ) ?>assets/css/basic.css?ver=<?php echo esc_attr( fileatime( trailingslashit( plugin_dir_path( __DIR__ ) ) . 'assets/css/basic.css' ) ) ?>" type="text/css" media="all">
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>

<script src="<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ) ?>assets/js/global-functions.js?ver=<?php echo esc_attr( fileatime( trailingslashit( plugin_dir_path( __DIR__ ) ) . 'assets/js/global-functions.js' ) ) ?>"></script>

<script>
$(document).ready(function($) {
    window.onGetAuthUser(
        () => {
            showElements('[data-pg-is-logged-in]', true)
            showElements('[data-pg-is-logged-out]', false)
        },
        () => {
            showElements('[data-pg-is-logged-in]', false)
            showElements('[data-pg-is-logged-out]', true)
        }
    )

    function showElements(selector, show) {
        document
            .querySelectorAll(selector)
            .forEach((element) => element.style.display = show ? 'block' : 'none')
    }
})
</script>
