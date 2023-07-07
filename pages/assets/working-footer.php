<footer class="brand-bg white center one-rem font-weight-bold py-5 pg-footer" role="contentinfo">
    <div class="container">
        <p>
            <?php echo sprintf( esc_html_x( 'Made with %1$s by %2$s.', 'prayer-global-porch' ), '<a href="/user_app/login"><svg class="pg-heart" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>heart</title> <path d="M0.256 12.16q0.544 2.080 2.080 3.616l13.664 14.144 13.664-14.144q1.536-1.536 2.080-3.616t0-4.128-2.080-3.584-3.584-2.080-4.16 0-3.584 2.080l-2.336 2.816-2.336-2.816q-1.536-1.536-3.584-2.080t-4.128 0-3.616 2.080-2.080 3.584 0 4.128z"></path> </g></svg></a>', '<a href="https://gospelambition.org">Gospel Ambition</a>' ) ?><br>
            <?php echo wp_kses( sprintf( _x( 'Powered by %s.', 'Powered by Disciple.Tools.', 'prayer-global-porch' ), '<a href="https://disciple.tools">Disciple.Tools</a>' ), 'post' ) ?><br>
            <?php echo wp_kses( sprintf( _x( 'Part of the %s network.', 'Part of the Pray4Movement network.', 'prayer-global-porch' ), '<a href="https://pray4movement.org">Pray4Movement</a>' ), 'post' ) ?><br>
        </p>
        <ul style="list-style: none;">
            <li><a class="white" href="https://apps.apple.com/us/app/prayer-global/id1636889534?uo=4"><i class="ion-social-apple white"></i> <?php echo esc_html( __( 'iPhone/iPad App' ) ) ?></a></li>
            <li><a class="white" href="https://play.google.com/store/apps/details?id=app.global.prayer"><i class="ion-social-android white"></i> <?php echo esc_html( __( 'Android App' ) ) ?></a></li>
        </ul>
        <ul style="list-style: none;">
            <li><a class="white" href="/prayer_app/contact_us/"><?php echo esc_html( __( 'Contact Us', 'prayer-global-porch' ) ) ?></a></li>
            <li><a class="white fw-bold" href="/content_app/give_page"><?php echo esc_html( __( 'Give', 'prayer-global-porch' ) ) ?></a></li>
        </ul>
        <ul style="list-style: none;">
            <li><a class="white" href="/content_app/about_page/"><?php echo esc_html( __( 'About', 'prayer-global-porch' ) ) ?></a></li>
            <li><a class="white" href="/content_app/data_sources/"><?php echo esc_html( __( 'Data Sources', 'prayer-global-porch' ) ) ?></a></li>
            <li><a class="white" href="/download_app/media/"><?php echo esc_html( __( 'Media & Promotion', 'prayer-global-porch' ) ) ?></a></li>
        </ul>

        <div class="row pt-4">
            <div class="col text-center">
                <p>Prayer Global &copy; <script>document.write(new Date().getFullYear())</script> Gospel Ambition</p>
            </div>
        </div>
    </div>
</footer>
