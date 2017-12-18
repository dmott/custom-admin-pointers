<?php
add_action('admin_enqueue_scripts', 'add_admin_pointers');
function add_admin_pointers(){
  add_action( 'admin_print_footer_scripts', 'custom_admin_pointers_footer' );
  wp_enqueue_script( 'wp-pointer' );
  wp_enqueue_style( 'wp-pointer' );
}

function render_pointer($pointer) {  ?>
  <?php if(!empty($pointer['page_css_identifier'])) : ?>

    if(jQuery('<?php echo $pointer['page_css_identifier']; ?>').length) {
  <?php endif; ?>

    <?php if(!empty($pointer['click_trigger_element'])) : ?>

      jQuery(document).on('mouseup', '<?php echo $pointer['click_trigger_element']; ?>', function(){
    <?php endif; ?>

    <?php if(!empty($pointer['show_delay'])) : ?>

      setTimeout(function(){
    <?php endif; ?>

        var $el = jQuery('<?php echo $pointer['css_element_anchor']; ?>').pointer({
          content: '<h3><?php echo addslashes($pointer['title']); ?></h3><div><?php echo addslashes($pointer['content']); ?></div>',
          <?php if(!empty($pointer['css_class'])) : ?>

            pointerClass: 'wp-pointer <?php echo $pointer['css_class']; ?>',
          <?php endif; ?>

          position: {
            edge: '<?php echo $pointer['edge']; ?>',
            align: '<?php echo $pointer['align']; ?>'
          }
          <?php if(!empty($pointer['sub_pointers'])) : ?>,

            close: function(){
              <?php foreach($pointer['sub_pointers'] as $sub_pointer) {
                render_pointer($sub_pointer);
              } ?>
            }
          <?php endif; ?>

        }).pointer('open').pointer('widget');
        console.log($el);

        <?php if(!empty($pointer['scroll']) && $pointer['scroll']) : ?>

          jQuery('html, body').animate({
            scrollTop: $el.offset().top - ($el.height() / 2)
          }, 1000);
        <?php endif; ?>

    <?php if(!empty($pointer['show_delay'])) : ?>

      }, <?php echo $pointer['show_delay']; ?>);
    <?php endif; ?>

    <?php if(!empty($pointer['click_trigger_element'])) : ?>

      });
    <?php endif; ?>

  <?php if(!empty($pointer['page_css_identifier'])) : ?>

    }
  <?php endif; ?>
<?php
}


function custom_admin_pointers_footer() {
  $all_pointers = array();
  $all_pointers = apply_filters('all_admin_pointers', $all_pointers);
  ?>
  <style>
  .wp-pointer.overlay-pointer {
    z-index: 100000 !important;
  }
  </style>
  <script>
  jQuery(document).ready(function(){ // pointers doc ready
    <?php foreach($all_pointers as $pointer) {
      render_pointer($pointer);
    } ?>
  });
  </script>
<?php }
