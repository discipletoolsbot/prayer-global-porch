<?php
$url = dt_get_url_path( true );

/**
 * Nav for Home Page
 */
$nav_class = 'white-bg brand';
if ( '' === $url ) {
    $nav_class = 'navbar-home navbar-dark';
} else if ( str_contains( $url, 'stats' ) ||
            str_contains( $url, 'completed' ) ||
            str_contains( $url, 'about' ) ||
            str_contains( $url, 'stats' ) ||
            str_contains( $url, 'login' ) ||
            str_contains( $url, 'profile' )
) {
    $nav_class = 'navbar-dark';
}
$hide_cta_class = str_contains( $url, 'challenges' ) || str_contains( $url, 'user_app' ) ? 'd-none' : '';

?>
<nav class="pg-navbar navbar p-0 d-block <?php echo esc_html( $nav_class ) ?>" id="pg-navbar">

    <?php if ( ( new PG_Feature_Flag( 'icom_banner' ) )->is_on() ) : ?>

        <script>
            jQuery(document).ready(() => {
                const animateElements = document.querySelectorAll('.relay-banner .animate')
                if (animateElements.length) {
                    animateElements.forEach((element) => {
                        element.style.transform = 'translateX(0)'
                    })
                }
            })
        </script>

        <div class="relay-banner">
            <div class="container">
                <h2 class="heading animate">Entrusted to Pray ICOM 2024</h2>
                <a href="<?php echo esc_url( Prayer_Global_Porth_ICOM_Lap::link() ) ?>">
                    <div class="btn btn-primary-light btn-small animate">
                        <?php echo esc_html__( 'Start Praying', 'prayer-global-porch' ) ?>
                    </div>
                </a>
            </div>
        </div>

    <?php endif; ?>

    <div class="container d-flex align-items-center justify-content-between container py-3 flex-nowrap">
        <button class="p-0 icon-button share-button two-rem d-flex" data-toggle="modal" data-target="#exampleModal">
            <i class="icon pg-share"></i>
        </button>

        <h5 class="border border-brand-light offcanvas-title px-3 rounded navbar__title"><a href="/" class="brand-light navbar__title-link">Prayer.Global</a></h5>

        <div class="d-flex justify-content-end align-items-center">
            <div class="d-flex justify-content-end align-items-center mx-2">

                <?php require( __DIR__ . '/language-menu.php' ) ?>

            </div>
            <a href="/user_app/profile" class="icon-button mx-2 two-rem d-flex align-items-center" title="Profile" id="user-profile-link">
                <i class="icon pg-profile"></i>
            </a>
            <button class="icon-button navbar-toggler mx-2 two-rem d-flex align-items-center" type="button" data-bs-toggle="offcanvas" data-bs-target="#probootstrap-navbar" aria-controls="probootstrap-navbar" aria-expanded="false" aria-label="Toggle navigation">
                <i class="icon pg-menu"></i>
            </button>
        </div>
    </div>

    <?php pg_menu(); ?>

</nav>
