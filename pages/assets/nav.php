<?php
$url = dt_get_url_path();

/**
 * Nav for Home Page
 */
$dark_nav_class = '' === $url ||  str_contains( $url, 'stats' ) || str_contains( $url, 'completed' ) ? 'navbar-dark' : '';
?>
<nav class="navbar <?php echo $dark_nav_class ?> pg-navbar bg-none scrolled-light" id="pg-navbar">
    <div class="container align-items-center">
        <a class="navbar-brand me-auto" href="/">Prayer.Global</a>
        <a class="navbar__cta btn btn-outline-dark py-2 py-lg-4 me-3" href="/newest/lap/">Start Praying</a>
        <img class="icon-button share-button" data-toggle="modal" data-target="#exampleModal" data-white src="<?php echo esc_html( plugin_dir_url( __FILE__ ) ) ?>/images/share.svg" alt="Share">
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
            <div class="navbar-nav justify-content-end pe-3">
                <a class="btn btn-outline-dark py-2 me-3 w-100 mb-4" href="/newest/lap/">Start Praying</a>
                <a class="nav-link" href="/">Home</a>
                <a class="nav-link" href="<?php echo ( $url !== '') ? trailingslashit( site_url() ) : '' ?>#section-challenge">Challenge</a>
                <a class="nav-link" href="<?php echo ( $url !== '') ? trailingslashit( site_url() ) : '' ?>#section-lap">Status</a>
                <a class="nav-link" href="/newest/map/">Map</a>
                <a class="nav-link" href="/challenges/active/">Groups</a>
            </div>
        </div>
    </div>
</nav>

<!-- Modal -->
<div class="modal fade" id="share-modal" tabindex="-1" role="dialog" aria-labelledby="share-modal-label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="share-modal-label">Share Prayer.Global</h5>
      </div>
      <div class="modal-body ">
        <ul class="list-group list-group-flush share-modal__items">
            <li class="list-group-item list-group-item-action list-group-item-secondary facebook-action">
                <img class="share__icon" src="<?php echo esc_html( plugin_dir_url( __FILE__ ) ) ?>/images/facebook.svg" alt="Share">Facebook
            </li>
            <li class="list-group-item list-group-item-action list-group-item-secondary twitter-action">
                <img class="share__icon" src="<?php echo esc_html( plugin_dir_url( __FILE__ ) ) ?>/images/twitter.svg" alt="Share">Twitter
            </li>
            <li class="list-group-item list-group-item-action list-group-item-secondary email-action">
                <img class="share__icon" src="<?php echo esc_html( plugin_dir_url( __FILE__ ) ) ?>/images/email.svg" alt="Share">Email
            </li>
            <li class="list-group-item list-group-item-action list-group-item-secondary link-action">
                <img class="share__icon" src="<?php echo esc_html( plugin_dir_url( __FILE__ ) ) ?>/images/link.svg" alt="Share">Link <span class="copy-notice">Copied</span>
            </li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn pb_outline-dark highlight" data-bs-dismiss="modal">Done</button>
      </div>
    </div>
  </div>
</div>
