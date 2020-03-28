<?php
function edit_unit(){
  global $wpdb;
  $unit_result = $wpdb->get_row($wpdb->prepare('SELECT * FROM ' . $wpdb->prefix . 'cases_unit WHERE id = %d', $_GET['id'] ));
  $region_result = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'cases_region');
  ?>
  <div class="container">
    <div class="wrap">
      <h1 id="h1"><?php _e('Edit Unit', 'cases'); ?></h1>
        <form  action="<?php echo wp_nonce_url('/wp-admin/admin.php?page=save_unit_result&id='.$_GET['id'], 'save_unit_nonce'); ?>" method="POST">
          <fieldset class="form-group">
            <label for=""><?php _e('Region', 'cases'); ?></label>
              <select  class="form-control"  name="region_id">
                  <?php
                  if(!$region_result){
                    return false;
                  }
                      foreach ($region_result as $region) {
                          var_dump($region);
                          $selected = '';
                          if ($unit_result->region_id == $region->id) {
                              $selected = 'selected';
                          }
                          echo '<option value="' . $region->id . '"  ' . $selected . '>' . $region->name . '</option>';
                      }
                  ?>
              </select>
          </fieldset>
          <fieldset class="form-group">
              <label for=""><?php _e('unit', 'cases'); ?></label>
              <input type="text" value="<?php echo $unit_result->name ?>" class="form-control" name="unit">
          </fieldset>
          <button type="submit" class="btn btn-primary"><?php _e('update', 'cases'); ?></button>
        </form>
    </div>
  </div>
<?php
}
