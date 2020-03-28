<?php
/**
 * The theme footer
 *
 * @package bootstrap-basic
 */
  $lang = ICL_LANGUAGE_CODE;
?>
<footer class="footer container">
    <div class="holder clearfix">
        <div class="col-xs-12 col-sm-3">
            <img src="<?php echo get_bloginfo('template_url') ?>/img/peace-dialogue.png" alt="Peace Dialogue" />
            <span class="title">
                <h2><?php _e('Peace Dialogue NGO', 'safesoldiers') ?></h2>
                <h3><?php _e('Non-governmental organizastion', 'safesoldiers') ?></h3>
            </span>
            <p>
                <span><?php _e('Address: 40 ap. 12 Myasnikyan str.,', 'safesoldiers') ?></span>
                <span><?php _e('2002, Vanadzor, Armenia;', 'safesoldiers') ?></span>
                <span><?php _e('Tel:', 'safesoldiers') ?> +374 (322) 21340;</span>
                <span><?php _e('Mob:', 'safesoldiers') ?> +374 (55) 820 632; (93) 820 632</span>
                <span><?php _e('E-mail:', 'safesoldiers') ?> ekhachatryan@peacedialogue.am;</span>
                <span>mailbox@peacedialogue.am</span>
                <span><?php _e('URL:', 'safesoldiers') ?> <a href="http://www.peacedialogue.am" target="_blank">http://www.peacedialogue.am</a></span>
            </p>
        </div>
        <div class="col-xs-12 col-sm-3">
            <img src="<?php echo get_bloginfo('template_url') ?>/img/pax.png" alt="PAX" />
            <p>
              <?php _e('The website is prepared in the framework the Safe Soldiers for a Safe Armenia project of Peace Dialogue NGO. The project Safe Soldiers for a Safe Armenia is supported by PAX the Netherlands.', 'safesoldiers') ?>

            </p>
        </div>
        <div class="col-xs-12 col-sm-3">
            <img src="<?php echo get_bloginfo('template_url') ?>/img/copyright.png" alt="Copyright" />
            <p class="first">
              <?php _e('The articles by Peace Dialogue are licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International License.', 'safesoldiers') ?>

            </p>
            <p class="second">
                <strong><?php _e('DISCLAIMER:', 'safesoldiers') ?></strong>
                <?php _e(' Through this website you are able to link to other websites which are not under the control of Peace Dialogue NGO. We have no control over the nature, content and availability of those sites. The inclusion of any links does not necessarily imply a recommendation or endorse the views expressed within them.', 'safesoldiers') ?>
            </p>
        </div>
        <div class="col-xs-12 col-sm-3">
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
            <div class="copyright">
                <p><?php _e('Copyright © 2016,', 'safesoldiers') ?></p>
                <p><?php _e('Peace Dialogue NGO;', 'safesoldiers') ?> </p>
                <p class="details"><?php _e('Designed by', 'safesoldiers') ?><a href="http://peyotto.com/" target="_blank"> <?php _e('Peyotto Technologies', 'safesoldiers') ?></a></p>
            </div>
            <ul class="footer_menu">
                <li class="menu-item">
                    <a href="<?php echo get_permalink(ABOUT) ?>"><?php _e('About Us', 'safesoldiers') ?></a>
                </li>
                <li class="menu-item">
                    <a href="<?php echo get_permalink(DONATE) ?>"><?php _e('Donate', 'safesoldiers') ?></a>
                </li>
                <li class="menu-item">
                    <a href="<?php echo get_permalink(SITEMAP) ?>"><?php _e('Site Map', 'safesoldiers') ?></a>
                </li>
            </ul>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
