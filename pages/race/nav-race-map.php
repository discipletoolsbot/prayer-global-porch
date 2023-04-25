<?php
$url = dt_get_url_path();
$is_logged_in = is_user_logged_in();

$hide_if_logged_in = $is_logged_in ? 'display: none' : '';
$hide_if_logged_out = $is_logged_in ? '' : 'display: none';

?>
<nav class="navbar bg-none scrolled-light p-0" id="pg-navbar">
    <div class="container align-items-center mx-0 px-0 mw-100 flex-nowrap">
        <a class="navbar-brand col col-md-4 d-none d-lg-block" href="/">Prayer.Global</a>
        <span class="two-em center col col-md-4 d-none d-lg-block"><?php echo esc_html__( 'Race Map', 'prayer-global-porch' ) ?></span>
        <a href="/" class="brand-color two-em col col-4 d-lg-none"><?php echo esc_html__( 'Race Map', 'prayer-global-porch' ) ?></a>
        <div class="col-8 col-md-4 d-flex justify-content-end">
        <a class="btn btn-outline-dark py-2 me-3" href="/newest/lap/"><?php echo esc_html__( 'Start Praying', 'prayer-global-porch' ) ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#probootstrap-navbar" aria-controls="probootstrap-navbar" aria-expanded="false" aria-label="<?php esc_attr( __( 'Toggle navigation', 'prayer-global' ) ) ?>">
                <span><i class="ion-navicon"></i></span>
            </button>
        </div>
    </div>

    <?php pg_menu() ?>

</nav>
