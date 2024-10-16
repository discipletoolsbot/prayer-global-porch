<?php require_once( trailingslashit( plugin_dir_path( __DIR__ ) ) . '/assets/nav.php' ) ?>
<style>
    @media screen and ( max-width: 767px ) {
        /* hides 'start praying' only on the home and non-off canvas location */
        .navbar.navbar-dark .btn-outline-dark.py-lg-4 {
            display:none;
        }
    }
</style>

<section class="cover cover-black" style="background-image: url(<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ) ?>assets/images/map_background.jpg); height: 100vh;" id="section-home">
    <div class="container">
        <div class="row align-items-center justify-content-end">
            <div class="col-md-6  order-md-1">
                <h2 class="heading mb-3">Cover the World in Prayer</h2>
                <div class="sub-heading">
                    <p class="mb-5">Community driven, movement-focused, saturation prayer.</p>
                    <p><a href="/newest/lap/" role="button" class="btn cta_button smoothscroll btn-outline-dark">Start Praying</a></p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END section -->

<section class="page-section" data-section="lap" id="section-lap">
    <div class="container">
        <div class="row">
            <div class="col-md text-center stats-header">
                <h2 class="stats-header__title" style="">Current Lap</h2>
                <h3 class="stats-header__subtitle header-border-top" id="current_time_elapsed"><span class="loading-spinner active"></span></h3>
                <br>
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <div class="stats-info">
                    <div class="icon-circle display-4"><i class="text-primary ion-ios-body-outline"></i></div>
                    <div class="">
                        <h3 class="stats-info__title" id="current_participants"><span class="loading-spinner active"></span></h3>
                        <h3 class="stats-info__subtitle">Prayer Warriors</h3>
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="stats-info">
                    <div class="icon-circle display-4"><i class="text-primary ion-android-alarm-clock"></i></i></div>
                    <div class="">
                        <h3 class="stats-info__title" id="current_remaining"><span class="loading-spinner active"></span></h3>
                        <h3 class="stats-info__subtitle">Remaining</h3>
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="stats-info">
                    <div class="icon-circle display-4"><i class="text-primary ion-earth"></i></div>
                    <div class="">
                        <h3 class="stats-info__title" id="current_completed"><span class="loading-spinner active"></span></h3>
                        <h3 class="stats-info__subtitle">Covered</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <br><br>
        </div>
        <div class="row">
            <div class="col-md text-center">
                <a href="/newest/map/" role="button" class="btn smoothscroll btn-outline-dark btn-xl text-uppercase" data-reverse-color>Current Map</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md text-center stats-header">
                <h2 class="stats-header__title">Global Race</h2>
                <h3 class="stats-header__subtitle header-border-top" id="global_time_elapsed"><span class="loading-spinner active"></span></h3>
                <br>
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <div class="stats-info">
                    <div class="icon-circle display-4"><i class="text-primary ion-ios-body-outline"></i></div>
                    <div class="">
                        <h3 class="stats-info__title" id="global_participants"><span class="loading-spinner active"></span></h3>
                        <h3 class="stats-info__subtitle">Prayer Warriors</h3>
                    </div>
                </div>
            </div>
<!--            <div class="col-md">-->
<!--                <div class="stats-info">-->
<!--                    <div class="icon-circle display-4"><i class="text-primary ion-android-alarm-clock"></i></i></div>-->
<!--                    <div class="">-->
<!--                        <h3 class="stats-info__title" id="global_minutes_prayed"><span class="loading-spinner active"></span></h3>-->
<!--                        <h3 class="stats-info__subtitle">Minutes Prayed</h3>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
            <div class="col-md">
                <div class="stats-info">
                    <div class="icon-circle display-4"><i class="text-primary ion-earth"></i></div>
                    <div class="">
                        <h3 class="stats-info__title" id="global_lap_number"><span class="loading-spinner active"></span></h3>
                        <h3 class="stats-info__subtitle">Laps</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <br><br>
        </div>
        <div class="row">
            <div class="col-md text-center">
                <a href="/race_app/race_map/" role="button" class="btn smoothscroll btn-outline-dark btn-xl text-uppercase" data-reverse-color>Race Map</a>
                <a href="/race_app/race_list/" role="button" class="btn smoothscroll btn-outline-dark btn-xl text-uppercase" data-reverse-color>Race List</a>
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
        color: black !important;
    }
    .hover-box:hover a {
        color: black !important;
    }
</style>
<section id="section-mobile" class="cover cover-small text-center cover-black d-sm-none d-md-block" style="background-image: url(<?php echo esc_url( trailingslashit( plugin_dir_url( dirname( __FILE__ ) ) ) ) ?>assets/images/1900x1200_img_3.jpg)">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-12">
                <h2 class="heading mb-3"><a href="/qr/app/" style="color:white;">Get the Mobile App</a></h2>
                <a class="white" href="https://apps.apple.com/us/app/prayer-global/id1636889534?uo=4" style="font-size:2em;">
                    <div class="hover-box">
                        <i class="ion-social-apple" ></i>
                        iPhone/iPad App
                    </div>
                </a>
                <a class="white" href="https://play.google.com/store/apps/details?id=app.global.prayer" style="font-size:2em;">
                    <div class="hover-box">
                        <i class="ion-social-android"></i>
                        Android App
                    </div>
                </a>

            </div>
        </div>

    </div>
</section>
<!-- END section -->


