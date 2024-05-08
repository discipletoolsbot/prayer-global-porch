<?php

require_once( trailingslashit( plugin_dir_path( __DIR__ ) ) . '/assets/nav.php' ) ?>

<section class="hero full-height contain bg-top dark-bg" style="background-image: url(<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ) ?>assets/images/world-map-dark-background-new.png); min-height: 100vh;" id="section-home">
    <div class="container">
        <div class="row flex-column justify-content-between flex-nowrap">
            <div>
                <h1 class="heading">Prayer.Global</h1>
                <h2 class="sub-heading brand-highlight"><?php echo esc_html( __( 'Cover the World in Prayer', 'prayer-global-porch' ) ) ?></h2>
                <i class="icon pg-logo-prayer white heading__logo"></i>
            </div>
            <div class="my-4 d-flex flex-column align-items-center">
                <a class="btn btn-cta mx-2 d-inline-block" href="/newest/lap/"><?php echo esc_html( __( 'Start Praying', 'prayer-global-porch' ) ) ?></a>
                <a id="learn-more-desktop" href="#section-goal-desktop" class="btn-learn-more mt-2 text-decoration-none d-none d-md-block">
                    <div class="btn btn-primary-light white uppercase btn-learn-more">
                        <?php echo esc_html( __( 'Learn more', 'prayer-global-porch' ) ) ?>
                    </div>
                    <br>
                    <i class="icon pg-chevron-down white"></i>
                </a>
                <a id="learn-more-mobile" href="#section-goal" class="btn-learn-more mt-2 text-decoration-none d-block d-md-none">
                    <div class="btn btn-primary-light white uppercase btn-learn-more">
                        <?php echo esc_html( __( 'Learn more', 'prayer-global-porch' ) ) ?>
                    </div>
                    <br>
                    <i class="icon pg-chevron-down white"></i>
                </a>
            </div>
        </div>
    </div>
</section>
<!-- END section -->

