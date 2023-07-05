<div class="" id="map-settings">
    <div class="dropdown">
        <button type="button" class="btn btn-light blue-border dropdown-toggle icon-toggle" data-bs-auto-close="outside" data-bs-toggle="dropdown" aria-expanded="false" data-bs-offset="0,10">
            <i class="icon pg-settings" name="settings" style="font-size: 2em"></i>
        </button>
        <div class="dropdown-menu center p-2">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <strong><?php echo esc_html__( 'Participants', 'prayer-global-porch' ) ?></strong>
                <button class="map-toggle mx-0 ms-2" data-source-id="participants" id="toggle_participants">
                    <i class="icon pg-prayer blue two-half-em"></i>
                </button>
            </div>
            <div class="d-flex align-items-center justify-content-between mb-2">
                <strong><?php echo esc_html__( 'Cluster&nbsp;Participants', 'prayer-global-porch' ) ?></strong>
                <button
                    class="map-toggle mx-0 ms-2 d-flex align-items-center justify-content-center"
                    id="cluster_participants"
                >
                    <i class="icon pg-cluster blue two-half-em"></i>
                </button>
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <strong><?php echo esc_html__( 'Your&nbsp;Recent&nbsp;Prayers', 'prayer-global-porch' ) ?></strong>
                <button class="map-toggle mx-0 ms-2" data-layer-id="user_locations" id="toggle_user_locations">
                    <i class="icon pg-check blue two-half-em"></i>
                </button>
            </div>

       </div>

    </div>

</div>