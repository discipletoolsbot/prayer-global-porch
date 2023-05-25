<nav class="navbar-dark bg-none p-0" id="pg-navbar">
    <div class="d-flex align-items-center justify-content-between mx-0 px-0 mw-100 flex-nowrap">
        <a href="/" class="icon-button two-rem d-flex align-items-center mx-2" title="Home">
            <i class="icon pg-home"></i>
        </a>

        <div class="d-flex justify-content-end align-items-center">
            <div><a class="btn btn-cta mx-2" href="/newest/lap/">Start Praying</a></div>
            <a href="/user_app/profile" class="icon-button mx-2 two-rem d-flex align-items-center" title="Profile" id="user-profile-link">
                <i class="icon pg-profile"></i>
            </a>
            <button class="navbar-toggler mx-2 two-rem d-flex align-items-center" type="button" data-bs-toggle="offcanvas" data-bs-target="#probootstrap-navbar" aria-controls="probootstrap-navbar" aria-expanded="false" aria-label="Toggle navigation">
                <i class="icon pg-menu"></i>
            </button>
        </div>
    </div>

    <?php pg_menu(); ?>

</nav>
