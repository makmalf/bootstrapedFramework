<?php get_header(); ?>
<div class="row">
      <div class="col-md-8 shop-items-wrapper">
        <?php woocommerce_content(); ?>
      </div><!-- END .the-content -->

      <aside class="col-md-4">
        <div id="woocommercewidget">
          <?php 
            // echo nothing when Woocommerce Widget filled with nothing
            if ( ! dynamic_sidebar( 'woocommercewidget' ) ) : ?><?php endif;
          ?>
        </div>
      </aside><!-- END #SIDEBAR -->
</div><!-- END .wrapper -->
<?php get_footer(); ?>