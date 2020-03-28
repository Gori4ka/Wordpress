<?php

function get_filter_page_form() {
    global $wpdb;
    $language =  Helper::gat_language($_GET['lang']);
    ?>
    <div class="container">
        <div class="wrap">
            <h1 id="h1"><?php _e('Filter', 'cases'); ?></h1>
            <form class="addform" action="<?php echo wp_nonce_url('/wp-admin/admin.php?page=filter_result' , 'cases_filter_nonce') ?>" method="POST">
                <fieldset class="form-group">
                    <select  class="form-control" name="cases_type" >
                        <option value="" selected disabled hidden ><?php _e('Cases', 'cases'); ?></option>
                        <option value="death"><?php _e('Death', 'cases'); ?></option>
                        <option value="1"><?php _e('Incident', 'cases'); ?></option>
                    </select>
                </fieldset>

                <fieldset class="form-group">
                    <input type="text"  class="form-control" name="frst_name" placeholder="<?php _e('First Name', 'cases'); ?>">
                </fieldset>
                <fieldset class="form-group">
                    <input type="text"  class="form-control" name="last_name" placeholder="<?php _e('Last Name', 'cases'); ?>">
                </fieldset>
                <fieldset class="form-group">
                    <div class="input-group date datepicker">
                        <input type="text"  class="form-control" name="date" placeholder="<?php _e('Date', 'cases'); ?>">
                        <span class="input-group-addon">
                            <span class="dashicons dashicons-calendar-alt"></span>
                        </span>
                    </div>
                </fieldset>
                <fieldset class="form-group">
                    <select id="countryList" class="form-control" name="country_id">
                        <option value="" selected disabled hidden ><?php _e('Place', 'cases'); ?></option>
                        <?php
                        $countryList = Helper::get_country_list($language);
                        if ($countryList) {
                            foreach ($countryList as $country) {
                                echo '<option value="' . $country->id . '">' . $country->name . '</option>';
                            }
                        }
                        ?>
                    </select>
                </fieldset>
                <fieldset class="form-group">
                    <select  class="form-control filterdisabled" id="regionList" name="region_id">
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
                    <select  class="form-control filterdisabled" id="unitList" name="unit_id">
                        <option value="" selected disabled hidden><?php _e('Unit', 'cases'); ?></option>
                        <?php
                        $UnitList = Helper::get_unit_list($language);
                        if ($UnitList) {
                            foreach ($UnitList as $unit) {
                                echo '<option value="' . $unit->id . '" class= "region_' . $unit->region_id . '">' . $unit->name . '</option>';
                            }
                        }
                        ?>
                    </select>
                </fieldset>

                <fieldset class="form-group">
                    <input type="text"  class="form-control" name="capitan" placeholder="<?php _e('capitan', 'cases'); ?>">
                </fieldset>

                <fieldset class="form-group">
                    <select  class="form-control" id="rankList" name="capitan_rank_id">
                        <option value="" selected disabled hidden><?php _e('Rank', 'cases'); ?></option>
                        <?php
                        $rankList = Helper::get_capitan_rank_list($language);
                        if ($rankList) {
                            foreach ($rankList as $rank) {
                                echo '<option value="' . $rank->id . '" >' . $rank->name . '</option>';
                            }
                        }
                        ?>
                    </select>
                </fieldset>

                <fieldset class="form-group">
                    <select  class="form-control" id="reasonList" name="reason_id">
                        <option value="" selected disabled hidden><?php _e('Reason', 'cases'); ?></option>
                        <?php
                        $reasonList = Helper::get_reason_list($language);
                        if ($reasonList) {
                            foreach ($reasonList as $reason) {
                                echo '<option value="' . $reason->id . '" >' . $reason->name . '</option>';
                            }
                        }
                        ?>
                    </select>
                </fieldset>
              <div class="form-group card ">
                <h4 class="card-title"><?php _e('status', 'cases'); ?></h4>
                <div class="radio">
                    <label>
                        <input type="radio" name="content_type"  value="1">
                        <?php _e('specified', 'cases'); ?>
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="content_type"  value="status">
                        <?php _e('unspecified', 'cases'); ?>
                    </label>
                </div>
              </div>
              <div class="form-group card ">
                <h4 class="card-title"><?php _e('visibility', 'cases'); ?></h4>
                <div class="radio">
                    <label>
                        <input type="radio" name="status"  value="1">
                        <?php _e('public', 'cases'); ?>
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="status"  value="public">
                        <?php _e('no public', 'cases'); ?>
                    </label>
                </div>
              </div>
                <fieldset class="form-group">
                    <input type="text"  class="form-control" name="Providers_name" placeholder="<?php _e('Providers_name', 'cases'); ?>">
                </fieldset>
                <fieldset class="form-group">
                    <input type="text"  class="form-control" name="Providers_last_name" placeholder="<?php _e('Providers_last_name', 'cases'); ?>">
                </fieldset>
                <fieldset class="form-group">
                    <input type="text"  class="form-control" name=" Providers_phone" placeholder="<?php _e('Providers_phone', 'cases'); ?>">
                </fieldset>
                <fieldset class="form-group">
                    <input type="email" class="form-control" name="Providers_email" placeholder="<?php _e('Providers_email', 'cases'); ?>">
                </fieldset>

                <button type="submit" class="btn btn-primary"><?php _e('search', 'cases'); ?></button>
            </form>
        </div>
    </div>
    <?php
}
