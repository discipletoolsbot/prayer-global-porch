<!-- Modal -->
<div class="modal fade" id="share-modal" tabindex="-1" role="dialog" aria-labelledby="share-modal-label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="share-modal-label"><?php echo esc_html( sprintf( __( 'Share %s', 'prayer-global-porch' ), 'Prayer.Global' ) ) ?></h5>
      </div>
      <div class="modal-body ">
        <ul class="list-group list-group-flush share-modal__items">
            <li class="list-group-item list-group-item-action list-group-item-secondary facebook-action">
                <img class="share__icon" src="<?php echo esc_html( plugin_dir_url( __FILE__ ) ) ?>/images/facebook.svg" alt="Share">Facebook
            </li>
            <li class="list-group-item list-group-item-action list-group-item-secondary twitter-action">
                <img class="share__icon" src="<?php echo esc_html( plugin_dir_url( __FILE__ ) ) ?>/images/twitter.svg" alt="Share">Twitter
            </li>
            <li class="list-group-item list-group-item-action list-group-item-secondary email-action">
                <img class="share__icon" src="<?php echo esc_html( plugin_dir_url( __FILE__ ) ) ?>/images/email.svg" alt="Share">
                <?php echo esc_html( __( 'Email', 'prayer-global-porch' ) ) ?>
            </li>
            <li class="list-group-item list-group-item-action list-group-item-secondary link-action">
                <img class="share__icon" src="<?php echo esc_html( plugin_dir_url( __FILE__ ) ) ?>/images/link.svg" alt="Share">
                <?php echo sprintf( esc_html_x( 'Link %s', 'Link Copied', 'prayer-global-porch' ), '<span class="copy-notice">' . esc_html__( 'Copied', 'prayer-global-porch' ).'</span>' ) ?>
            </li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Done</button>
      </div>
    </div>
  </div>
</div>