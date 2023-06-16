<?php
$url = dt_get_url_path();

/**
 * Nav for Home Page
 */
$dark_nav_class = '' === $url || str_contains( $url, 'stats' ) || str_contains( $url, 'completed' ) ? 'navbar-dark' : '';
$hide_cta_class = str_contains( $url, 'challenges' ) || str_contains( $url, 'user_app' ) ? 'd-none' : '';

?>
<nav class="pg-navbar navbar <?php echo esc_html( $dark_nav_class ) ?> bg-none p-0 d-block brand" id="pg-navbar">
    <div class="d-flex align-items-center justify-content-between container py-3 mw-100 flex-nowrap">
        <button class="icon-button share-button two-rem d-flex" data-toggle="modal" data-target="#exampleModal">
            <i class="icon pg-share"></i>
        </button>

        <h5 class="border offcanvas-title px-3 rounded"><a href="/" class="brand navbar__title">Prayer.Global</a></h5>

        <div class="d-flex justify-content-end align-items-center">
            <a href="/user_app/profile" class="icon-button mx-2 two-rem d-flex align-items-center" title="Profile" id="user-profile-link">
                <i class="icon pg-profile"></i>
            </a>
            <button class="icon-button navbar-toggler mx-2 two-rem d-flex align-items-center" type="button" data-bs-toggle="offcanvas" data-bs-target="#probootstrap-navbar" aria-controls="probootstrap-navbar" aria-expanded="false" aria-label="Toggle navigation">
                <i class="icon pg-menu"></i>
            </button>
        </div>
    </div>

    <?php pg_menu(); ?>

</nav>
