<?php
function add_new_unit() {
  global $wpdb;
    $language = Helper::gat_language($_GET['lang']);
    ?>
    <div class="container">
        <div class="wrap">
            <h1 id="h1"><?php _e('Unit', 'cases'); ?></h1>
            <form class="addform" action="" method="POST">
                <fieldset class="form-group">
                    <label for=""><?php _e('Country', 'cases'); ?></label>
                    <select  class="form-control" id="countryList" name="country_id">
                        <option value="" selected disabled hidden><?php _e('Country', 'cases'); ?></option>
                        <?php
                        $countryList = Helper::get_country_list($language);
                        if ($countryList) {
                            foreach ($countryList as $country) {
                                echo '<option value="' . $country->id . '" class= "country_' . $country->country_id . '">' . $country->name . '</option>';
                            }
                        }
                        ?>
                    </select>
                </fieldset>
                <fieldset class="form-group">
                    <label for=""><?php _e('Region', 'cases'); ?></label>
                    <select  class="form-control" id="regionList" name="region_id">
                        <option value="" selected disabled hidden><?php _e('Region', 'cases'); ?></option>
                        <?php
                        $RegionList = Helper::get_region_list($language);
                        if ($RegionList) {
                            foreach ($RegionList as $region) {
                                echo '<option value="' . $region->id . '" class= "country_' . $region->country_id . '">' . $region->name . '</option>';
                            }
                        }
                        ?>
                    </select>
                </fieldset>
                <fieldset class="form-group">
                    <label for=""><?php _e('unit', 'cases'); ?></label>
                    <input type="text" value="" required class="form-control" name="unit" placeholder="<?php _e('unit', 'cases'); ?>">
                </fieldset>
                <button type="submit" class="btn btn-primary"><?php _e('save', 'cases'); ?></button>
            </form>
        </div>
    </div>

    <?php
}

if (isset($_POST['unit']) && $_POST['unit'] && isset($_POST['region_id']) && (int) $_POST['region_id'] && isset($_POST['country_id']) && (int) $_POST['country_id']) {
    $wpdb->query($wpdb->prepare(
                "INSERT INTO " . $wpdb->prefix . "cases_unit
		( region_id, name )
		VALUES ( %d, %s )",
                (int) $_POST['region_id'], $_POST['unit']
    ));
    if ($wpdb->insert_id) {
        $id_base = $wpdb->insert_id;
        if (isset($_GET['id_base']) && (int)$_GET['id_base']) {
            $id_base = (int)$_GET['id_base'];
        }
        $casesTranslate = array(
            'id_base' => $id_base,
            'id_trans' => $wpdb->insert_id,
            'lang' => Helper::gat_language($_GET['lang']),
            'type' => 'unit'
        );
        $wpdb->insert($wpdb->prefix . 'cases_translate', $casesTranslate);
        Helper::redirect_to_cases_unit_page();
    }
}
?>