<section class="page-section d-sm-none d-md-block" data-section="about" id="section-about">
    <div class="container">
        <div class="row justify-content-md-center text-center mb-5">
            <div class="col-lg-7">
                <h2 class="mt-0 header-border-top font-weight-normal">About</h2>
                <p>
                    Prayer.Global seeks to encourage extraordinary prayer for the fulfillment of the Great Commission using technology.
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-7">
                <div class="images right">
                    <img class="img1 img-fluid" src="<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ) ?>assets/images/pray-4770.jpg" alt="image">
                    <img class="img2" src="<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ) ?>assets/images/dark-map.jpg" alt="image">
                </div>
            </div>
            <div class="col-lg-5 ps-md-5 ps-sm-0">
                <div id="prayer_accordion_" class="pg-accordion" data-children=".item">
                    <div class="item">
                        <a class="pg-accordion__toggle" data-bs-toggle="collapse" href="#prayer_accordion_1" aria-expanded="true" aria-controls="prayer_accordion_1" >Historic Moment</a>
                        <div id="prayer_accordion_1" class="accordian-collapse collapse show" role="tabpanel">
                            <p>
                                We know three things about our moment in history:
                            </p>
                            <p>
                                (1) Never before in history have we been able to coordinate global prayer for the kingdom <u>IN REALTIME</u>!
                            </p>
                            <p>
                                (2) God has used technology for the advance of His kingdom (i.e. written language, Roman roads, printing presses, etc.),
                                and is now using the internet.
                            </p>
                            <p>
                                (3) "Extraordinary prayer" is a foundational mark of all modern disciple multiplying movements.
                            </p>
                            <p>
                                So, <strong>Prayer.Global</strong> exists to encourage extraordinary prayer for the fulfillment of the Great Commission using technology.
                            </p>
                            <p>
                                <br><hr>
                            </p>
                        </div>
                    </div>
                    <div class="item">
                        <a class="pg-accordion__toggle" data-bs-toggle="collapse" data-parent="#prayer_accordion_" href="#prayer_accordion_2" aria-expanded="false" aria-controls="prayer_accordion_2">How it works</a>
                        <div id="prayer_accordion_2" class="collapse" role="tabpanel">
                            <p>
                                <span class="black">&#9312;</span> Click on "Start Praying". <a href="/newest/lap/"><i class="ion-android-open"></i></a>
                            </p>
                            <p>
                                <strong class="black">&#9313;</strong> Use the demographics, guided prayers, faith status, images, and maps to pray for the location for one minute.
                            </p>
                            <p>
                                <strong class="black">&#9314;</strong> Once the one-minute timer has ended, you will be asked if you prayed for this location, if you click "Yes", then your prayer will be added to the community prayer coverage for the world.
                            </p>
                            <p>
                                <strong class="black">&#9315;</strong> Pray for another location or end your prayer session.
                            </p>
                            <p>
                                <br><hr>
                            </p>
                        </div>
                    </div>
                    <div class="item">
                        <a class="pg-accordion__toggle" data-bs-toggle="collapse" data-parent="#prayer_accordion_" href="#prayer_accordion_3" aria-expanded="false" aria-controls="prayer_accordion_3">Moravian Prayer Challenge</a>
                        <div id="prayer_accordion_3" class="collapse" role="tabpanel">
                            <p>
                                Inspired by the <a href="https://www.christianitytoday.com/history/issues/issue-1/prayer-meeting-that-lasted-100-years.html">Moravians</a>, who prayed non-stop for 100 years,
                                we have crafted this website to help the church pray for the entire world in measurable units, as a community, and to know at the end when we have finished ... and are ready to start
                                another lap.
                            </p>
                            <p>
                                Once every location in the world has been prayed for (we finish a lap), then the prayer map resets, and we try to pray over the world again
                                ... maybe faster.
                            </p>
                            <p>
                                The Moravians had one person praying every hour of every day for 100 years. This was roughly 876,000 hours of prayer, or 52,560,000 minutes of prayer for the world. We are humbled by this extraordinary commitment to praying for the world.
                            </p>
                            <p>
                                <a href="/content_app/about_page/#section-challenge">Learn more</a> about the Moravian Prayer Challenge.
                            </p>
                            <p>
                                <br><hr>
                            </p>
                        </div>
                    </div>
                    <div class="item">
                        <a class="pg-accordion__toggle" data-bs-toggle="collapse" data-parent="#prayer_accordion_" href="#prayer_accordion_4" aria-expanded="false" aria-controls="prayer_accordion_4">Maps & Lists</a>
                        <div id="prayer_accordion_4" class="collapse" role="tabpanel">
                            <p>
                                <strong class="black">Current Map</strong> <a href="/newest/map"><i class="ion-android-open"></i></a>
                            </p>
                            <p>
                                The current map shows what has been covered so far in the active prayer map.
                            </p>
                            <p>
                                <strong class="black">Race Map</strong> <a href="/race_app/race_map/"><i class="ion-android-open"></i></a>
                            </p>
                            <p>
                                The Race map shows the number of laps, number of minutes, and number of prayer warriors for the entire challenge.
                            </p>
                            <p>
                                <strong class="black">Race List</strong> <a href="/race_app/race_list/"><i class="ion-android-open"></i></a>
                            </p>
                            <p>
                                The Race List shows each of the laps accomplished so far and some of the statistics for those individual laps.
                            </p>
                            <p>
                                <br><hr>
                            </p>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>
<!-- END section -->



<?php require_once( trailingslashit( plugin_dir_path( __DIR__ ) ) . '/assets/working-footer.php' ) ?>
