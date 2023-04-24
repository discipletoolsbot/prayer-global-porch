<?php $is_dark_map_on = ( new PG_Feature_Flag( PG_Flags::DARK_MAP_FEATURE ) )->is_on() ?>

<div class="" id="map-settings">
    <div class="dropdown">
        <button type="button" class="btn btn-secondary dropdown-toggle icon-toggle" data-bs-auto-close="outside" data-bs-toggle="dropdown" aria-expanded="false" data-bs-offset="0,10">
            <ion-icon name="settings" style="font-size: 1.5em"></ion-icon>
        </button>
        <div class="dropdown-menu center p-2">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <strong>Participants</strong>
                <button class="map-toggle mx-0 ms-2" data-source-id="participants" id="toggle_participants">

                    <?php if ( $is_dark_map_on ) : ?>

                        <img class="foot__icon h-100" src="<?php echo esc_url( plugin_dir_url( __DIR__ ) . 'assets/images/participants-blue.png' ) ?>" />

                    <?php else : ?>

                        <img class="foot__icon h-100" src="<?php echo esc_url( plugin_dir_url( __DIR__ ) . 'assets/images/avatar1.png' ) ?>" />

                    <?php endif; ?>

                </button>
            </div>
            <div class="d-flex align-items-center justify-content-between mb-2">
                <strong>Cluster&nbsp;Participants</strong>
                <button
                    class="map-toggle mx-0 ms-2 d-flex align-items-center justify-content-center"
                    id="cluster_participants"
                >

                    <?php if ( $is_dark_map_on ) : ?>

                        <img class="foot__icon h-100" src="<?php echo esc_url( plugin_dir_url( __DIR__ ) . 'assets/images/clusters-blue.png' ) ?>" />

                    <?php else : ?>

                        <i class="ion-android-contract three-em foot__icon"></i>

                    <?php endif; ?>

                </button>
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <strong>Your&nbsp;Recent&nbsp;Prayers</strong>
                <button class="map-toggle mx-0 ms-2" data-layer-id="user_locations" id="toggle_user_locations">

                    <?php if ( $is_dark_map_on ) : ?>

                        <img class="foot__icon h-100" src="<?php echo esc_url( plugin_dir_url( __DIR__ ) . 'assets/images/recent-prayers-blue.png' ) ?>" />

                    <?php else : ?>

                        <img class="foot__icon h-100" src="<?php echo esc_url( plugin_dir_url( __DIR__ ) . 'assets/images/black-check-50.png' ) ?>" />

                    <?php endif; ?>

                </button>
            </div>
        </div>
    </div>

    <?php $is_dark_map_on = ( new PG_Feature_Flag( PG_Flags::DARK_MAP_FEATURE ) )->is_on(); ?>
    <?php if ( $is_dark_map_on ) : ?>

        <input type="text" class="no-map-colour mt-5" placeholder="Red style">
        <input type="text" class="yes-map-colour" placeholder="Green style">
        <input type="text" class="line-colour" placeholder="Line colour">
        <input type="text" class="fill-opacity" placeholder="Fill opacity e.g. 0.8">
        <button class="apply-new-map-styles btn btn-dark">
            Apply Styles
        </button>

    <?php endif; ?>

</div>