<section class="section-goal-desktop lh-base">

    <div class="position-relative">
        <img src="<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ) ?>assets/images/desktop-story-background-01.jpg" alt="">
        <div class="white desktop-story__container text-left container flow-small" id="section-goal-desktop">
            <h2 class="font-title"><i class="icon pg-logo-prayer me-3"></i><?php echo esc_html__( 'The Goal', 'prayer-global-porch' ) ?></h2>
            <p>
                <?php echo sprintf( esc_html__( 'The clock is ticking. %sPrayer.Global seeks to encourage extraordinary prayer for the fulﬁllment of the Great Commission in our generation.', 'prayer-global-porch' ), '</p><p>' ) ?>
            </p>
            <p>
                <?php echo esc_html__( 'But how?', 'prayer-global-porch' ) ?>
            </p>
        </div>
    </div>
    <div class="position-relative">
        <img src="<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ) ?>assets/images/desktop-story-background-02.jpg" alt="">
        <div class="brand-light desktop-story__container text-right-40 container flow-small text-align-right">
            <h2 class="font-title"><?php echo esc_html__( 'The Race', 'prayer-global-porch' ) ?><i class="icon pg-relay ms-3"></i></h2>
            <p>
                <?php echo esc_html__( 'Like a race, we pray with urgency and focus as we seek to complete laps by covering the entire world in prayer. An interactive map gives us real time updates on who we’ve prayed for and stats on our collective prayer lap status.', 'prayer-global-porch' ) ?>
            </p>
        </div>
    </div>
    <div class="position-relative">
        <img src="<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ) ?>assets/images/desktop-story-background-03.jpg" alt="">
        <div class="brand-light desktop-story__container text-left container flow-small">
            <h2 class="font-title"><i class="icon pg-world-arrow me-3"></i><?php echo esc_html__( 'Our Strategy', 'prayer-global-porch' ) ?></h2>
            <p>
                <?php echo sprintf( esc_html__( 'Prayer.Global has broken the world down into 4,770 states based on geographical and governmental boundaries. %1$sWhen you press the Start Praying button, location specific prayer fuel will help guide your prayers for each of these regions. %2$sThen, watch on the map as our united prayers light up the darkness.', 'prayer-global-porch' ), '<br>', '<br>' ) ?>
            </p>
        </div>
    </div>
    <div class="position-relative" id="story4">
        <img src="<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ) ?>assets/images/desktop-story-background-04.jpg" alt="">
        <div class="brand-light desktop-story__container text-right-40 container center">
            <h2 class="font-title mb-3"><?php echo esc_html__( 'Current Status', 'prayer-global-porch' ) ?><i class="icon pg-logo-prayer ms-3"></i></h2>
            <div class="two-col-sm gap-2">
                <div class="brand-lighter-bg white rounded-4 mx-auto mb-2 w-fit pt-4 pb-2 px-3 pb-0">
                    <h3 class="font-base uppercase font-weight-bold" style="line-height: 0.7"><?php echo sprintf( esc_html_x( 'Prayer%1$sLaps %2$s', 'Prayer Laps Completed', 'prayer-global-porch' ), '&nbsp;', sprintf( '<br> <span class="one-rem">%s</span>', esc_html_x( 'Completed', 'Laps Completed', 'prayer-global-porch' ) ) ) ?></h3>
                    <h3 class="global-laps-completed six-em lh-xsm"><span class="loading-spinner active"></span></h3>
                </div>
                <p class="pb-3 mx-auto">
                    <?php echo sprintf( esc_html__( 'Our ﬁrst global race started %1$s year and %2$s days ago and we’ve completed %3$s laps together so far.', 'prayer-global-porch' ), '<span class="global-years-elapsed"><span class="loading-spinner active"></span></span>', '<span class="global-days-elapsed"><span class="loading-spinner active"></span></span>', '<span class="global-laps-completed"><span class="loading-spinner active"></span></span>' ) ?>
                </p>
            </div>
            <div class="">
                <h3 class="font-base font-weight-bold uppercase"><?php echo sprintf( esc_html__( 'Lap %s Time Elapsed', 'prayer-global-porch' ), '<span class="global-lap-number"><span class="loading-spinner active"></span></span>' ) ?></h3>
                <div class="white brand-bg rounded-4 m-auto w-fit px-4 py-3 two-em font-weight-bold uppercase | current-time-elapsed time_elapsed">
                    <span class="loading-spinner active"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="position-relative" id="story5">
        <img src="<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ) ?>assets/images/desktop-story-background-05.png" alt="">
        <div class="brand-light desktop-story__container text-right-40 text-bottom container text-align-right me-4" style="z-index: 1;">
            <h2 class="font-title mb-3"><?php echo esc_html__( 'The Finish Line', 'prayer-global-porch' ) ?><i class="icon pg-logo-prayer ms-3"></i></h2>
            <p class="pb-3">
                <?php echo sprintf( esc_html__( 'With each prayer lap we complete, we are that much closer to ushering in God’s Kingdom and the return of Jesus Christ! %sClick Start Praying to start your Prayer.Global experience today!', 'prayer-global-porch' ), '<br>' ) ?>
            </p>
            <div class="center align-self-end">
                <h2 class="font-title"><?php echo esc_html__( 'Ready. Set.', 'prayer-global-porch' ) ?><i class="icon pg-logo-prayer d-none"></i></h2>
                <div class="mb-2"><a class="btn btn-cta mx-2 two-rem" href="/newest/lap/"><?php echo esc_html__( 'Start Praying', 'prayer-global-porch' ) ?></a></div>
                <i class="icon pg-logo-prayer icon-medium d-block"></i>
            </div>
        </div>
        <div class="white desktop-story__container text-left text-bottom container center mt-5">
            <h2 class="font-title mb-0">Prayer.Global</h2>
            <h3><?php echo esc_html( __( 'Cover the World in Prayer', 'prayer-global-porch' ) ) ?></h3>
        </div>
    </div>

</section>

