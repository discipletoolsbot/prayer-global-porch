
<div class="" id="map-settings">
    <div class="dropdown">
        <button type="button" class="btn btn-secondary dropdown-toggle icon-toggle" data-bs-auto-close="outside" data-bs-toggle="dropdown" aria-expanded="false" data-bs-offset="0,10">
            <ion-icon name="settings" style="font-size: 1.5em"></ion-icon>
        </button>
        <div class="dropdown-menu center p-2">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <strong>Participants</strong>
                <button class="map-toggle mx-0 ms-2" data-source-id="participants" id="toggle_participants">
                    <img class="foot__icon h-100" src="<?php echo esc_url( plugin_dir_url( __DIR__ ) . 'assets/images/avatar1.png' ) ?>" />
                </button>
            </div>
            <div class="d-flex align-items-center justify-content-between mb-2">
                <strong>Cluster&nbsp;Participants</strong>
                <button
                    class="map-toggle mx-0 ms-2 d-flex align-items-center justify-content-center"
                    id="cluster_participants"
                >
                    <i class="ion-android-contract three-em foot__icon"></i>
                </button>
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <strong>Your&nbsp;Recent&nbsp;Prayers</strong>
                <button class="map-toggle mx-0 ms-2" data-layer-id="user_locations" id="toggle_user_locations">
                    <img class="foot__icon h-100" src="<?php echo esc_url( plugin_dir_url( __DIR__ ) . 'assets/images/black-check-50.png' ) ?>" />
                </button>
            </div>
        </div>
    </div>
</div>