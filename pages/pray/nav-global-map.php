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
            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                <li class="nav-item"><a class="btn btn-outline-dark py-2 me-3 w-100 mb-4" href="/newest/lap/">Start Praying</a></li>
                <li class="nav-item"><a class="nav-link" href="#section-challenge">Challenge</a></li>
                <li class="nav-item"><a class="nav-link" href="#section-lap">Status</a></li>
                <li class="nav-item"><a class="nav-link" href="/challenges/active/">Groups</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- 

<nav class="navbar navbar-expand-lg navbar-light pb_navbar pb_navbar_light pg-navbar p-0">
    <div class="container align-items-center mx-0 px-0" style="max-width: 100%;">
        <div class="col col-md-2 col-lg-5 d-none d-lg-block"><a href="/" class="navbar-brand">Prayer.Global</a></div>
        <div class="center col col-md-2 col-lg-2 d-none d-lg-block">
            <span class="two-em">Lap <?php echo esc_html( $lap_stats['lap_number'] ) ?></span>
        </div>
        <div class="col col-6 d-lg-none">
            <span><a href="/" class="brand-color two-em">Lap <?php echo esc_html( $lap_stats['lap_number'] ) ?></a></span>
        </div>
        <div class="col col-5 d-lg-none nav-list-link" style="text-align:right; whitespace:nowrap;">
                <a class="nav-link btn smoothscroll pb_outline-dark highlight" style="border:1px black solid;" href="/newest/lap/">Start Praying</a>
        </div>
        <button class="navbar-toggler col-1" type="button" data-bs-toggle="collapse" data-bs-target="#probootstrap-navbar" aria-controls="probootstrap-navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span><i class="ion-navicon"></i></span>
        </button>
        <div class="collapse navbar-collapse col col-md-8 col-lg-5" id="nav-list">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link btn smoothscroll pb_outline-dark highlight" style="border:1px black solid;" href="/newest/lap/">Start Praying</a></li>
                <li class="nav-item"><a class="nav-link" href="/#section-challenge">Challenge</a></li>
                <li class="nav-item"><a class="nav-link" href="/#section-lap">Status</a></li>
                <li class="nav-item"><a class="nav-link" href="/challenges/active/">Groups</a></li>
            </ul>
        </div>
    </div>
</nav>

 -->