<section class="page-section full-height section-goal-mobile" id="section-goal">
    <div class="container">
        <div class="row text-center justify-content-center">
            <div id="storyCarousel" class="carousel slide px-0">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="full-height contain bg-bottom" style="background-image: url(<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ) ?>assets/images/story-background-0.png);">
                            <div class="container">
                                <div class="row d-block">
                                    <i class="icon pg-logo-prayer icon-medium my-3 d-block"></i>
                                    <h2 class="font-title mb-3"><?php echo esc_html__( 'The Goal', 'prayer-global-porch' ) ?></h2>
                                    <p class="white-gradient pb-3">
                                        <?php echo sprintf( esc_html__( 'The clock is ticking. %sPrayer.Global seeks to encourage extraordinary prayer for the fulﬁllment of the Great Commission in our generation.', 'prayer-global-porch' ), '' ) ?>
                                        <br>
                                        <?php echo esc_html__( 'But how?', 'prayer-global-porch' ) ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="full-height contain bg-bottom" style="background-image: url(<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ) ?>assets/images/story-background-1.png);">
                            <div class="container">
                                <div class="row d-block">
                                    <i class="icon pg-relay icon-medium my-3 d-block"></i>
                                    <h2 class="font-title mb-3"><?php echo esc_html__( 'The Race', 'prayer-global-porch' ) ?></h2>
                                    <p class="white-gradient pb-3 px-5">
                                        <?php echo esc_html__( 'Like a race, we pray with urgency and focus as we seek to complete laps by covering the entire world in prayer. An interactive map gives us real time updates on who we’ve prayed for and stats on our collective prayer lap status.', 'prayer-global-porch' ) ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="full-height contain bg-bottom" style="background-image: url(<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ) ?>assets/images/story-background-2.png);">
                            <div class="container">
                                <div class="row d-block">
                                    <i class="icon pg-world-arrow icon-medium my-3 d-block"></i>
                                    <h2 class="font-title mb-3"><?php echo esc_html__( 'Our Strategy', 'prayer-global-porch' ) ?></h2>
                                    <p class="white-gradient pb-3 px-5">
                                        <?php echo sprintf( esc_html__( 'Prayer.Global has broken the world down into 4,770 states based on geographical and governmental boundaries. %1$sWhen you press the Start Praying button, location specific prayer fuel will help guide your prayers for each of these regions. %2$sThen, watch on the map as our united prayers light up the darkness.', 'prayer-global-porch' ), '', '' ) ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="full-height contain bg-bottom" style="background-image: url(<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ) ?>assets/images/story-background-3.png);">
                            <div class="container">
                                <div class="row d-block">
                                    <i class="icon pg-logo-prayer icon-medium my-3 d-block"></i>
                                    <h2 class="font-title mb-3"><?php echo esc_html__( 'Current Status', 'prayer-global-porch' ) ?></h2>
                                    <p class="white-gradient pb-3">
                                        <?php echo sprintf( esc_html__( 'Our ﬁrst global race started %1$s days ago and we’ve completed %2$s laps together so far.', 'prayer-global-porch' ), '<span class="global-days-elapsed"><span class="loading-spinner active"></span></span>', '<span class="global-laps-completed"><span class="loading-spinner active"></span></span>' ) ?>
                                    </p>
                                    <div class="brand-lighter-bg white rounded m-auto my-5 w-fit py-2 px-4 pb-0">
                                        <h3 style="line-height: 0.7"><?php echo sprintf( esc_html_x( 'Laps %s', 'Laps Completed', 'prayer-global-porch' ), sprintf( '<br> <span class="one-rem">%s</span>', esc_html_x( 'Completed', 'Laps Completed', 'prayer-global-porch' ) ) ) ?></h3>
                                        <h3 class="global-laps-completed six-em"><span class="loading-spinner active"></span></h3>
                                    </div>
                                    <div class="">
                                        <h3><?php echo sprintf( esc_html__( 'Lap %s Time Elapsed', 'prayer-global-porch' ), '<span class="global-lap-number"><span class="loading-spinner active"></span></span>' ) ?></h3>
                                        <div class="white brand-bg rounded m-auto w-fit px-3 py-1 three-em font-weight-bold uppercase | current-time-elapsed time_elapsed">
                                            <span class="loading-spinner active"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="full-height contain bg-bottom" style="background-image: url(<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ) ?>assets/images/story-background-4.png);">
                            <div class="container">
                                <div class="row d-block">
                                    <i class="icon pg-crown icon-medium my-3 d-block"></i>
                                    <h2 class="font-title mb-3"><?php echo esc_html__( 'The Finish Line', 'prayer-global-porch' ) ?></h2>
                                    <p class="white-gradient pb-3">
                                        <?php echo sprintf( esc_html__( 'With each prayer lap we complete, we are that much closer to ushering in God’s Kingdom and the return of Jesus Christ! %sClick Start Praying to start your Prayer.Global experience today!', 'prayer-global-porch' ), '<br>' ) ?>
                                    </p>
                                    <img class="w-100 p-0 finish-line" src="<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ) ?>assets/images/finish-line-cropped-no-text.png" alt="dark world">

                                    <div class="mb-4 pb-3 position-absolute bottom-0"><a class="btn btn-cta mx-2 two-rem" href="/newest/lap/"><?php echo esc_html__( 'Start Praying', 'prayer-global-porch' ) ?></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev four-em mt-5" type="button" data-bs-target="#storyCarousel" data-bs-slide="prev">
                    <i class="icon pg-chevron-left brand" aria-hidden="true"></i>
                    <span class="visually-hidden"><?php echo esc_html__( 'Previous', 'prayer-global-porch' ) ?></span>
                </button>
                <button class="carousel-control-next four-em mt-5" type="button" data-bs-target="#storyCarousel" data-bs-slide="next">
                    <i class="icon pg-chevron-right brand" aria-hidden="true"></i>
                    <span class="visually-hidden"><?php echo esc_html__( 'Next', 'prayer-global-porch' ) ?></span>
                </button>
            </div>
        </div>
    </div>
