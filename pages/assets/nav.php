<?php
$url = dt_get_url_path();

/**
 * Nav for Home Page
 */
$dark_nav_class = '' === $url || str_contains( $url, 'stats' ) || str_contains( $url, 'completed' ) ? 'navbar-dark' : '';
$hide_cta_class = str_contains( $url, 'challenges' ) || str_contains( $url, 'user_app' ) ? 'd-none' : '';

?>
<nav class="pg-navbar navbar bg-none p-0 d-block" id="pg-navbar">
    <div class="d-flex align-items-center justify-content-between container py-3 mw-100 flex-nowrap">
        <button class="share-button two-rem white d-flex" data-toggle="modal" data-target="#exampleModal">
            <i class="icon pg-share"></i>
        </button>

        <h5 class="border border-light border-white white offcanvas-title px-3 rounded">Prayer.Global</h5>

        <div class="d-flex justify-content-end align-items-center">
            <a href="/user_app/profile" class="icon-button mx-2 two-rem d-flex align-items-center white" title="Profile" id="user-profile-link">
                <i class="icon pg-profile"></i>
            </a>
            <button class="navbar-toggler mx-2 two-rem d-flex align-items-center white" type="button" data-bs-toggle="offcanvas" data-bs-target="#probootstrap-navbar" aria-controls="probootstrap-navbar" aria-expanded="false" aria-label="Toggle navigation">
                <i class="icon pg-menu"></i>
            </button>
        </div>
    </div>

    <?php pg_menu(); ?>

</nav>
