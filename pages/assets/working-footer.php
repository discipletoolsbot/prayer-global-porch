<footer class="pg-footer" role="contentinfo"  style="background-image:  linear-gradient(0deg, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url(<?php echo esc_url( trailingslashit( plugin_dir_url( __DIR__ ) ) ) ?>assets/images/1900x1200_img_2.jpg);">
    <div class="container">
        <div class="row" >
            <div class="col-md-3">
                <p class="small">
                    <?php echo wp_kses( sprintf( _x( 'Made with %1$s by %2$s.', 'prayer-global-porch' ), '<a href="/user_app/login">&#10084;&#65039;</a>', '<a href="https://gospelambition.org" style="color:black;">Gospel Ambition</a>' ), 'post' ) ?><br>
                    <?php echo wp_kses( sprintf( _x( 'Powered by %s.', 'Powered by Disciple.Tools.', 'prayer-global-porch' ), '<a href="https://disciple.tools" style="color:black;">Disciple.Tools</a>' ), 'post' ) ?><br>
                    <?php echo wp_kses( sprintf( _x( 'Part of the %s network.', 'Part of the Pray4Movement network.', 'prayer-global-porch' ), '<a href="https://pray4movement.org" style="color:black;">Pray4Movement</a>' ), 'post' ) ?><br>
                </p>
            </div>
            <div class="col-md-3">
                <ul style="list-style: none;">
                    <li><a class="white" href="https://apps.apple.com/us/app/prayer-global/id1636889534?uo=4"><i class="ion-social-apple"></i> <?php echo esc_html( __( 'iPhone/iPad App' ) ) ?></a></li>
                    <li><a class="white" href="https://play.google.com/store/apps/details?id=app.global.prayer"><i class="ion-social-android"></i> <?php echo esc_html( __( 'Android App' ) ) ?></a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <ul style="list-style: none;">
                    <li><a class="white" href="/prayer_app/contact_us/"><?php echo esc_html( __( 'Contact Us', 'prayer-global-porch' ) ) ?></a></li>
                    <li><a class="white fw-bold" href="/content_app/give_page"><?php echo esc_html( __( 'Give', 'prayer-global-porch' ) ) ?></a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <ul style="list-style: none;">
                    <li><a class="white" href="/content_app/about_page/"><?php echo esc_html( __( 'About', 'prayer-global-porch' ) ) ?></a></li>
                    <li><a class="white" href="/content_app/data_sources/"><?php echo esc_html( __( 'Data Sources', 'prayer-global-porch' ) ) ?></a></li>
                    <li><a class="white" href="/download_app/media/"><?php echo esc_html( __( 'Media & Promotion', 'prayer-global-porch' ) ) ?></a></li>
                </ul>
            </div>
        </div>

        <div class="row" style="padding-top: 5rem;">
            <div class="col text-center">
                <p class="small">Prayer Global &copy; <script>document.write(new Date().getFullYear())</script> Gospel Ambition</p>
            </div>
        </div>
    </div>
</footer>
