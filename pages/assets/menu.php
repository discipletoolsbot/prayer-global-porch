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
        <div class="offcanvas-header blue-bg p-3">
            <a href="/" class="icon-button two-rem d-flex align-items-center mx-2 white" title="Home">
                <i class="icon pg-home"></i>
            </a>
            <h5 class="border border-light border-white offcanvas-title px-3 rounded" id="offcanvasNavbarDarkLabel">Prayer.Global</h5>
            <div class="d-flex">

                <?php if ( $login_module_feature->is_on() ) : ?>

                    <a href="/user_app/profile" class="icon-button mx-2 two-rem d-flex align-items-center white" title="Profile" id="user-profile-link">
                        <i class="icon pg-profile"></i>
                    </a>

                <?php endif; ?>

                <button type="button" class="white two-rem d-flex ms-1" data-bs-dismiss="offcanvas" aria-label="Close">
                    <i class="icon pg-close"></i>
                </button>
            </div>
        </div>
        <div class="offcanvas-body">
            <div class="navbar-nav justify-content-end center uppercase blue" id="nav-links">

                <a class="nav-link" href="<?php echo ( $url !== '' ) ? esc_url( trailingslashit( site_url() ) ) : '' ?>#section-lap">
                    <div class="nav-link__inner">
                        <i class="icon pg-status"></i>
                        <span>Status</span>
                    </div>
                </a>
                <a class="nav-link" href="<?php echo esc_url( $map_href ) ?>">
                    <div class="nav-link__inner">
                        <i class="icon pg-world-light"></i>
                        <span>Map</span>
                    </div>
                </a>

                <?php if ( ! $is_custom_lap ) : ?>

                    <a class="nav-link" href="/challenges/active/">
                        <div class="nav-link__inner">
                            <i class="icon pg-relay"></i>
                            <span>Prayer Relays</span>
                        </div>
                    </a>

                <?php endif; ?>

                <a class="nav-link" href="/content_app/give_page">
                    <div class="nav-link__inner">
                        <i class="icon pg-give"></i>
                        <span>Give</span>
                    </div>
                </a>

                <a class="nav-link" href="/content_app/about_page">
                    <div class="nav-link__inner">
                        <i class="icon pg-question-dark"></i>
                        <span>About</span>
                    </div>
                </a>

                <div class="mt-2"><a class="btn btn-cta mx-2 two-em" href="/newest/lap/">Start Praying</a></div>

            </div>
            <div class="nav-buttons" style="display: none">
                <div class="row" style="--bs-gutter-x: 1.5rem">

                    <?php if ( ! $is_custom_lap ) : ?>

                        <a href="/" class="col icon-button two-rem" title="Home"><i class="ion-home"></i></a>

                    <?php endif; ?>

                    <a href="/user_app/profile" class="col icon-button two-rem" title="Profile" id="user-profile-link" style="display: none" data-pg-is-logged-in>
                        <i class="ion-person"></i>
                    </a>

                    <button class="col icon-button share-button two-rem" title="Share" data-toggle="modal" data-target="#exampleModal">
                        <i class="ion-android-share-alt"></i>
                    </button>

                </div>

                <?php if ( $login_module_feature->is_on() ) : ?>

                    <a href="/user_app/login" class="icon-button two-rem" title="Login" id="login-register-link" style="display: none" data-pg-is-logged-out>
                        <i class="ion-log-in"></i>
                    </a>

                <?php endif; ?>

                <a href="<?php echo esc_url( '/user_app/logout' )?>" class="icon-button two-rem" title="Logout" id="logout-link" style="display: none" data-pg-is-logged-in>
                    <i class="ion-log-out"></i>
                </a>
            </div>
        </div>
    </div>

    <?php

}

?>