<?php
$url = dt_get_url_path();
$is_logged_in = is_user_logged_in();

$hide_if_logged_in = $is_logged_in ? 'display: none' : '';
$hide_if_logged_out = $is_logged_in ? '' : 'display: none';

?>
<nav class="navbar bg-none scrolled-light p-0" id="pg-navbar">
    <div class="container align-items-center mx-0 px-0 mw-100 flex-nowrap">
        <a class="navbar-brand col col-md-4 d-none d-lg-block" href="/">Prayer.Global</a>
        <span class="two-em center col col-md-4 d-none d-lg-block">Race Map</span>
        <a href="/" class="brand-color two-em col col-4 d-lg-none">Race Map</a>
        <div class="col-8 col-md-4 d-flex justify-content-end">
            <a class="btn btn-outline-dark py-2 me-3" href="/newest/lap/">Start Praying</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#probootstrap-navbar" aria-controls="probootstrap-navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span><i class="ion-navicon"></i></span>
            </button>
        </div>
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
                <a class="nav-link" href="<?php echo ( $url !== '') ? trailingslashit( site_url() ) : '' ?>#section-challenge">Challenge</a>
                <a class="nav-link" href="<?php echo ( $url !== '') ? trailingslashit( site_url() ) : '' ?>#section-lap">Status</a>
                <a class="nav-link" href="/newest/map/">Map</a>
                <a class="nav-link" href="/challenges/active/">Groups</a>
                <a href="/user_app/profile" class="nav-link" id="login-register-link" style="<?php echo esc_attr( $hide_if_logged_in ) ?>">Login / Register</a>
                <a href="/user_app/profile" class="nav-link" id="user-profile-link" style="<?php echo esc_attr( $hide_if_logged_out ) ?>">User Profile</a>
                <a href="<?php echo esc_url( wp_logout_url( '/' ) )?>" class="nav-link" id="logout-link" style="<?php echo esc_attr( $hide_if_logged_out ) ?>">Logout</a>
            </div>
            <div class="nav-buttons">
                <button class="icon-button share-button" data-toggle="modal" data-target="#exampleModal">
                    <img src="<?php echo esc_html( plugin_dir_url( __DIR__ ) ) ?>assets/images/share.svg" alt="Share">
                </button>
            </div>
        </div>
    </div>
</nav>
