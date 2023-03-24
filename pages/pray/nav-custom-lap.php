<?php

function pg_custom_lap_nav( $key ) {

    $url = dt_get_url_path();
    $dark_nav_class = str_contains( $url, 'stats' ) || str_contains( $url, 'completed' ) ? 'navbar-dark' : '';

    ?>

    <nav class="navbar <?php echo esc_attr( $dark_nav_class ) ?> pg-navbar bg-none scrolled-light" id="pg-navbar">
        <div class="container align-items-center">
            <a class="navbar-brand me-auto" href="/">Prayer.Global</a>
            <a class="navbar__cta btn btn-outline-dark py-2 py-lg-4 me-3" href="/prayer_app/custom/<?php echo esc_attr( $key ) ?>">Start Praying</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#probootstrap-navbar" aria-controls="probootstrap-navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span><i class="ion-navicon"></i></span>
            </button>
        </div>

        <?php pg_menu( 'custom', $key ) ?>

    </nav>

    <?php
}
