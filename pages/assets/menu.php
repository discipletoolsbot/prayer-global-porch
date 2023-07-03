<?php

function pg_menu( bool $is_custom_lap = false, string $key = '' ) {

    $url = dt_get_url_path();

    if ( $is_custom_lap ) {
        $start_praying_href = "/prayer_app/custom/$key";
        $map_href = "/prayer_app/custom/$key/map";
    } else {
        $start_praying_href = '/newest/lap';
        $map_href = '/newest/map';
    }

    $login_module_feature = new PG_Feature_Flag( PG_Flags::LOGIN_FEATURE );

    ?>

    <div class="offcanvas offcanvas-end pg-navmenu" data-bs-backdrop="true" data-bs-scroll="true" id="probootstrap-navbar">
        <div class="offcanvas-header blue-bg white p-3">
            <a href="/" class="icon-button two-rem d-flex align-items-center mx-2" title="Home">
                <i class="icon pg-home"></i>
            </a>
            <h5 class="border border-light border-white offcanvas-title px-3 rounded" id="offcanvasNavbarDarkLabel">Prayer.Global</h5>
            <div class="d-flex">

                <?php if ( $login_module_feature->is_on() ) : ?>

                    <a href="/user_app/profile" class="icon-button mx-2 two-rem d-flex align-items-center" title="Profile" id="user-profile-link">
                        <i class="icon pg-profile"></i>
                    </a>

                <?php endif; ?>

                <button type="button" class="icon-button two-rem d-flex ms-1" data-bs-dismiss="offcanvas" aria-label="Close">
                    <i class="icon pg-close"></i>
                </button>
            </div>
        </div>
        <div class="offcanvas-body">
            <div class="navbar-nav justify-content-end center uppercase brand-light" id="nav-links">

                <a class="nav-link" href="<?php echo ( $url !== '' ) ? esc_url( trailingslashit( site_url() ) ) : '' ?>#section-lap">
                    <div class="nav-link__inner">
                        <i class="icon pg-status"></i>
                        <span><?php echo esc_html( __( 'Status', 'prayer-global-porch' ) ) ?></span>
                    </div>
                </a>
                <a class="nav-link" href="<?php echo esc_url( $map_href ) ?>">
                    <div class="nav-link__inner">
                        <i class="icon pg-world-light"></i>
                        <span><?php echo esc_html( __( 'Map', 'prayer-global-porch' ) ) ?></span>
                    </div>
                </a>

                <?php if ( ! $is_custom_lap ) : ?>

                    <a class="nav-link" href="/challenges/active/">
                        <div class="nav-link__inner">
                            <i class="icon pg-relay"></i>
                            <span><?php echo esc_html( __( 'Prayer Relays', 'prayer-global-porch' ) ) ?></span>
                        </div>
                    </a>

                <?php endif; ?>

                <a class="nav-link" href="/content_app/give_page">
                    <div class="nav-link__inner">
                        <i class="icon pg-give"></i>
                        <span><?php echo esc_html( __( 'Give', 'prayer-global-porch' ) ) ?></span>
                    </div>
                </a>

                <a class="nav-link" href="/content_app/about_page">
                    <div class="nav-link__inner">
                        <i class="icon pg-question-dark"></i>
                        <span><?php echo esc_html( __( 'About', 'prayer-global-porch' ) ) ?></span>
                    </div>
                </a>

                <div class="mt-2"><a class="btn btn-cta mx-2 two-rem" href="/newest/lap/"><?php echo esc_html( __( 'Start Praying', 'prayer-global-porch' ) ) ?></a></div>

            </div>
        </div>
    </div>

    <?php

}

?>