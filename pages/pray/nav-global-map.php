<?php
$url = dt_get_url_path();
?>
<nav class="navbar bg-none scrolled-light p-0" id="pg-navbar">
    <div class="container align-items-center mx-0 px-0 mw-100 flex-nowrap">
        <a class="navbar-brand col col-md-4 d-none d-lg-block" href="/">Prayer.Global</a>
        <span class="two-em center col col-md-4 d-none d-lg-block">Lap <?php echo esc_html( $lap_stats['lap_number'] ) ?></span>

        <a href="/" class="brand-color two-em col col-4 d-lg-none">Lap <?php echo esc_html( $lap_stats['lap_number'] ) ?></a>

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
            <div class="navbar-nav justify-content-end pe-3">
                <a class="btn btn-outline-dark py-2 me-3 w-100 mb-4" href="/newest/lap/">Start Praying</a>
                <a class="nav-link" href="/">Home</a>
                <a class="nav-link" href="<?php echo ( $url !== '') ? trailingslashit( site_url() ) : '' ?>#section-challenge">Challenge</a>
                <a class="nav-link" href="<?php echo ( $url !== '') ? trailingslashit( site_url() ) : '' ?>#section-lap">Status</a>
                <a class="nav-link" href="/newest/map/">Map</a>
                <a class="nav-link" href="/challenges/active/">Groups</a>
                <div class="nav-buttons">
                    <img class="icon-button share-button" data-toggle="modal" data-target="#exampleModal" src="<?php echo esc_html( plugin_dir_url( __DIR__ ) ) ?>assets/images/share.svg" alt="Share">
                </div>
            </div>
        </div>
    </div>
</nav>
