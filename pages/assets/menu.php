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
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasNavbarDarkLabel">Prayer.Global</h5>
            <button type="button" class="btn-close pe-4" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="navbar-nav justify-content-end" id="nav-links">
            <a class="btn btn-outline-dark py-2 me-3 w-100 mb-4" href="<?php echo esc_url( $start_praying_href ) ?>"><?php echo esc_html( __( 'Start Praying', 'prayer-global-porch' ) ) ?></a>

            <a class="nav-link" href="<?php echo ( $url !== '' ) ? esc_url( trailingslashit( site_url() ) ) : '' ?>#section-lap"><?php echo esc_html( __( 'Status', 'prayer-global-porch' ) ) ?></a>
            <a class="nav-link" href="<?php echo esc_url( $map_href ) ?>"><?php echo esc_html( __( 'Map', 'prayer-global-porch' ) ) ?></a>

                <?php if ( ! $is_custom_lap ) : ?>

                <a class="nav-link" href="/challenges/active/"><?php echo esc_html( __( 'Relay Teams', 'prayer-global-porch' ) ) ?></a>

                <?php endif; ?>

                <a class="nav-link" href="/content_app/give_page"><?php echo esc_html( __( 'Give', 'prayer-global-porch' ) ) ?></a>

                <a class="nav-link" href="/content_app/about_page"><?php echo esc_html( __( 'About', 'prayer-global-porch' ) ) ?></a>

            </div>
            <div class="nav-buttons">
                <div class="row" style="--bs-gutter-x: 1.5rem">

                    <?php if ( ! $is_custom_lap ) : ?>

                        <a href="/" class="col icon-button two-rem" title="<?php echo esc_attr( __( 'Home', 'prayer-global-porch' ) ) ?>"><i class="ion-home"></i></a>

                    <?php endif; ?>

                    <a href="/user_app/profile" class="col icon-button two-rem" title="<?php echo esc_attr( __( 'Profile', 'prayer-global-porch' ) ) ?>" id="user-profile-link" style="display: none" data-pg-is-logged-in>
                        <i class="ion-person"></i>
                    </a>

                    <button class="col icon-button share-button two-rem" title="<?php echo esc_attr( __( 'Share', 'prayer-global-porch' ) ) ?>" data-toggle="modal" data-target="#exampleModal">
                        <i class="ion-android-share-alt"></i>
                    </button>

                </div>

                <?php if ( $login_module_feature->is_on() ) : ?>

                    <a href="/user_app/login" class="icon-button two-rem" title="<?php echo esc_attr( __( 'Login', 'prayer-global-porch' ) ) ?>" id="login-register-link" style="display: none" data-pg-is-logged-out>
                        <i class="ion-log-in"></i>
                    </a>

                <?php endif; ?>

                <a href="<?php echo esc_url( '/user_app/logout' )?>" class="icon-button two-rem" title="<?php echo esc_attr( __( 'Logout', 'prayer-global-porch' ) ) ?>" id="logout-link" style="display: none" data-pg-is-logged-in>
                    <i class="ion-log-out"></i>
                </a>
            </div>
        </div>
    </div>

    <?php

}

?>