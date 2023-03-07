<?php
$url = dt_get_url_path();

/**
 * Nav for Home Page
 */
$dark_nav_class = '' === $url || str_contains( $url, 'stats' ) || str_contains( $url, 'completed' ) ? 'navbar-dark' : '';
$hide_cta_class = str_contains( $url, 'challenges' ) || str_contains( $url, 'user_app' ) ? 'd-none' : '';

?>
<nav class="navbar <?php echo esc_attr( $dark_nav_class ) ?> pg-navbar bg-none scrolled-light" id="pg-navbar">
    <div class="container align-items-center">
        <a class="navbar-brand me-auto" href="/">Prayer.Global</a>
        <a class="navbar__cta btn btn-outline-dark py-2 py-lg-4 me-3 <?php echo esc_attr( $hide_cta_class ) ?>" href="/newest/lap/">Start Praying</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#probootstrap-navbar" aria-controls="probootstrap-navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span><i class="ion-navicon"></i></span>
        </button>
    </div>
    <div class="offcanvas offcanvas-end pg-navmenu" data-bs-backdrop="true" data-bs-scroll="true" id="probootstrap-navbar">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasNavbarDarkLabel">Prayer.Global</h5>
          <button type="button" class="btn-close pe-4" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="navbar-nav justify-content-end me-3" id="nav-links">
                <a class="btn btn-outline-dark py-2 me-3 w-100 mb-4" href="/newest/lap/">Start Praying</a>
                <a class="nav-link" href="/">Home</a>
                <a class="nav-link" href="<?php echo ( $url !== '' ) ? esc_url( trailingslashit( site_url() ) ) : '' ?>#section-lap">Status</a>
                <a class="nav-link" href="/newest/map/">Map</a>
                <a class="nav-link" href="/challenges/active/">Groups</a>
                <a class="nav-link" href="/content_app/give_page">Give</a>
                <!-- <a href="/user_app/login" class="nav-link" id="login-register-link" data-pg-is-logged-out>Login</a> -->
                <a href="/user_app/profile" class="nav-link" id="user-profile-link" style="display: none" data-pg-is-logged-in>User Profile</a>
                <a href="<?php echo esc_url( '/user_app/logout' )?>" class="nav-link" id="logout-link" style="display: none" data-pg-is-logged-in>Logout</a>
            </div>
            <div class="nav-buttons">
                <button class="icon-button share-button" data-toggle="modal" data-target="#exampleModal">
                    <img src="<?php echo esc_html( plugin_dir_url( __FILE__ ) ) ?>images/share.svg" alt="Share">
                </button>
            </div>
        </div>
    </div>
</nav>