</section>

<section class="page-section" data-section="lap" id="section-lap">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col col-md-9 col-lg-8 col-xl-6">
                <div class="flow pg-card brand-lighter center uppercase mb-3">
                    <i class="icon pg-race icon-large d-block pt-4"></i>
                    <h2 class="mb-0"><?php echo esc_html( __( 'Global Race Stats', 'prayer-global-porch' ) ) ?></h2>

                    <div>
                    <span class=""><?php echo esc_html( __( 'Total Elapsed Time', 'prayer-global-porch' ) ) ?></span>
                        <div class="four-em font-weight-bold global-time-elapsed time_elapsed"></div>
                    </div>

                    <div class="row border-top border-2 border-primary" style="--bs-gutter-x: 0">
                        <div class="col-6 p-2 pt-4 border-end border-primary border-1">
                            <i class="icon pg-world-light d-block icon-small"></i>
                            <span class=""><?php echo esc_html( __( 'Laps Completed', 'prayer-global-porch' ) ) ?></span>
                            <h3 class="global-laps-completed six-em lh-1"><span class="loading-spinner active"></span></h3>
                        </div>
                        <div class="col-6 p-2 pt-4 border-start border-primary border-1">
                            <i class="icon pg-prayer d-block icon-small"></i>
                            <span class=""><?php echo esc_html( __( 'Total Intercessors', 'prayer-global-porch' ) ) ?></span>
                            <h3 class="global-participants six-em lh-1"><span class="loading-spinner active"></span></h3>
                        </div>
                    </div>

                </div>
                <div class="d-flex my-4 gap-2">
                <a href="/race_app/race_map/" role="button" class="btn smoothscroll btn-primary uppercase flex-grow-1"><?php echo esc_html( __( 'Race Map', 'prayer-global-porch' ) ) ?></a>
                <a href="/race_app/race_list/" role="button" class="btn smoothscroll btn-primary uppercase flex-grow-1"><?php echo esc_html( __( 'Race List', 'prayer-global-porch' ) ) ?></a>
                </div>

                <div class="flow pg-card brand-bg white center uppercase mb-5">
                    <i class="icon pg-world-arrow icon-large pt-4 d-block"></i>
                    <h1 class="mb-0 lh-xsm"><?php echo sprintf( esc_html__( 'Lap %s', 'prayer-global-porch' ), '<span class="global-lap-number">' ) ?><span class="loading-spinner active"></span></span></h1>

                    <hr class="border-white border">

                    <h6 class="mb-0"><?php echo esc_html( __( 'Current Lap Elapsed Time', 'prayer-global-porch' ) ) ?></h6>
                    <div class="current-time-elapsed time_elapsed four-em font-weight-bold"><span class="loading-spinner active"></span></div>

                    <hr class="border-white border">
                    <div class="flow" style="--pg-flow-size: 0.1rem">
                        <i class="icon pg-prayer d-block icon-small"></i>
                        <h6 class="mb-0"><?php echo esc_html( __( 'Intercessors', 'prayer-global-porch' ) ) ?></h6>
                        <div class="current-participants four-em font-weight-bold lh-1"><span class="loading-spinner active"></span></div>
                    </div>

                    <hr class="border-white border">

                    <i class="icon pg-world-light icon-small d-block"></i>
                    <h6 class="mb-0 mt-1"><?php echo esc_html( __( 'Places Covered', 'prayer-global-porch' ) ) ?></h6>
                    <div class="my-4 mx-auto position-relative | progress-bar">
                        <div class="orange-gradient position-absolute top-0 h-100 | progress-bar__slider"></div>
                        <div class="position-absolute top-0 bottom-0 start-0 end-0 d-flex justify-content-between">
                            <div class="bg-transparent | progress-bar__marker"></div>
                            <div class="progress-bar__marker"></div>
                            <div class="progress-bar__marker"></div>
                            <div class="progress-bar__marker"></div>
                            <div class="bg-transparent | progress-bar__marker"></div>
                        </div>

                    </div>

                    <span class="four-em font-weight-bold lh-1"><?php echo sprintf( esc_html_x( '%1$s of %2$s', '10 of 4770', 'prayer-global-porch' ), '<span class="current-completed"><span class="loading-spinner active"></span></span>', '<span>' . esc_html( PG_TOTAL_STATES ) . '</span>' ) ?></span>

                    <a href="/newest/map/" role="button" class="btn smoothscroll btn-primary uppercase mb-3 w-100 has-icon" data-reverse-color>
                        <span><?php echo esc_html( __( 'Current Map', 'prayer-global-porch' ) ) ?></span>
                        <i class="icon pg-chevron-right icon-end me-3 two-rem end-0"></i>
                    </a>
                </div>

                <div class="mb-3 mx-auto center"><a class="btn btn-cta two-em" href="/newest/lap/"><?php echo esc_html( __( 'Start Praying', 'prayer-global-porch' ) ) ?></a></div>
            </div>
        </div>
    </div>
