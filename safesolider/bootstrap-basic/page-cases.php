<?php
/*
  Template Name: cases
 */


$comm_id = (int) $_GET['id'];
$lang = ICL_LANGUAGE_CODE;
$result = get_data_cases($comm_id, $lang);
if (!$result) {
    wp_redirect(home_url('404.php'));
    exit;
}
get_header();
?>
<div class="content">
    <div class="container">
        <?php featured($lang); ?>
        <div class="center-content clearfix profile-page">
            <?php incident_block(); ?>
            <div class="col-xs-12 col-sm-9 col-md-9 col-lg-8 soldiers">
                <div class="soldier_profile">
                    <h1><?php _e('Stories of soldiers died in non combat conditions', 'safesoldiers') ?></h1>
                    <div class="profile_wrapper">
                        <div class="arrows mobile-hidden">
                          <?php
                            $display = '';
                            if(arrows_left($result->id, $lang) == false){
                              $display = 'style="display:none;"';
                            }?>
                          <div class="arrow-left" <?php echo $display; ?> >
                                <a href="<?php echo arrows_left($result->id, $lang); ?>"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
                            </div>
                            <?php
                              $display = '';
                              if(arrows_right($result->id, $lang) == false){
                                $display = 'style="display:none;"';
                              }?>
                            <div class="arrow-right" <?php echo $display; ?> >
                                <a href="<?php echo arrows_right($result->id, $lang); ?>"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div class="holder">
                            <div class="img-cont">
                              <a href="<?php echo icl_get_home_url() ?>">
                                <?php if($lang == 'en'){
                                  ?>
                                  <img src="<?php echo get_bloginfo('template_url') ?>/img/safe.png" alt="Home" />
                                  <?php
                                } elseif($lang == 'hy'){
                                  ?>
                                  <img src="<?php echo get_bloginfo('template_url') ?>/img/logo_arm.png" alt="Home" />
                                  <?php
                                }
                                ?>
                              </a>
                            </div>
                            <div class="details">

                                <img src="<?php echo Helper::get_media_by_cases_id($result->id); ?>" />

                                <div class="soldier-details">
                                    <h2><?php echo $result->frst_name . ' ' . $result->last_name; ?></h2>
                                    <table>
                                        <tr>
                                            <td><?php _e('Date', 'safesoldiers') ?>:</td>
                                            <td><?php echo $result->date; ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php _e('Place', 'safesoldiers') ?>:</td>
                                            <td><?php echo country_name($result->country_id); ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php _e('Region', 'safesoldiers') ?>:</td>
                                            <td><?php echo region_name($result->region_id); ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php _e('Reason', 'safesoldiers') ?>:</td>
                                            <td><?php echo reason_name($result->reason_id); ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php _e('Content status', 'safesoldiers') ?>:</td>
                                            <td class="green"><?php echo conent_status($result->content_type) ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php _e('Add by', 'safesoldiers') ?>:</td>
                                            <td><?php _e('Safesoldiers', 'safesoldiers') ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="case">
                                <p><?php echo $result->content; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="info">
                        <i class="fa fa-caret-up" aria-hidden="true"></i>
                        <p>
                            <?php _e('Please, note that incidents are recorded in the database guided by official reports however, the descriptions of the cases also include findings which question the official report, such as the opinions and the testimonies of relatives, as well as information provided by certain media outlets, watchdog groups or other experts.', 'safesoldiers') ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2 right-sidebar">
                <?php get_frontend_database_block($lang); ?>
                
            </div>
        </div>
    </div>
    <?php searchresults(); ?>
</div>
<?php get_footer();
?>
