<?php
if ( !defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly.

class Prayer_Global_Church extends DT_Magic_Url_Base
{
    public $magic = false;
    public $parts = false;
    public $page_title = 'Global Prayer - Church';
    public $root = 'content_app';
    public $type = 'church';
    public $type_name = 'Global Prayer - Church';
    public static $token = 'content_app_church';
    public $post_type = 'laps';

    private static $_instance = null;
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    } // End instance()

    public function __construct() {
        parent::__construct();

        $url = dt_get_url_path();
        if ( ( $this->type ) === $url ) {

            $this->magic = new DT_Magic_URL( $this->root );
            $this->parts = $this->magic->parse_url_parts();


            // register url and access
            add_action( "template_redirect", [ $this, 'theme_redirect' ] );
            add_filter( 'dt_blank_access', function (){ return true;
            }, 100, 1 );
            add_filter( 'dt_allow_non_login_access', function (){ return true;
            }, 100, 1 );
            add_filter( 'dt_override_header_meta', function (){ return true;
            }, 100, 1 );

            // header content
            add_filter( "dt_blank_title", [ $this, "page_tab_title" ] ); // adds basic title to browser tab
            add_action( 'wp_print_scripts', [ $this, 'print_scripts' ], 1500 ); // authorizes scripts
            add_action( 'wp_print_styles', [ $this, 'print_styles' ], 1500 ); // authorizes styles


            // page content
            add_action( 'dt_blank_head', [ $this, '_header' ] );
            add_action( 'dt_blank_footer', [ $this, '_footer' ] );
            add_action( 'dt_blank_body', [ $this, 'body' ] ); // body for no post key

            add_filter( 'dt_magic_url_base_allowed_css', [ $this, 'dt_magic_url_base_allowed_css' ], 10, 1 );
            add_filter( 'dt_magic_url_base_allowed_js', [ $this, 'dt_magic_url_base_allowed_js' ], 10, 1 );

            add_filter( 'dt_allow_rest_access', [ $this, 'authorize_url' ], 10, 1 );

        }

    }

    public function authorize_url( $authorized ){

        $url = 'go-stripe/v1/pay';
        if ( isset( $_SERVER['REQUEST_URI'] ) &&
            strpos( sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) ), $url ) !== false ) {
            $authorized = true;
        }

        return $authorized;
    }



    public function dt_magic_url_base_allowed_js( $allowed_js ) {
        return array_merge( $allowed_js, [
            'stripe',
            'fetch',
            'jQuery',
            'client-stripe-js',
        ] );
    }

    public function dt_magic_url_base_allowed_css( $allowed_css ) {
        return [];
    }

    public function header_javascript(){
        require_once( trailingslashit( plugin_dir_path( __DIR__ ) ) . 'assets/header.php' );
        ?>
        <link href="https://fonts.googleapis.com/css?family=Crimson+Text:400,400i,600|Montserrat:200,300,400" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ) ?>assets/fonts/ionicons/css/ionicons.min.css">
        <link rel="stylesheet" href="<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ) ?>assets/css/basic.css?ver=<?php echo esc_attr( fileatime( trailingslashit( plugin_dir_path( __DIR__ ) ) . 'assets/css/basic.css' ) ) ?>" type="text/css" media="all">
        <?php
    }

    public function footer_javascript(){
        require_once( trailingslashit( plugin_dir_path( __DIR__ ) ) . 'assets/footer.php' );
    }

    public function body(){
        require_once( trailingslashit( plugin_dir_path( __DIR__ ) ) . '/assets/nav.php' ) ?>

        <section class="page-section mt-5" data-section="church" id="section-church">
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col col-md-8 flow">
                        <div>
                            <img src="<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) . 'assets/images/prayer-global-church.jpg' ) ?>" alt="<?php echo esc_attr( __( 'Prayer.Global cover the world in prayer', 'prayer-global' ) ) ?>">
                        </div>
                        <div class="flow-small">
                            <h2 class=""><?php echo esc_html( __( 'What is Prayer.Global', 'prayer-global-porch' ) ) ?></h2>
                            <p>
                                <?php echo esc_html__( 'Simply put, Prayer.Global is a digital tool for facilitating strategic, Scripture-based prayer for the world. Prayer.Global seeks to encourage extraordinary prayer for the fulfillment of the Great Commission using technology.', 'prayer-global' ) ?>
                            </p>
                            <p>
                                <?php echo esc_html__( 'Prayer.Global has broken the world down into 4,770 “states” based on geographical and governmental boundaries. When you access the site and click Start Praying, you will initiate a one-minute timer and then will be given a state to pray for. Each state prayer prompt includes demographic information about the area, its religious makeup, images and Scripture-based prayer prompts. Once you have prayed for that area, you can choose “next” and be given another prayer area, or you may finish your prayer time.', 'prayer-global' ) ?>
                            </p>
                            <p>
                                <?php echo esc_html__( 'With this digital resource, you will be saying prayers you never said before, praying for people you never knew existed, and you and this world will be changed!', 'prayer-global' ) ?>
                            </p>
                        </div>
                        <div class="flow-medium">
                            <h2 class=""><?php echo esc_html( __( 'How to launch Prayer.Global at your church', 'prayer-global-porch' ) ) ?></h2>
                            <div class="flow-small">
                                <h3 class=""><?php echo esc_html( __( 'Contact the Prayer.Global team to setup a lap for your group', 'prayer-global-porch' ) ) ?></h3>
                                <p>
                                    <?php echo esc_html__( 'You will also be given a custom URL, QR code and more to use in promoting your prayer lap. The unique URL will connect your church family directly to your group’s prayer lap. Contact Prayer.Global to request a group challenge', 'prayer-global' ) ?>
                                </p>
                                <h3 class=""><?php echo esc_html( __( 'Cast vision and set a goal for your church', 'prayer-global-porch' ) ) ?></h3>
                                <p>
                                    <?php echo esc_html__( 'Begin the Prayer.Global experience for your church by establishing a goal – a “why” – and casting vision about the importance of prayer in fulfilling the Great Commission. Extraordinary prayer is a foundational mark of all modern disciple making movements.', 'prayer-global' ) ?>
                                </p>
                                <p>
                                    <?php echo esc_html__( 'Why technology? God has used technology for the advance of His kingdom (i.e. written language, Roman roads, printing presses, etc.) throughout the ages. The Internet gives us unprecedented access to coordinate prayer for the nations. Prayer.global will guide our prayers so that we align our heart with God’s heart. It helps us pray what Jesus prayed in John 17:20 – for those who have yet to believe – so that God will engage our heart for a lost world and so that we can see a movement of God as workers go into the harvest field to make disciples.', 'prayer-global' ) ?>
                                </p>
                                <p class="font-weight-bold"><?php echo esc_html__( 'Sample goals', 'prayer-global' ) ?></p>
                                <ul>
                                    <li><?php echo esc_html__( 'Make one prayer lap in one day – We want everyONE to pray for ONE state at a time until we make ONE lap around the world in ONE day.', 'prayer-global' ) ?></li>
                                    <li><?php echo esc_html__( 'Make one prayer lap in one week – We want everyONE to pray for ONE state at a time until we make ONE lap around the world in ONE week.', 'prayer-global' ) ?></li>
                                </ul>
                                <p class="font-weight-bold">
                                    <?php echo esc_html__( 'The best way to model the use of Prayer.Global is by incorporating a prayer time into a weekly gathering.', 'prayer-global' ) ?>
                                </p>
                            </div>
                            <div class="flow-small">
                                <h3 class=""><?php echo esc_html( __( 'Promote in advance of your event', 'prayer-global-porch' ) ) ?></h3>
                                <p>
                                    <?php echo esc_html__( 'Give your church family advance notice of the upcoming Prayer.Global event to help encourage their participation and to help them be prepared to pray on the day of your event. Here is a proposed timeline for promotion.', 'prayer-global' ) ?>
                                </p>
                                <ul>
                                    <li><?php echo esc_html__( 'Make an announcement the week before your event, if you plan to pray during your regular weekly Sunday gathering. At Northside, we used a combination of an announcement during our regular time and a mention by our lead minister at the start of his sermon.', 'prayer-global' ) ?></li>
                                    <li><?php echo esc_html__( 'Provide postcards in seat pockets and at exits to provide more information. Encourage people to bring a device with them.', 'prayer-global' ) ?></li>
                                    <li><?php echo esc_html__( 'Send an email at least 3 days before to cast vision and to encourage your congregation to download the Prayer.Global app. Include links to both app stores.', 'prayer-global' ) ?></li>
                                    <li><?php echo esc_html__( 'Send a text the day before the event with a link to Prayer.Global, if you have a texting service. This will help your church family have the link handy.', 'prayer-global' ) ?></li>
                                </ul>
                                <p>
                                    <em><?php echo esc_html__( 'In pre-event promotion, we promoted only the Prayer.Global website and the links for downloading the app. We didn’t share our custom group URL until the day of the event. This helped ensure better tracking of how many people prayed with us during the event.', 'prayer-global' ) ?></em>
                                </p>
                                <h3 class=""><?php echo esc_html( __( 'Resources', 'prayer-global-porch' ) ) ?></h3>
                                <ul>
                                    <li><?php echo esc_html__( 'Download the custom QR code from the Prayer.Global website once your lap is set up.', 'prayer-global' ) ?></li>
                                    <li><a href="https://docs.google.com/document/d/1LwjtcIwqJVop19qHinZqCo1HNNQYWgCiQcN_e3doYu8/edit?usp=share_link"><?php echo esc_html__( 'Access Canva design templates for postcards, presentation slides and social media images.', 'prayer-global' ) ?></a></li>
                                    <li><a href="https://docs.google.com/document/d/1YPX5zrzt1Wbf5KOlUQlLWxiTmfhZPXqc_qD91QB-LQ0/edit?usp=share_link"><?php echo esc_html__( 'Read sample emails, social media posts and announcement scripts.', 'prayer-global' ) ?></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="flow-medium">
                            <h2 class=""><?php echo esc_html( __( 'Hosting your Prayer.Global event', 'prayer-global-porch' ) ) ?></h2>
                            <div class="flow-small">
                                <p>
                                    <?php echo esc_html( __( 'For us at Northside, it was important to give our Prayer.Global challenge prominence. We achieved that by giving it ample time in our service, from how it was set-up to the actual time spent in prayer. We recommend setting aside at least 10 minutes for prayer, plus about 5 minutes to cast vision and to equip your church family for participation.', 'prayer-global-porch' ) ) ?>
                                </p>
                                <p>
                                    <?php echo esc_html( __( 'We broke that down into getting people connected to the prayer lap, facilitating the actual prayer time and then providing next steps after it was completed. ', 'prayer-global-porch' ) ) ?>
                                </p>
                            </div>
                            <div class="flow-small">
                                <h3 class=""><?php echo esc_html( __( 'Getting people connected to your group’s prayer lap', 'prayer-global-porch' ) ) ?></h3>
                                <ul>
                                    <li><?php echo esc_html__( 'Seat cards with the custom lap QR code along with steps for navigating to the website.', 'prayer-global' ) ?></li>
                                    <li><?php echo esc_html__( 'Display the QR code on your Worship Center screens or TVs.', 'prayer-global' ) ?></li>
                                    <li><?php echo esc_html__( 'Add a link – like a Pray Now button – to your church website.', 'prayer-global' ) ?></li>
                                    <li><?php echo esc_html__( 'Add the link to your online sermon notes.', 'prayer-global' ) ?></li>
                                </ul>
                                <h3 class=""><?php echo esc_html( __( 'Facilitating the group prayer time', 'prayer-global-porch' ) ) ?></h3>
                                <p>
                                    <?php echo esc_html( __( 'For your prayer time, here are some best practices for how to facilitate that time for your group:', 'prayer-global-porch' ) ) ?>
                                </p>
                                <ul>
                                    <li><?php echo esc_html__( 'Segue into your prayer time by casting vision about what is about to happen.', 'prayer-global' ) ?></li>
                                    <li><?php echo esc_html__( 'Show how the Prayer.Global tool works by walking people through a prayer prompt using a screen share, presentation computer or through a video. Take the full minute to scroll through the prompts, demonstrating how to use the different pieces of information to guide your prayers.', 'prayer-global' ) ?></li>
                                    <li><?php echo esc_html__( 'Provide time for people to get out their devices, scan the codes and to be ready to go. Give the go ahead to start praying and start the countdown timer.', 'prayer-global' ) ?></li>
                                    <li><?php echo esc_html__( 'Add a link – like a Pray Now button – to your church website.', 'prayer-global' ) ?></li>
                                    <li><?php echo esc_html__( 'Close the time in prayer to give people time to finish the state they are in.', 'prayer-global' ) ?></li>
                                    <li><?php echo esc_html__( 'If possible, provide an update about how many states your group prayed for during that time. You can use the display map to showcase this or provide that information to a host or worship minister to share when they come on stage.', 'prayer-global' ) ?></li>
                                </ul>
                                <a href="https://www.northsidechristianchurch.net/wp-content/uploads/2023/03/Talking-Points-Prayer.Global-Event.pdf"><?php esc_html__( 'Download the Prayer.Global Talking Points', 'prayer-global' ) ?></a>
                            </div>
                            <div class="flow-small">
                                <h3 class=""><?php echo esc_html( __( 'Provide next steps', 'prayer-global-porch' ) ) ?></h3>
                                <p>
                                    <?php echo esc_html__( 'How do you encourage continued prayer for the nations? Help people brainstorm ways they can use the Prayer.Global app moving forward. Some ideas include:', 'prayer-global' ) ?>
                                </p>
                                <ul>
                                    <li><?php echo esc_html__( 'Complete 1 or 2 prayers before going to bed or putting your kids to bed.', 'prayer-global' ) ?></li>
                                    <li><?php echo esc_html__( 'Finish your Bible reading time with 1 or 2 prayers.', 'prayer-global' ) ?></li>
                                    <li><?php echo esc_html__( 'Add 1 or 2 prayers before each meal time.', 'prayer-global' ) ?></li>
                                    <li><?php echo esc_html__( 'Incorporate 1 or 2 prayers into your weekly Life Group meeting.', 'prayer-global' ) ?></li>
                                    <li><?php echo esc_html__( 'Invite someone to pray with you by sharing about the app.', 'prayer-global' ) ?></li>
                                </ul>
                                <h3 class=""><?php echo esc_html( __( 'Tips', 'prayer-global-porch' ) ) ?></h3>
                                <ul>
                                    <li><?php echo esc_html__( 'Set a specific amount of time for prayer. We focused on 10 minutes, with the goal of everyone praying for about 7 states during that time.', 'prayer-global' ) ?></li>
                                    <li><?php echo esc_html__( 'Recruit a few technology helpers to be positioned around the room when your prayer time begins. They can help people troubleshoot any issues with their device or accessing the correct prayer lap.', 'prayer-global' ) ?></li>
                                    <li><?php echo esc_html__( 'Encourage people to pray out loud, model this from the stage and play some soft music during the prayer time. This will help the room not feel empty while also encouraging participation.', 'prayer-global' ) ?></li>
                                    <li><?php echo esc_html__( 'Show a prayer prompt session on the main screens so those without devices can pray along, too.', 'prayer-global' ) ?></li>
                                    <li><?php echo esc_html__( 'If possible, make a few devices available for those who may not have one with them. We used iPads and laptops.', 'prayer-global' ) ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="flow-medium">
                            <div class="flow-small">
                                <h2 class=""><?php echo esc_html( __( 'After the event', 'prayer-global-porch' ) ) ?></h2>
                                <p>
                                    <?php echo esc_html__( 'Based on how your group ended your prayer experience, provide follow up information, texts or emails to encourage people to keep praying and to celebrate once your lap is complete.', 'prayer-global' ) ?>
                                </p>
                                <ul>
                                    <li><a href="https://docs.google.com/document/d/1LwjtcIwqJVop19qHinZqCo1HNNQYWgCiQcN_e3doYu8/edit?usp=share_link"><?php echo esc_html__( 'Lap completion graphics', 'prayer-global' ) ?></a></li>
                                    <li><a href="https://docs.google.com/document/d/1YPX5zrzt1Wbf5KOlUQlLWxiTmfhZPXqc_qD91QB-LQ0/edit?usp=share_link"><?php echo esc_html__( 'Email and text samples', 'prayer-global' ) ?></a></li>
                                </ul>
                            </div>
                            <div class="flow-small">
                                <h2 class=""><?php echo esc_html( __( 'FAQs', 'prayer-global-porch' ) ) ?></h2>
                                <p class="font-weight-bold">
                                    <em><?php echo esc_html__( 'What is a state?', 'prayer-global' ) ?></em>
                                </p>
                                <p>
                                    <?php echo esc_html__( 'States, counties, provinces, parishes, etc. – there is no completely consistent way to name geographical regions within countries. Prayer.Global uses geographical, diplomatic and governmental boundaries to divide the world’s 195 countries into 4,770 states.', 'prayer-global' ) ?>
                                </p>
                                <p class="font-weight-bold">
                                    <em><?php echo esc_html__( 'What do the icons mean?', 'prayer-global' ) ?></em>
                                </p>
                                <p>
                                    <?php echo esc_html__( 'As you navigate through a prayer prompt, you will see people icons in a variety of colors. Red represents unbelievers; yellow represents nominal cultural Christians, and green represents believers.', 'prayer-global' ) ?>
                                </p>
                                <p class="font-weight-bold">
                                    <em><?php echo esc_html__( 'Am I just praying for unreached people groups?', 'prayer-global' ) ?></em>
                                </p>
                                <p>
                                    <?php echo esc_html__( 'No, the 4,770 states represent all countries and people groups in the world. At the bottom of the prayer prompt, you will see a highlight from an unreached people group who lives in that area, this includes people groups who have immigrated or are currently living as refugees in that area.', 'prayer-global' ) ?>
                                </p>
                                <p class="font-weight-bold">
                                    <em><?php echo esc_html__( 'Where is the faith status data coming from?', 'prayer-global' ) ?></em>
                                </p>
                                <p>
                                    <?php echo esc_html__( 'The Prayer.Global website uses information from The Joshua Project to build their database.', 'prayer-global' ) ?>
                                </p>
                                <p class="font-weight-bold">
                                    <em><?php echo esc_html__( 'How do I start my own group?', 'prayer-global' ) ?></em>
                                </p>
                                <p>
                                    <?php echo esc_html__( 'Contact Prayer.Global to request your own group lap.', 'prayer-global' ) ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php require_once( trailingslashit( plugin_dir_path( __DIR__ ) ) . '/assets/working-footer.php' ) ?>
        <?php
    }

}
Prayer_Global_Church::instance();