</section>
<!-- END section -->


<style>
    .hover-box {
        max-width:400px;
        border: 1px solid white;
        vertical-align:middle;
        margin: .5em auto;
        padding:.7em;
        border-radius: 15px;
    }
    .hover-box:hover {
        background-color: white;
        color: var(--pg-brand-color) !important;
    }
    .hover-box:hover a {
        color: var(--pg-brand-color) !important;
    }
</style>
<section id="section-mobile" class="page-section text-center d-sm-none d-md-block brand-bg">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-12">
            <h2 class="heading mb-3"><a href="/qr/app/" style="color:white;"><?php echo esc_html( __( 'Get the Mobile App', 'prayer-global-porch' ) ) ?></a></h2>
                <a class="white" href="https://apps.apple.com/us/app/prayer-global/id1636889534?uo=4" style="font-size:2em;">
                    <div class="hover-box">
                        <i class="ion-social-apple" ></i>
                        <?php echo sprintf( esc_html__( '%s App', 'prayer-global-porch' ), 'iPhone/iPad' ) ?>
                    </div>
                </a>
                <a class="white" href="https://play.google.com/store/apps/details?id=app.global.prayer" style="font-size:2em;">
                    <div class="hover-box">
                        <i class="ion-social-android"></i>
                        <?php echo sprintf( esc_html__( '%s App', 'prayer-global-porch' ), 'Android' )?>
                    </div>
                </a>

            </div>
        </div>

    </div>
</section>
<!-- END section -->

<?php require_once( trailingslashit( plugin_dir_path( __DIR__ ) ) . '/assets/working-footer.php' ) ?>
