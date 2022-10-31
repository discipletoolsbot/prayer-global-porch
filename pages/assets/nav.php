<?php
$url = dt_get_url_path();

/**
 * Nav for Home Page
 */
if ( '' === $url ) { ?>
<nav class="navbar navbar-expand-lg navbar-dark pb_navbar pb_navbar_nav pb_scrolled-light" id="pb-navbar">
    <div class="container">
        <a class="navbar-brand" href="/">Prayer.Global</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#probootstrap-navbar" aria-controls="probootstrap-navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span><i class="ion-navicon"></i></span>
        </button>
        <div class="collapse navbar-collapse" id="probootstrap-navbar">
            <ul class="navbar-nav ml-auto pb-3">
                <li class="nav-item"><a class="nav-link btn smoothscroll pb_outline-dark highlight" href="/newest/lap/">Start Praying</a></li>
                <li class="nav-item"><a class="nav-link" href="#section-challenge">Challenge</a></li>
                <li class="nav-item"><a class="nav-link" href="#section-lap">Status</a></li>
                <li class="nav-item"><a class="nav-link" href="/newest/map/">Map</a></li>
                <li class="nav-item"><a class="nav-link" href="/challenges/active/">Groups</a></li>
                <li class="nav-item d-lg-none"><a class="nav-link" href="/race_app/big_map/">Big Map</a></li>
                <li class="nav-item d-lg-none"></li>
                <li class="nav-item icon-button d-flex align-items-center"><img class="nav-link share-button" data-toggle="modal" data-target="#exampleModal" data-white src="<?php echo esc_html( plugin_dir_url( __FILE__ ) ) ?>/images/share.svg" alt="Share"></li>
            </ul>
        </div>
    </div>
</nav>

<?php } else if ( str_contains( $url, 'stats' ) || str_contains( $url, 'completed' ) ) { ?>
<nav class="navbar navbar-expand-lg navbar-dark pb_navbar pb_navbar_nav pb_scrolled-light" id="pb-navbar">
    <div class="container">
        <a class="navbar-brand" href="/">Prayer.Global</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#probootstrap-navbar" aria-controls="probootstrap-navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span><i class="ion-navicon"></i></span>
        </button>
        <div class="collapse navbar-collapse" id="probootstrap-navbar">
            <ul class="navbar-nav ml-auto pb-3">
                <li class="nav-item"><a class="nav-link btn smoothscroll pb_outline-dark highlight" href="/newest/lap/">Start Praying</a></li>
                <li class="nav-item"><a class="nav-link" href="/#section-challenge">Challenge</a></li>
                <li class="nav-item"><a class="nav-link" href="/#section-lap">Status</a></li>
                <li class="nav-item"><a class="nav-link" href="/newest/map/">Map</a></li>
                <li class="nav-item"><a class="nav-link" href="/challenges/active/">Groups</a></li>
                <li class="nav-item d-lg-none"><a class="nav-link" href="/race_app/big_map/">Big Map</a></li>
                <li class="nav-item d-lg-none"></li>
                <li class="nav-item icon-button d-flex align-items-center"><img class="nav-link share-button" src="<?php echo esc_html( plugin_dir_url( __FILE__ ) ) ?>/images/share.svg" alt="Share"></li>
            </ul>
        </div>
    </div>
</nav>

<?php } else {
    /**
     * Nav for Inner Pages
     */
    ?>
    <nav class="navbar navbar-expand-lg navbar-light pb_navbar_light pb_navbar_nav pb_scrolled-light" id="pb-navbar">
        <div class="container">
            <a class="navbar-brand" href="/">Prayer.Global</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#probootstrap-navbar" aria-controls="probootstrap-navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span><i class="ion-navicon"></i></span>
            </button>
            <div class="collapse navbar-collapse" id="probootstrap-navbar">
                <ul class="navbar-nav ml-auto pb-3">
                    <li class="nav-item"><a class="nav-link btn smoothscroll pb_outline-dark highlight" style="border:1px black solid;" href="/newest/lap/">Start Praying</a></li>
                    <li class="nav-item"><a class="nav-link" href="#section-challenge">Challenge</a></li>
                    <li class="nav-item"><a class="nav-link" href="#section-lap">Status</a></li>
                    <li class="nav-item"><a class="nav-link" href="/newest/map/">Map</a></li>
                    <li class="nav-item"><a class="nav-link" href="/challenges/active/">Groups</a></li>
                    <li class="nav-item d-lg-none"><a class="nav-link" href="/race_app/big_map/">Big Map</a></li>
                    <li class="nav-item d-lg-none"></li>
                    <li class="nav-item icon-button d-flex align-items-center"><img class="nav-link share-button" src="<?php echo esc_html( plugin_dir_url( __FILE__ ) ) ?>/images/share.svg" alt="Share"></li>
                </ul>
            </div>
        </div>
    </nav>

<?php } ?>

<!-- Modal -->
<div class="modal fade" id="share-modal" tabindex="-1" role="dialog" aria-labelledby="share-modal-label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="share-modal-label">Share Prayer.Global</h5>
      </div>
      <div class="modal-body ">
        <ul class="list-group list-group-flush share-modal__items">
            <li class="list-group-item list-group-item-action list-group-item-secondary"><img class="share__icon" src="<?php echo esc_html( plugin_dir_url( __FILE__ ) ) ?>/images/facebook.svg" alt="Share">Facebook</li>
            <li class="list-group-item list-group-item-action list-group-item-secondary"><img class="share__icon" src="<?php echo esc_html( plugin_dir_url( __FILE__ ) ) ?>/images/twitter.svg" alt="Share">Twitter</li>
            <li class="list-group-item list-group-item-action list-group-item-secondary"><img class="share__icon" src="<?php echo esc_html( plugin_dir_url( __FILE__ ) ) ?>/images/email.svg" alt="Share">Email</li>
            <li class="list-group-item list-group-item-action list-group-item-secondary"><img class="share__icon" src="<?php echo esc_html( plugin_dir_url( __FILE__ ) ) ?>/images/link.svg" alt="Share">Link</li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn pb_outline-dark highlight" data-dismiss="modal">Done</button>
      </div>
    </div>
  </div>
</div>